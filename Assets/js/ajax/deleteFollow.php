<?php
    extract($_POST);

    require_once('connection.php');

        try {
            $requesteDeleteFollow = $bdd->prepare("DELETE FROM FollowedUsers WHERE idUser = :idUser AND idUserFollowed = :idUserFollowed");
            $requesteDeleteFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserToFollow));
            echo '1';
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
?>