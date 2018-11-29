<?php
/**
* @name ControllerInterface Spécification des contrôleurs
* @author Artoris - Nov. 2018
* @package Controller
* @version 1.0.0
*/
namespace Controller;

interface ControllerInterface {
    /**
     * Retourne la vue d'un contrôleur
     */
    public function getTemplate(string $templateName = null);
}