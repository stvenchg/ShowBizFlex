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
            case "viewProfile":
                $this->controller->profile();
            break;
        }

        $this->controller->exec();
    }
}