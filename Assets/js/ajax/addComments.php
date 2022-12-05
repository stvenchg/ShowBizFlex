<?php
    extract($_POST);

    require_once('connection.php');

    if($com != null && isset($com) && isset($idUser) && isset($idShow)){
        try{
            $requestSendComments = $bdd->prepare("INSERT INTO Comment VALUES (NULL, :comment, :idUser, :idShow, NULL)");
            $requestSendComments->execute(array(":comment" => $com, "idUser" => $idUser, ":idShow" => $idShow));
            echo 'NonVide';
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }
    else {
        echo 'Vide';
    }
   
?>