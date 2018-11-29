<?php
/**
* @name UserController Contr�leur pour la gestion des utilisateurs
* @author Artoris - Nov. 2018
* @package UserController
* @version 1.0.0
*/
namespace UserController;

use Controller\Controller;
use Templating\Templater;
use Http\Request\Request;
use UserController\Entity\UserEntity as User;
use Controller\UrlInterface;

class UserController extends Controller implements UrlInterface {
    
    /**
     * @property $title Titre à donner au formulaire
     */
    
    /**
     * Tableau des utilisateurs
     * @var array
     */
    private $users;
    
    /**
     * Utilisateur à traiter dans le formulaire
     * @var User
     */
    private $user;
    
    public function __construct(Templater $templater, Request $request) {
        // Détemrine le nom du module
        $this->setModuleName();
        
        $this->templater = $templater;
        
        // Récupère les données de la requête
        $this->request = $request;
        
        if ($this->request->getData("mode") !== null) {
            if (
                $this->request->getData("mode") === "add" ||
                $this->request->getData("mode") === "upd" ||
                $this->request->getData("mode") === "insert" ||
                $this->request->getData("mode") === "update"
            ) {
                $this->process();
            }
        } else {
            // Alimenter le tableau
            $this->_hydrate();
        }
        
        $this->setTemplateName();
        
        $this->getTemplate();
    }
    
    /**
     * Traite le formulaire
     */
    private function process() {
        
        if ($this->request->getData("mode") === "add" || $this->request->getData("mode") === "insert") {
            $this->user = new User();
            $this->request->setData("mode", "add");
        } else {
            $this->user = $this->_find($this->request->getData("id"));
            $this->request->setData("mode", "upd");
        }
        
        // Persiste la donnée
        if ($this->request->getData("submit") !== null) {
            $this->user
                ->name($this->request->getData("name"))
                ->firstName($this->request->getData("firstName"))
                ->userName($this->request->getData("userName"))
                ->password($this->request->getData("password"));
            // Persistence des données
            $doctrine = \Core\ORM\EntityManager::getEntityManager();
            $manager = $doctrine->getManager();
            $manager->persist($this->user);
            $manager->flush();
            
            $this->request->removeData("mode");
        }
    }
    
    /**
     * Détermine le nom du module
     */
    protected function setModuleName() {
        $className = __CLASS__;
        $position = strpos($className, "Controller");
        $this->moduleName = strtolower(substr($className, 0, $position));
    }
    
    /**
     * Retourne une instance d'utilisateur
     * @return User
     */
    public function user(): User {
        return $this->user;
    }
    /**
     * Getter magique PHP
     * @param string $property
     * @return string
     */
    public function __get(string $property) {
        if ($property === "title") {
            if ($this->request->getData("mode" !== null)) {
                return ($this->request->getData("mode") === "insert" || $this->request->getData("mode") === "add") ? "Ajouter un utilisateur" : "Modifier un utilisateur";
            }
        }
        
        if ($property === "btnTitle") {
            if ($this->request->getData("mode") !== null) {
                return ($this->request->getData("mode") === "insert" || $this->request->getData("mode") === "add") ? "Ajouter" : "Modifier";
            }
        }
    }
    
    /**
     * Implémentation de l'interface UrlInterface
     * @param string $module Module à utiliser
     * @param string $mode Mode d'exécution du module
     * @param int $id Identifiant à traiter le cas échéant
     */
    public function createUrl(string $module=null, string $mode=null, int $id=null): string {
        if ($module === null) {
            $className = __CLASS__;
            $position = strpos($className, "Controller");
            $module = strtolower(substr($className, 0, $position));
        }
        
        $url = "/?module=" . $module;
        
        if ($mode !== null) {
            $url .= "&mode=" . $mode;
        }
        
        if ($id !== null) {
            $url .= "&id=" . $id;
        }
        
        return $url;
    }
    
    /**
     * Retourne le tableau des personnes
     * @return array
     */
    public function users(): array {
        if ($this->users === null) {
            $this->_hydrate();
        }
        return $this->users;
    }
    
    /**
     * @override Controller::setTemplateName()
     */
    protected function setTemplateName() {
        $className = __CLASS__;
        $position = strpos($className, "Controller");
        $template = strtolower(substr($className, 0, $position));
        
        // Détermine le template à utiliser
        if ($this->request->getData("mode") === null) {
            $this->templateName = __DIR__ . "/Views/" . $template . "List.tpl";
        } else {
            $this->templateName = __DIR__ . "/Views/" . $template . ".tpl";
        }
    }
    
    /**
     * Récupère la liste des utilisateurs via Doctrine
     */
    private function _hydrate() {
        $repository = \Core\ORM\EntityManager::getEntityManager()
            ->getManager()
            ->getRepository(\UserController\Entity\UserEntity::class);
        
        $this->users = $repository->findAll();
    }
    
    /**
     * Récupère un utilisateur par son id
     * @param int $id
     * @return User
     */
    private function _find(int $id): User {
        $repository = \Core\ORM\EntityManager::getEntityManager()
            ->getManager()
            ->getRepository(\UserController\Entity\UserEntity::class);
        
        return $repository->find($id);
    }
}