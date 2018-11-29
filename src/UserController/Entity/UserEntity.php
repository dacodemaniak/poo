<?php
/**
* @name UserEntity Mapping objet des Utilisateurs
* @author Artoris - Nov. 2018
* @package UserController\Entity
* @version 1.0.0
*/
namespace UserController\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserEntity {
    /**
     * Identifiant de l'utilisateur
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * Nom de l'utilisateur
     * @var string
     * 
     * @ORM\Column(type="string", length=75, name="name")
     */
    protected $name;
    
    /**
     * Prénom de l'utilisateur
     * @var string
     * 
     * @ORM\Column(type="string", length=75, name="firstname")
     */
    protected $firstName;
    
    /**
     * Nom d'utilisateur / login
     * @var string
     * 
     * @ORM\Column(type="string", length=75, name="username")
     */
    protected $userName;
    
    /**
     * Mot de passe
     * @var string
     * 
     * @ORM\Column(type="string", length=32, name="password")
     */
    protected $password;
    
    /**
     * Définit ou retourne l'identifiant utilisateur
     * @param int $id
     * @return int | \UserController\Entity\UserEntity
     */
    public function id(int $id = null) {
        if ($id === null) {
            return $this->id;
        }
        
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * D�finit ou retourne le nom de l'utilisateur
     * @param string $name
     * @return string |\UserController\Entity\UserEntity
     */
    public function name(string $name = null) {
        if ($name === null) {
            return $this->name;
        }
        
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * D�finit ou retourne le pr�nom de l'utilisateur
     * @param string $firstName
     * @return string |\UserController\Entity\UserEntity
     */
    public function firstName(string $firstName = null) {
        if ($firstName === null) {
            return $this->firstName;
        }
        
        $this->firstName = $firstName;
        
        return $this;
    }

    /**
     * D�finit ou retourne le login de l'utilisateur
     * @param string $userName
     * @return string |\UserController\Entity\UserEntity
     */
    public function userName(string $userName = null) {
        if ($userName === null) {
            return $this->userName;
        }
        
        $this->userName = $userName;
        
        return $this;
    }
    
    /**
     * D�finit ou retourne le mot de passe de l'utilisateur
     * @param string $password
     * @return string |\UserController\Entity\UserEntity
     */
    public function password(string $password = null) {
        if ($password === null) {
            return $this->password;
        }
        
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * M�thode magique appel�e si une m�thode n'existe pas
     * @param string $methodName
     * @return string
     */
    public function __call(string $methodName, array $parameters): string {
        if (strtolower($methodName) === "getname") {
            return $this->firstName() . " " . $this->name();
        }
    }
}