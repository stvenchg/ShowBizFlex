<?php

class VueMenu {

    private $menu;

    public function __construct() {
        $this->menu = "<a href=\"index.php?module=connexion&action=bienvenue\" id=\"lien\">Connexion</a>";
    }
    
    public function affiche() {
        return $this->menu;
    }

}

?>