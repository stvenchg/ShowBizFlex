<?php

require_once('cont_menu.php');

class CompMenu {

    private $control; 

    public function __construct() {
        $this->control = new ContMenu();
    }

    public function affiche() {
        echo $this->control->exec();
    }

    

}

?>