<?php
/**
* @name HttpFoundation Inspection des requêtes HTTP
* @author Artoris - Nov. 2018
* @package \Http
* @version 1.0.0
* @version 1.0.1
*   Ajout de l'attribut httpVerb
*/
namespace Http; // Espace dans lequel est défini notre classe

class HttpFoundation  implements \Iterator {
    /**
     * Données de la requête HTTP
     * @var array
     */
    protected $datas;
    
    
    protected $uri;
    
    /**
     * Pointeur (indice) du tableau $datas
     * @var int
     */
    private $index;

    /**
     * Verbe HTTP utilisé dans la requête
     * @var string
     */
    protected $httpVerb;
    
    public function __construct() {
        $this->datas = [];
        $this->index = 0;
    }
    
    /**
     * Retourne le verbe HTTP utilisé pour l'appel
     * @return string
     */
    public function getHttpVerb(): string {
        return $this->httpVerb !== null ? $this->httpVerb : "GET";
    }
    
    /**
     * Retourne une valeur du tableau $datas à partir d'une clé
     * @param string $key Clé du tableau associatif
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
     * Ajoute ou remplace une données dnas $datas
     * @param string $key
     * @param mixed $value
     * @return HttpFoundation
     */
    public function setData(string $key, $value): HttpFoundation {
        $this->datas[$key] = $value;
        return $this;
    }
    
    /**
     * Supprimer une clé dans les données de la requête
     * @param string $key Clé à supprimer
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
