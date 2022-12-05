<?php

require_once "Cont_Lists.php";
include_once "PDOConnection.php";

class ModLists extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContLists();

        switch ($this->controller->getAction()) 
        {
            case "lists":
                $this->controller->lists();
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