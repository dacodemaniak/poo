<?php
/**
* @name ControllerFactory Service de création des objets de type Controller
* @author Artoris - Nov. 2018
* @package Factory\Controller
* @version 1.0.0
*/
namespace Factory\Controller;

use Templating\Templater;
use Http\Request\Request;

class ControllerFactory {
    
    /**
     * FQCN : Full Qualified Class Name
     * @var string
     */
    protected $controllerName;
    
    /**
     * Dossier dans lequel se situe le contrôleur
     * @var string
     */
    private $controllerFolder;
    
    public function __construct(string $controllerName) {
        $this->controllerName = "\\" . 
            ucfirst(strtolower($controllerName)) .
            "Controller\\" .
            ucfirst(strtolower($controllerName)) .
            "Controller";
        
            $this->controllerFolder = __DIR__ . 
                "/../../" . 
                ucfirst(strtolower($controllerName)) .
                "Controller/";
    }
    
    public function getInstanceOf(Templater $templater, Request $request) {
        if (class_exists($this->controllerName)) {
            $reflexion = new \ReflectionClass($this->controllerName);
            $classDoc = $reflexion->getDocComment();
            
            $injections = explode("\r\n", str_replace("/**", "", $classDoc));
            array_shift($injections);
            array_pop($injections);
            
            // Tout ce qui doit être injecté
            $injections = $this->createInjection($injections);
            
            $instance = $reflexion->newInstance();
            
            if (count($injections)) {
                foreach($injections as $injection) {
                    if ($injection === "\\Templating\\Templater") {
                        $instance->inject("templater", $templater);
                    }
                    
                    if ($injection === "\\Http\\Request") {
                        $instance->inject("request", $request);
                    }
                }
            }
            
            $instance->handle();
            
            return $instance;
        }
        
        // Fallback vers index, avec une information supplémentaire
        $request->setData("not_found", "La page que vous avez demandé n'existe pas !");
        return new \IndexController\IndexController($templater, $request);
    }
    
    private function createInjection(array $injections) {
        $objects = [];
        foreach ($injections as $injection) {
            
            $injection = str_replace("* ", "", $injection);
            if (substr($injection, 0, 7) === "@Inject") {
                $inject = substr(
                    $injection, 
                    8,
                    strlen($injection) - 9
                 );
                 $objects[] = $inject;
            }
        }
        return $objects;
    }
}