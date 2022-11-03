<?php

namespace Modules\ModAuth;

require_once "PDOConnection.php";

use PDOConnection;

class ModelAuth extends PDOConnection 
{
    public function __construct()
    {}

    public function sendRegister() 
    {
        
    }

    public function sendLogin() 
    {
        
    }

    public function logout() 
    {
        session_unset();
        session_destroy();
    }
}