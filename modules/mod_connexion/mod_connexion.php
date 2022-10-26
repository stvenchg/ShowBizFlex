<?php

include_once "cont_connexion.php";
include_once "connexion.php";

class ModConnexion extends Connexion {
   
    private $control;

    public function __construct() {

        $this->control = new ContConnexion();

        switch ($this->control->getAction()) {
            case "bienvenue":
                $this->control->bienvenue();
                break;
            case "form_connexion":
                $this->control->form_connexion();
                break;
            case "form_inscription":
                $this->control->form_inscription();
                break;
            case "connexion":
                $this->control->connexion();
                break;
            case "inscription":
                $this->control->inscription();
                break;
            case "deconnexion":
                $this->control->deconnexion();
            default:
                break;
        }

        $this->control->exec();

    }



}





?>