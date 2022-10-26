<?php

require_once('modele_connexion.php');
require_once('vue_connexion.php');

class ContConnexion {

    private $vue;
    private $modele;
    private $action;

    public function __construct() {
        $this->vue = new VueConnexion();
        $this->modele = new ModeleConnexion();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue";
    }

    public function bienvenue() {
        if (isset($_SESSION['username'])) {
            echo 'Vous êtes connecté avec le profil de '.$_SESSION['username'];
        } else {
            echo 'Vous n\'êtes pas connecté';
        }
    }

    public function form_connexion() {
        $this->vue->form_connexion();
    }

    public function form_inscription() {
        $this->vue->form_inscription();
    }

    public function connexion() {
        $this->modele->connexion();
    }

    public function inscription() {
        $this->modele->inscription();
    }

    public function deconnexion() {
        $this->modele->deconnexion();
    }

    public function exec() {
        $this->vue->menu();
    }

    public function getAction() {
        return $this->action;
    }

}

?>