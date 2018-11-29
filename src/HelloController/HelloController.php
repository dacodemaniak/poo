<?php
/**
* @name HelloController Classe concrète de gestion de la page Hello
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
     * Tableau des personnes à qui dire bonjour
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
        
        // Récupère le moteur de template
        $this->templater = $templater;
        
        // Récupère les données de la requête
        $this->request = $request;
        
        $this->greeting = $request->getData("name");
        
        // Alimenter le tableau
        $this->greetings[] = "Jean-Luc";
        $this->greetings[] = "Grégoire";
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
     * Retourne la personne à qui je dois dire bonjour
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