<?php
/**
* @name Response Service de r�ponse HTTP
* @author Artoris (Nov. 2018)
* @package Http\Response
* @version 1.0.0
*/
namespace Http\Response;

use Controller\ControllerInterface;


abstract class Response {
    /**
     * Instance d'un contr�leur
     * @var \Controller\ControllerInterface
     */
    protected $controller;
    
    public function __construct(ControllerInterface $controller) {
        $this->controller = $controller;
    }
    
    /**
     * Envoie la vue vers le client
     */
    abstract public function send(array $datas = null);
}