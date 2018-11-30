<?php
/**
* @name HtmlResponse Service de réponse HTML classique
* @author Artoris Nov. 2018
* @package Http\Response\Html
* @version 1.0.0
*/
namespace Http\Response\Html;

use Http\Response\Response;
use Controller\ControllerInterface;

class HtmlResponse extends Response {
    
    public function __construct(ControllerInterface $controller) {
        parent::__construct($controller);
    }
    
    /**
     * Envoi la réponse au format HTML vers le client
     */
    public function send(array $datas = null) {
        header("HTTP/1.0 200 Ok");
        header("Content-Type: text/html");
        
        $this->controller->getTemplater()->assign("controller", $this->controller);
        $this->controller->getTemplater()->display($this->controller->getTemplate());
    }
}