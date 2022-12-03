<?php
    extract($_POST);

    $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
    $db = new PDO($dsn, 'dutinfopw201637', 'suqebamu');

    $requesteVerifFollow = $db->prepare("SELECT * FROM FollowedUsers WHERE idUser = :idUser AND idUserFollowed = :idUserFollowed");
    $requesteVerifFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserToFollow));
    $requesteVerifFollow = $requesteVerifFollow->fetch();

    if(!$requesteVerifFollow){
         try{
            $requestSendFollow = $db->prepare("INSERT INTO FollowedUsers VALUES (:idUser, :idUserFollowed, NULL)");
            $requestSendFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserToFollow));
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
        echo '0';
    }  
?>