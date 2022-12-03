<?php
    extract($_POST);

    $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
    $db = new PDO($dsn, 'dutinfopw201637', 'suqebamu');

        try {
            $requesteDeleteFollow = $db->prepare("DELETE FROM FollowedUsers WHERE idUser = :idUser AND idUserFollowed = :idUserFollowed");
            $requesteDeleteFollow->execute(array(":idUser" => $idUser, ":idUserFollowed" => $idUserToFollow));
            echo '1';
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
?>