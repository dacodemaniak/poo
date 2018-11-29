<?php
/**
* @name UrlInterface Définition de la méthode de création des urls
* @author Artoris
* @package Controller
* @version 1.0.0
*/
namespace Controller;

interface UrlInterface {
    public function createUrl(string $module=null, string $mode=null, int $id=null): string;
}