<?php
/**
* @name UrlInterface D�finition de la m�thode de cr�ation des urls
* @author Artoris
* @package Controller
* @version 1.0.0
*/
namespace Controller;

interface UrlInterface {
    public function createUrl(string $module=null, string $mode=null, int $id=null): string;
}