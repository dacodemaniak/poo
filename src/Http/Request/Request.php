<?php
namespace Http\Request;

/**
 * @name Request Service de récupération des données HTTP
 * @author Artoris - Nov. 2018
 * @package Http\Request
 * @version 1.0.0   
 */
use Http\HttpFoundation;

class Request extends HttpFoundation {
    public function __construct() {
        // Appelle explicitement si nécessaire
        // le constructeur de la classe parente.
        parent::__construct();
        
        $this->_getIterator();
        $this->_postIterator();
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
}

