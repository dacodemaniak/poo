<?php
/**
* @name Response Service de réponse HTTP
* @author Artoris (Nov. 2018)
* @package Http\Response
* @version 1.0.0
*/
namespace Http\Response;

use Controller\ControllerInterface;


class Response {
    /**
     * Instance d'un contrôleur
     * @var \Controller\ControllerInterface
     */
    private $controller;
    
    public function __construct(ControllerInterface $controller) {
        $this->controller = $controller;
    }
    
    /**
     * Envoie la vue vers le client
     */
    public function send() {
        header("HTTP/1.0 200 Ok");
        header("Content-Type: text/html");
        
        $this->controller->getTemplater()->assign("controller", $this->controller);
        $this->controller->getTemplater()->display($this->controller->getTemplate());
    }
}