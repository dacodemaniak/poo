<?php
/**
* @name HelloController Classe concr�te de gestion de la page Hello
* @author Artoris - Nov. 2018
* @package IndexController
* @version 1.0.0
*/
namespace HelloController;

use Controller\Controller;
use Templating\Templater;
use Http\Request\Request;

class HelloController extends Controller {
    
    /**
     * Tableau des personnes � qui dire bonjour
     * @var array
     */
    private $greetings;
    
    /**
     * A qui je dois dire bonjour
     * @var string | null
     */
    private $greeting;
    
    public function __construct(Templater $templater, Request $request) {
        $this->setTemplateName();
        
        // R�cup�re le moteur de template
        $this->templater = $templater;
        
        // R�cup�re les donn�es de la requ�te
        $this->request = $request;
        
        $this->greeting = $request->getData("name");
        
        // Alimenter le tableau
        $this->greetings[] = "Jean-Luc";
        $this->greetings[] = "Gr�goire";
        $this->greetings[] = "Franck";
    }
    
    /**
     * Retourne le tableau des personnes
     * @return array
     */
    public function greetings(): array {
        return $this->greetings;
    }
    
    /**
     * Retourne la personne � qui je dois dire bonjour
     * ou une valeur nulle
     * @return string | null
     */
    public function greeting() {
        return $this->greeting;
    }
    
    /**
     * @override Controller::setTemplateName()
     */
    protected function setTemplateName() {
        $className = __CLASS__;
        $position = strpos($className, "Controller");
        $template = strtolower(substr($className, 0, $position));
        $this->templateName = __DIR__ . "/Views/" . $template . ".tpl";
    }
}