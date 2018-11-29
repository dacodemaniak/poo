<?php
/**
* @name Templater Service de chargement du moteur de template
* @author Artoris - Nov. 2018
* @package Templating
* @version 1.0.0
*/
namespace Templating;

require_once(__DIR__ . "/../../vendor/smarty-3.1.33/libs/Smarty.class.php");

class Templater extends \Smarty {
    
    public function __construct() {
        parent::__construct();
        
        // Paramétrage des dossiers de traitement Smarty
        $this->setTemplateDir(__DIR__ . "/../../templates");
        $this->setCompileDir(__DIR__ . "/../../var/templates_c");
        $this->setCacheDir(__DIR__ . "../../var/cache");
        $this->setConfigDir(__DIR__ . "../../var/configs");
    }
}