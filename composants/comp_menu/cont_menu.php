<?php

require_once('modele_menu.php');
require_once('vue_menu.php');

class ContMenu {

    private $vue;
    private $modele;


    public function __construct() {
        $this->vue = new VueMenu();
        $this->modele = new ModeleMenu();
    }

    public function exec() {
        return $this->vue->affiche();
    }

}

?>