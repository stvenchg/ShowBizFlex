<?php
    extract($_POST);

    require_once('connection.php');

         try {
            $requestSendFollow = $bdd->prepare("INSERT INTO FollowedUsers VALUES (:idUser, :idUserFollowed, NULL)");
            $requestSendFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserToFollow));
            echo '0';  
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
?>