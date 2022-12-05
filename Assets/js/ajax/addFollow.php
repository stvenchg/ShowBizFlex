<?php
    extract($_POST);

    $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
    $db = new PDO($dsn, 'dutinfopw201637', 'suqebamu');

         try {
            $requestSendFollow = $db->prepare("INSERT INTO FollowedUsers VALUES (:idUser, :idUserFollowed, NULL)");
            $requestSendFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserToFollow));
            echo '0';  
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
?>