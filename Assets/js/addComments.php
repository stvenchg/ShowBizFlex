<?php
    extract($_POST);

    $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
    $db = new PDO($dsn, 'dutinfopw201637', 'suqebamu');

    if(!empty($com) && isset($com) && isset($idUser) && isset($idShow)){
        try{
            $requestSendComments = $db->prepare("INSERT INTO Comment VALUES (NULL, :comment, :idUser, :idShow, NULL)");
            $requestSendComments->execute(array(":comment" => $com, "idUser" => $idUser, ":idShow" => $idShow));
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }
   
?>