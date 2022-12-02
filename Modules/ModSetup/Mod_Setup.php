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
        }

        $this->controller->exec();
    }
}