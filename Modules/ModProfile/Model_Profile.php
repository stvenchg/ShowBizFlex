<?php

require_once('PDOConnection.php');

class ModelProfile extends PDOConnection {

    public function __construct() {
    }

    public function getUserDetails() {

        $id = htmlspecialchars($_GET['id']);
        
        try{
            $stmt = parent::$db->prepare("SELECT * FROM User WHERE id = $id");
            $stmt->execute();
            return $stmt->fetchAll();

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

    public function getUserShowInListsCount() {

        $id = htmlspecialchars($_GET['id']);

        try{
            $stmt1 = parent::$db->prepare("SELECT count(*) FROM towatchlatershows WHERE idUser=$id");
            $stmt1->execute();
            $results1 = $stmt1->fetch();

            $stmt2 = parent::$db->prepare("SELECT count(*) FROM followedshows WHERE idUser=$id");
            $stmt2->execute();
            $results2 = $stmt2->fetch();

            return $results1[0] + $results2[0];

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function getUserComments() {

        $id = htmlspecialchars($_GET['id']);

        try{
            $stmt = parent::$db->prepare("SELECT count(*) FROM comment WHERE id=$id");
            $stmt->execute();
            $results = $stmt->fetch();

            return $results[0];

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function getUserActivity() {

        $id = htmlspecialchars($_GET['id']);
        $userActivityString = '';

        try{
            $stmt = parent::$db->prepare("SELECT * FROM followedshows WHERE idUser=$id ORDER BY addDate DESC LIMIT 0, 30");
            $stmt->execute();
            $results = $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }

        foreach ($results as $index => $value) {
            $userActivityString .= '<div class="activity-item">
            <h1>Série ajoutée à la liste de suivi.</h1>
            <p>Série <a href="./?module=shows&action=overview&id=' . $value['idShow'] . '">'. $value['idShow'] .'</a> | Le '. $value['addDate'] .'</p>
        </div>';
        }

        return $userActivityString;
    }
}