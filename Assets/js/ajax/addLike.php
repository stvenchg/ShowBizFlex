<?php
    extract($_POST);

   require_once('connection.php');

    $requesteVerifLike = $bdd->prepare("SELECT * FROM ListLikes WHERE idUser = :idUser AND idShow = :idShow");
    $requesteVerifLike->execute(array(":idUser" => $idUser, ":idShow" => $idShow));
    $requesteVerifLike2 = $requesteVerifLike->fetch();

    if(!$requesteVerifLike2){
         try {
            $requestSendLike = $bdd->prepare("INSERT INTO ListLikes VALUES (:idUser, :idShow, NULL)");
            $requestSendLike->execute(array(":idUser" => $idUser, ":idShow" => $idShow));
            echo '0';
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }
    else {
        try{
            $requestDeleteLike = $bdd->prepare("DELETE FROM ListLikes WHERE idUser = :idUser AND idShow = :idShow");
            $requestDeleteLike->execute(array(":idUser" => $idUser, ":idShow" => $idShow));
            echo '1';  
        }
        catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        } 
    }
       
?>


<?php
/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>