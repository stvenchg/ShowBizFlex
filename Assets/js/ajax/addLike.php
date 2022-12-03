<?php
    extract($_POST);

    $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
    $db = new PDO($dsn, 'dutinfopw201637', 'suqebamu');

    $requesteVerifLike = $db->prepare("SELECT * FROM ListLikes WHERE idUser = :idUser AND idShow = :idShow");
    $requesteVerifLike->execute(array(":idUser" => $idUser, ":idShow" => $idShow));
    $requesteVerifLike2 = $requesteVerifLike->fetch();

    if(!$requesteVerifLike2){
         try {
            $requestSendLike = $db->prepare("INSERT INTO ListLikes VALUES (:idUser, :idShow, NULL)");
            $requestSendLike->execute(array(":idUser" => $idUser, ":idShow" => $idShow));
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
        echo '0';
    }
    else {
        try{
            $requestDeleteLike = $db->prepare("DELETE FROM ListLikes WHERE idUser = :idUser AND idShow = :idShow");
            $requestDeleteLike->execute(array(":idUser" => $idUser, ":idShow" => $idShow));
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
        echo '1';  
    }
       
?>