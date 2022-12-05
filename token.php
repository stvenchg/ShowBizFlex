<?php

     function token_creation() {
        $bytes = random_bytes(20);
        $_SESSION['token'] = bin2hex($bytes);
        $_SESSION['token_date'] = time();
    }

    function verify_token($token){
      return  $token==$_SESSION['token']&& time() - $_SESSION['token_date'] < 9000;   
    }
      
    function delete_token(){
        unset($_SESSION['token']);
        unset( $_SESSION['token_date']);
    }
?>