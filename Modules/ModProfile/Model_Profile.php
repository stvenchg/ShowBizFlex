<?php

require_once('PDOConnection.php');
require_once('View_Profile.php');

class ModelProfile extends PDOConnection
{

    public function __construct()
    {}

    public function getUserDetails()
    {

        $login = $_SESSION['login'];

        try {
            $stmtLogin = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE username=:login");
            $stmtLogin->bindParam(':login', $login);
            $stmtLogin->execute();
            return $stmtLogin->fetch();
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }
}