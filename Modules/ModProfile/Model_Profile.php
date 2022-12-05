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


    public function verifcationfollowedsUsers(){
        $idUser = $_SESSION['id'];
        $idUserFollowed = $_GET['id'];

        try {
            $requesteVerifFollow = parent::$db->prepare("SELECT * FROM FollowedUsers WHERE idUser = :idUser AND idUserFollowed = :idUserFollowed");
            $requesteVerifFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserFollowed));
            $requesteVerifFollow = $requesteVerifFollow->fetch();
            return $requesteVerifFollow;
            
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }


    /*
    public function getFollowedUsersList(){
        $idUserForShowList = $_GET['idFollowedUser'];
        try {
            $stmtUserFollowedList = parent::$db->prepare("SELECT * FROM User NATURAL JOIN FollowedShows WHERE idUser = ?");
            $stmtUserFollowedList->execute(array($idUserForShowList));
            return $stmtUserFollowedList->fetchAll();

        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }*/

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

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/