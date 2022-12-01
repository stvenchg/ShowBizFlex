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
            case "myProfile":
                $this->controller->myProfile();
            break;

            case "view":
                $this->controller->viewProfile();
            break;
        }

        $this->controller->exec();
    }
}