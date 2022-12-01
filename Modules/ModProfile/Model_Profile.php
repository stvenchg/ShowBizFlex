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

    public function getUserShowInListsCount() {
        try{
            $stmt1 = parent::$db->prepare("SELECT count(*) FROM towatchlatershows WHERE idUser=$_GET[id]");
            $stmt1->execute();
            $results1 = $stmt1->fetch();

            $stmt2 = parent::$db->prepare("SELECT count(*) FROM followedshows WHERE idUser=$_GET[id]");
            $stmt2->execute();
            $results2 = $stmt2->fetch();

            return $results1[0] + $results2[0];

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

}