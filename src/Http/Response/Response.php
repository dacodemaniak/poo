<?php
/**
* @name Response Service de réponse HTTP
* @author Artoris (Nov. 2018)
* @package Http\Response
* @version 1.0.0
*/
namespace Http\Response;

use Controller\Controller;


class Response {
    /**
     * Instance d'un contrôleur
     * @var \Controller\Controller
     */
    private $controller;
    
    public function __construct(Controller $controller) {
        $this->controller = $controller;
    }
    
    /**
     * Envoie la vue vers le client
     */
    public function send() {
        header("HTTP/1.0 200 Ok");
        header("Content-Type: text/html");
        
        /**
        if ($this->controller->processingMode()) {
            die("Process mode");
            //header("Location: /?module=" . $this->controller->getModule());
        }
        **/
    }
}