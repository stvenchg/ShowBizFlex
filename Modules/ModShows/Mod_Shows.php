<?php

require_once "Cont_Shows.php";
include_once "PDOConnection.php";

class ModShows extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContShows();

        switch ($this->controller->getAction()) 
        {
            case "overview":
                $this->controller->overview();
            break;
            
            case"deleteComments":
                $this->controller->deleteCom();
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