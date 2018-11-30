<?php
namespace Http\Request;

/**
 * @name Request Service de récupération des données HTTP
 * @author Artoris - Nov. 2018
 * @package Http\Request
 * @version 1.0.0
 * @version 1.0.1
 *  Récupère le verbe HTTP utilisé   
 */
use Http\HttpFoundation;

class Request extends HttpFoundation {
    
    
    public function __construct() {
        // Appelle explicitement si nécessaire
        // le constructeur de la classe parente.
        parent::__construct();
        
        $this->_getIterator();
        $this->_postIterator();
        
        // Récupération du verbe HTTP
        $this->httpVerb = $_SERVER["REQUEST_METHOD"];
        
        $this->decodeURI();
    }
    
    
    /**
     * Parcours le tableau $_GET
     * et alimente l'attribut $datas
     */
    private function _getIterator() {
        foreach($_GET as $key => $value) {
            $this->datas[$key] = $value;
        }
    }
    
    /**
     * Parcours le tableau $_POST
     * et alimente l'attribut $datas
     */
    private function _postIterator() {
        foreach($_POST as $key => $value) {
            $this->datas[$key] = $value;
        }
    }
    
    private function decodeURI() {
        $uri = $_SERVER["REQUEST_URI"];
        $uriArray = explode("/", $uri);
        array_shift($uriArray);
        if ($uriArray[0] === "index.php") {
            array_shift($uriArray);
        }
        
        $this->datas["module"] = $uriArray[0];
        
        if (count($uriArray) >= 2) {
            $this->datas["mode"] = $uriArray[1];
        }
        
        if (count($uriArray) === 3) {
            $this->datas["id"] = $uriArray[2];
        }
    }
}

