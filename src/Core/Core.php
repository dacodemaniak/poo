<?php
/**
* @name Core Chargement de l'application PHP
* @author Artoris - Nov. 2018
* @package Core
* @version 1.0.0
* @usage Singleton Retourne l'instance si elle existe
*   sinon, créer une nouvelle instance et la retourne
* @version 1.0.1
*   Modification du traitement des réponses déportées dans les contrôleurs
*/
namespace Core;

require_once(__DIR__ . "/../../vendor/autoload.php");

use Http\Request\Request;
use Templating\Templater;
use Factory\Controller\ControllerFactory;
use Controller\ControllerInterface;

class Core {
    
    /**
     * Instance du coeur de l'application
     * @var Core
     */
    private static $coreInstance;
    
    /**
     * Chemins spécifiques pour les classes tierces
     * @var array
     */
    private static $vendorPathes = [
        "Smarty" => "smarty-3.1.33/libs/"
    ];
    
    /**
     * Instance de la classe Http\Request
     * @var Http\Request
     */
    private $request;
    
    /**
     * Instance du moteur de template (Smarty)
     * @var \Templating\Templater
     */
    private $templater;
    
    /**
     * Contrôleur en cours
     * @var ControllerInterface
     */
    private $controller;
    
    private function __construct() {
        spl_autoload_register(array(__CLASS__,"autoload"));
        
        // Instancie le moteur de Template
        $this->templater = new Templater();
        
        
        // Instancie l'objet Request
        $this->request = new Request();
        
        // On récupère le contrôleur spécifique
        $this->controller = $this->handleRequest();
        
    }
    
    /**
     * Gère la requête HTTP
     */
    private function handleRequest(): ControllerInterface {
        if ($this->request->getData("module") === null) {
            // On doit donc instancier le contrôleur par défaut
            $factory = new ControllerFactory("index");
            return $factory->getInstanceOf($this->templater, $this->request);
        } else {
            $factory = new ControllerFactory($this->request->getData("module"));
            return $factory->getInstanceOf($this->templater, $this->request);
        }
    }
    
    public static function get(): Core {
        if (self::$coreInstance !== null) {
            // Il existe déjà une instance... on la retourne
            return self::$coreInstance;
        }
        
        // Intanciation de la classe Core
        self::$coreInstance = new Core();
        
        return self::$coreInstance;
    }
    
    /**
     * Chargement automatique des classes
     */
    private static function autoload(string $className) {
        $classParts = explode("\\", $className);
        $class = array_pop($classParts);
        $classPath = __DIR__ . "/../" . implode("/", $classParts) . "/" . $class . ".php";
        if (file_exists($classPath)) {
            require_once($classPath);
        } else {
            // On cherche dans le dossier vendor
            foreach(self::$vendorPathes as $classRoot => $path) {
                $classPath = __DIR__ . "/../../vendor/" . $path . "/" . $class . ".php";
                if (file_exists($classPath)) {
                    require_once($classPath);
                    break;
                }
            }
        }
    }
}