<?php
/**
* @name IndexController Classe concrète de gestion de la page d'accueil
* @author Artoris - Nov. 2018
* @package IndexController
* @version 1.0.0
*/
namespace IndexController;

use Controller\Controller;
use Templating\Templater;
use Http\Request\Request;

class IndexController extends Controller {
    /**
     * Titre de la page pour le contrôleur courant
     * @var string
     */
    private $title;
    
    /**
     * Information utilisateur
     * @var string
     */
    private $notFound;
    
    public function __construct(Templater $templater, Request $request) {
        $this->setTemplateName();
        
        // Récupère l'instance du moteur de template
        $this->templater = $templater;
        
        // Récupère les données de la requête
        $this->request = $request;
        
        // Définition du titre de la page Index
        $this->title = "Hello Smarty !";
    }
    
    /**
     * Définit ou retourne le titre de la page
     * @param string $title
     * @return string | \IndexController\IndexController
     */
    public function title(string $title = null) {
        if ($title === null) {
            // On veut récupérer la valeur de l'attribut
            return $this->title;
        }
        
        // Sinon, c'est un setter... on affecte et on retourne l'objet lui-même
        // permettant le chaînage de méthodes
        $this->title = $title;
        
        return $this;
    }
    
    public function isNotFound() {
        return ($this->request->getData("not_found") !== null) ? $this->request->getData("not_found") : false;
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