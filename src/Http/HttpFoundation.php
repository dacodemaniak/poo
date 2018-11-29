<?php
/**
* @name HttpFoundation Inspection des requ�tes HTTP
* @author Artoris - Nov. 2018
* @package \Http
* @version 1.0.0
*/
namespace Http; // Espace dans lequel est d�fini notre classe

class HttpFoundation  implements \Iterator {
    /**
     * Donn�es de la requ�te HTTP
     * @var array
     */
    protected $datas;
    
    /**
     * Pointeur (indice) du tableau $datas
     * @var int
     */
    private $index;

    
    public function __construct() {
        $this->datas = [];
        $this->index = 0;
    }
    
    
    /**
     * Retourne une valeur du tableau $datas � partir d'une cl�
     * @param string $key Cl� du tableau associatif
     * @return string
     */
    public function getData(string $key) {
        if (array_key_exists($key, $this->datas)) {
            return $this->datas[$key];
        }
        return null;
    }
    
    public function __toString() {
        $output = "<ul>";
        foreach($this as $data => $value) {
            $output .= "<li>" . $data . " => " . $value . "</li>";
        }
        $output .= "</ul>";
        return $output;
    }
    
    public function isProcessMode() {
        var_dump($this->datas);
        if( array_key_exists("mode", $this->datas)) {
            return $this->datas["mode"] === "add" || $this->datas["mode"] === "upd";
        }
        return false;
    }
    
    /**
     * Ajoute ou remplace une donn�es dnas $datas
     * @param string $key
     * @param mixed $value
     * @return HttpFoundation
     */
    public function setData(string $key, $value): HttpFoundation {
        $this->datas[$key] = $value;
        return $this;
    }
    
    /**
     * Supprimer une cl� dans les donn�es de la requ�te
     * @param string $key Cl� � supprimer
     */
    public function removeData(string $key) {
        $outKeys = [$key];
        
        $this->datas = array_diff_key($this->datas, array_flip($outKeys));
    }
    
    public function next(){
        next($this->datas);
        $this->index++;
    }
    
    public function valid() {
        return $this->index <= (count($this->datas) - 1);
    }
    
    public function key() {
        return key($this->datas);
    }
    
    public function current() {
        return current($this->datas);
    }
    
    public function rewind() {
        $this->index = 0;
    }
    
    public function __destruct() {}
}
