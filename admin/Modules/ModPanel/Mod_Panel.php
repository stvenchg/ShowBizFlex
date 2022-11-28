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
            case "home":
                $this->controller->home();
            break;
        }

        $this->controller->exec();
    }
}