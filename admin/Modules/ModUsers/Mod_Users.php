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
        }

        $this->controller->exec();
    }
}