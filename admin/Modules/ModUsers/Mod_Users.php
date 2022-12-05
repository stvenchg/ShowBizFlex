<?php

require_once "Cont_Users.php";
include_once "PDOConnection.php";

class ModUsers extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContUsers();

        switch ($this->controller->getAction()) 
        {
            case "overview":
                $this->controller->overview();
            break;
            case "createUser":
                $this->controller->createUser();
            break;
            case "editUser":
                $this->controller->editUser();
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
?>