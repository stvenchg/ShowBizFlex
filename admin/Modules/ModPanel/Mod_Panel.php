<?php

require_once "Cont_Panel.php";
include_once "PDOConnection.php";

class ModPanel extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContPanel();

        switch ($this->controller->getAction()) 
        {
            case "dashboard":
                $this->controller->dashboard();
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