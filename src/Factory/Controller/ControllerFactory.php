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
            return new $this->controllerName($templater, $request);
        }
        
        // Fallback vers index, avec une information supplémentaire
        $request->setData("not_found", "La page que vous avez demandé n'existe pas !");
        return new \IndexController\IndexController($templater, $request);
    }
}