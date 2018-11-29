<?php
/**
* @name ControllerInterface Sp�cification des contr�leurs
* @author Artoris - Nov. 2018
* @package Controller
* @version 1.0.0
*/
namespace Controller;

interface ControllerInterface {
    /**
     * Retourne la vue d'un contr�leur
     */
    public function getTemplate(string $templateName = null);
}