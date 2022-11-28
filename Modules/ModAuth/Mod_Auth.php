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
            case "sendLogin":
                $this->controller->sendLogin();
            break;
            case "logout":
                $this->controller->logout();
            break;
            case "forgot":
                $this->controller->forgot();
            break;
            case "sendForgot":
                $this->controller->sendForgot();
            break;
            case "resetPassword":
                $this->controller->resetPassword();
            break;
            case "sendResetPassword":
                $this->controller->sendResetPassword();
            break;
        }

        $this->controller->exec();
    }
}