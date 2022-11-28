<?php

require_once "Cont_Home.php";
include_once "PDOConnection.php";

class ModHome extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContHome();

        switch ($this->controller->getAction()) 
        {
            case "home":
                $this->controller->home();
            break;
        }

        $this->controller->exec();
    }
}