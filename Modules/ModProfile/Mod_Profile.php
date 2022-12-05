<?php

require_once "Cont_Profile.php";
include_once "PDOConnection.php";

class ModProfile extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContProfile();

        switch ($this->controller->getAction()) 
        {
            case "view":
                $this->controller->viewProfile();
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