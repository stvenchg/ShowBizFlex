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
                $this->controller->profil();
            break;

            case "viewOtherProfile":
                $this->controller->otherProfile();
            break;

            case "followsUsers";
            $this->controller->follow();
        }

        $this->controller->exec();
    }
}