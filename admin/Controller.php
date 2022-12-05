<?php

require_once("GenericView.php");

require_once("Components/CompNavigation/Comp_Navigation.php");
require_once("Components/CompFooter/Comp_Footer.php");

require_once("Modules/ModAuth/Mod_Auth.php");
require_once("Modules/ModPanel/Mod_Panel.php");
require_once("Modules/ModUsers/Mod_Users.php");

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
            case 'users':
                new ModUsers();
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


/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>