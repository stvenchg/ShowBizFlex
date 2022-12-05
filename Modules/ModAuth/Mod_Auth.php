<?php

require_once "Cont_Auth.php";
include_once "PDOConnection.php";
include_once "token.php";

class ModAuth extends PDOConnection
{

    private $controller;

    public function __construct()
    {
        $this->controller = new ContAuth();

        switch ($this->controller->getAction()) 
        {
            case "register":
                token_creation();
                $this->controller->register();
            break;
            case "sendRegister":
                if(verify_token($_POST['token'])) {
                    $this->controller->sendRegister();
                    delete_token();
                }             
            break;
            case "login":
                token_creation();
                $this->controller->login();
            break;
            case "sendLogin":
                if(verify_token($_POST['token'])) {
                    $this->controller->sendLogin();
                    delete_token();
                }          
            break;
            case "logout":
                $this->controller->logout();
            break;
            case "forgot":
                token_creation();
                $this->controller->forgot();
            break;
            case "sendForgot":
                if(verify_token($_POST['token'])) {
                    $this->controller->sendForgot();
                    delete_token();
                }    
            break;
            case "resetPassword":
                token_creation();
                $this->controller->resetPassword();
            break;
            case "sendResetPassword":
                if(verify_token($_POST['token'])) {
                    $this->controller->sendResetPassword();
                    delete_token();
                }    
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