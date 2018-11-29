<?php
/**
* @name Controller Classe "abstraite" de définition d'un contrôleur
* @author Artoris - Nov. 2018
* @package Controller
* @version 1.0.0
*/
namespace Controller;

use Controller\ControllerInterface;
use Core\Core;

abstract class Controller implements ControllerInterface {
    /**
     * Nom de la vue à charger
     * @var string
     */
    protected $templateName;
    
    /**
     * Données de la requête HTTP
     * @var Http\Request
     */
    protected $request;
    
    /**
     * Nom du module courant
     * @var string
     */
    protected $moduleName;
    
    /**
     * Mode d'exécution du contrôleur
     * @var string
     */
    protected $mode;
    
    protected $templater;
    
    abstract protected function setTemplateName();
    abstract protected function setModuleName();
    
    /**
     * Retourne le nom du module courant
     * @return string
     */
    public function getModule(): string {
        return $this->moduleName;
    }
    
    public function processingMode() {
      return $this->request->isProcessMode(); 
    }
    
    public function getAction() {
        $action = "/?module=" . $this->request->getData("module");
        if ($this->request->getData("mode") !== null) {
            $action .= "&mode=" . $this->request->getData("mode");
        }
        if ($this->request->getData("id") !== null) {
            $action .= "&id=" . $this->request->getData("id");
        }
        return $action;
    }
    
    /**
     * Retourne le mode d'exécution du contrôleur
     * @return string
     */
    public function getMode(): string {
        $this->mode = $this->request->getData("mode");
        return $this->request->getData("mode");
    }
    
    /**
     * Retourne l'url spécifique en fonction du type de contrôleur
     * @param $queryString Donnée à définir dans l'URL
     * @return string
     */
    public function createUrl(string $queryString = null): string {
        $domain = "http://poo.wrk";
        
        if ($this instanceof \IndexController\IndexController) {
            $domain .= "/";
        } else {
            if ($this instanceof \HelloController\HelloController) {
                $domain .= "/?module=hello&name=" . $queryString;
            }
        }
        return $domain;
    }
    
    /**
     * Affiche la vue en utilisant le moteur de template
     *
     */
    public function getTemplate(string $templateName = null) {
        if ($templateName !== null) {
            $this->templateName = $templateName;
        }
        $this->templater->assign("controller", $this);
        $this->templater->display($this->templateName);
    }
}