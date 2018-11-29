<?php
/**
* @name EntityManager Service de création du gestionnaire d'entité Doctrine
* @author Artoris - Nov. 2018
* @package Core\ORM
* @version 1.0.0
*/
namespace Core\ORM;

use \Doctrine\ORM\Tools\Setup as Setup;
use \Doctrine\ORM\EntityManager as DoctrineManager;

class EntityManager {
    private static $instance;
    
    /**
     * Stockage des dossiers dans lesquels se trouvent les entités
     * @var array
     */
    private $entityPathes = [];
    
    private $isDevMode = true;
    private $proxyDir = null;
    private $cache = null;
    private $useSimpleAnnotationReader = false;
    
    private $dbParams = [
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'charset'  => 'utf8',
        'user'     => 'poo_dba',
        'password' => 'poo',
        'dbname'   => 'poo_repo',
    ];
    
    /**
     * Gestionnaire d'entité Doctrine proprement dit
     * @var Doctrine\ORM\EntityManager
     */
    private $manager;
    
    private function __construct() {
        $this->entityPathes = [
            join(DIRECTORY_SEPARATOR, [__DIR__, "..", "..", "UserController", "Entity"])
        ];
        
        
        $this->manager = $this->_process();
    }
    
    public static function getEntityManager() {
        if (self::$instance === null) {
            self::$instance = new EntityManager();
        }
        
        return self::$instance;
    }
    
    public function getManager() {
        return $this->manager;
    }
    
    private function _process() {
        $config = Setup::createAnnotationMetadataConfiguration(
            $this->entityPathes,
            $this->isDevMode,
            $this->proxyDir,
            $this->cache,
            $this->useSimpleAnnotationReader
        );
        return DoctrineManager::create($this->dbParams, $config);
    }
}