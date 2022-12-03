<?php

require_once("GenericView.php");

require_once("Components/CompNavigation/Comp_Navigation.php");
require_once("Components/CompFooter/Comp_Footer.php");

require_once("Modules/ModAuth/Mod_Auth.php");
require_once("Modules/ModHome/Mod_Home.php");
require_once("Modules/ModProfile/Mod_Profile.php");
require_once("Modules/ModSettings/Mod_Settings.php");
require_once("Modules/ModShows/Mod_Shows.php");
require_once("Modules/ModSearch/Mod_Search.php");
require_once("Modules/ModLists/Mod_Lists.php");
require_once("Modules/ModSetup/Mod_Setup.php");

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
            case 'profile':
                new ModProfile();
            break;
            case 'settings':
                new ModSettings();
            break;
            case 'shows':
                new ModShows();
            break;
            case 'search':
                new ModSearch;
            break;
            case 'lists':
                new ModLists;
            break;
            case 'setup':
                new ModSetup;
            break;
            default :
                die("Le module demandé n'existe pas.");
            break;
        }
    }
}
