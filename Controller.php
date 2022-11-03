<?php

require_once("GenericView.php");
require_once("./Components/CompNavigation/Comp_Navigation.php");
require_once("./Components/CompFooter/Comp_Footer.php");
require_once("./Modules/ModAuth/Mod_Auth.php");
require_once("./Modules/ModHome/Mod_Home.php");

use Components\CompNavigation\CompNavigation;
use Components\CompFooter\CompFooter;
use Modules\ModAuth\ModAuth;
use Modules\ModHome\ModHome;

class Controller
{

    private $view;
    private $module;

    public function __construct()
    {
        $this->view = new GenericView();
        $this->module = isset($_GET['module']) ? $_GET['module'] : "home";
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
            case 'home':
                new ModHome();
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
