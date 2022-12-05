<?php

require_once "Cont_Setup.php";
include_once "PDOConnection.php";

class ModSetup extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContSetup();

        switch ($this->controller->getAction()) 
        {
            case "genres":
                $this->controller->genres();
            break;
            case "settingUp":
                $this->controller->settingUp();
            break;
        }

        $this->controller->exec();
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/