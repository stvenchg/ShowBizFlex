<?php

require_once("GenericView.php");

require_once("./Components/CompNavigation/Comp_Navigation.php");
require_once("./Components/CompFooter/Comp_Footer.php");

require_once("./Modules/ModAuth/Mod_Auth.php");
require_once("./Modules/ModPanel/Mod_Panel.php");

class Controller
{

    private $view;
    private $module;

    public function __construct()
    {
        $this->view = new GenericView();
        $this->module = isset($_GET['module']) ? $_GET['module'] : "panel";
    }

    public function navigation()
    {
        new CompNavigation();
    }

    public function footer()
    {
        new CompFooter();
    }

    public function exec()
    {
        switch ($this->module) {
            case 'panel':
                new ModPanel();
            break;
            case 'auth':
                new ModAuth();
            break;
            default :
                die("Le module demandé n'existe pas.");
            break;
        }
    }
}
