<?php
/**
* @name JsonResponse Service de réponse au format JSON
* @author Artoris Nov. 2018
* @package Http\Response\Json
* @version 1.0.0
*/
namespace Http\Response\Json;

use Http\Response\Response;
use Controller\ControllerInterface;

class JsonResponse extends Response {
    
    public function __construct(ControllerInterface $controller) {
        parent::__construct($controller);
    }
    
    /**
     * Envoi la réponse au format JSON vers le client
     */
    public function send(array $datas = null) {
        header("HTTP/1.0 200 Ok");
        header("Content-Type: application/json");
        
        echo json_encode($datas);
    }
}