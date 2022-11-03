<?php

require_once "Cont_Auth.php";
include_once "PDOConnection.php";

class ModAuth extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContAuth();

        switch ($this->controller->getAction()) 
        {
            case "register":
                $this->controller->register();
            break;
            case "sendRegister":
                $this->controller->sendRegister();
            break;
            case "login":
                $this->controller->login();
            break;
            case "sendConnection":
                $this->controller->sendLogin();
            break;
            case "logout":
                $this->controller->logout();
            break;
        }

        $this->controller->exec();
    }
}