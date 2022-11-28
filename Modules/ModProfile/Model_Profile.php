<?php

require_once('PDOConnection.php');

class ModelProfile extends PDOConnection
{

    public function __construct()
    {}

    public function getUserDetails()
    {

        $login = $_SESSION['login'];

        try {
            $stmtLogin = parent::$db->prepare("SELECT * FROM User WHERE username=:login");
            $stmtLogin->bindParam(':login', $login);
            $stmtLogin->execute();
            return $stmtLogin->fetchAll();

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function getOtherUser(){
        try{
            $stmtId = parent::$db->prepare("SELECT * FROM User WHERE id = $_GET[id]");
            $stmtId->execute();
            return $stmtId->fetchAll();

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }


}