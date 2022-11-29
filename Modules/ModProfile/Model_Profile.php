<?php

require_once('PDOConnection.php');

class ModelProfile extends PDOConnection {

    public function __construct() {

    }

    public function getUserDetails() {
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

    public function sendfollowedsUsers(){
        $idUser = $_GET['idUser'];
        $idUserFollowed = $_GET['idFollowedUser'];

        try {
            $stmtId = parent::$db->prepare("INSERT INTO FollowedUsers value (?, ?)");
            $stmtId->execute(array($idUser, $idUserFollowed));

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function getFollowedUsersList(){
        $idUserForShowList = $_GET['idFollowedUser'];
        try {
            $stmtUserFollowedList = parent::$db->prepare("SELECT * FROM User NATURAL JOIN FollowedShows WHERE idUser = ?");
            $stmtUserFollowedList->execute(array($idUserForShowList));
            return $stmtUserFollowedList->fetchAll();

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