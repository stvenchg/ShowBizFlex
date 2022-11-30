<?php

extract($_POST);

$dsn = "mysql:host=localhost;dbname=dutinfopw201637;charset=UTF8";
$bdd = new PDO($dsn, 'root', '');

$sql = 'SELECT * FROM Show WHERE idShow = :idShow';
$showExist=$bdd->prepare($sql);
$showExist->execute(array(':idShow'=>$idShow));
$verif = $showExist->fetch();

if(!$verif){
    $sql2 = 'INSERT INTO `Show` (`idShow`, `rating`) VALUES (:idShow, NULL)';
    $sth=$bdd->prepare($sql2);
    $sth->execute(array(':idShow'=>$idShow));
}

$verifShowInWatchLater=$bdd->prepare('SELECT * FROM ToWatchLaterShows WHERE idUser=:idUser AND idShow=:idShow');
$verifShowInWatchLater->execute(array(':idUser'=>$idUser,':idShow'=>$idShow));
$row = $verifShowInWatchLater->fetch();

if(!$row){
    $sql3 = 'INSERT INTO `ToWatchLaterShows` (`idUser`, `idShow`) VALUES (?, ?)';
    $inser=$bdd->prepare($sql3);
    $inser->execute(array($idUser,$idShow));

    echo '1';
 }
 
 else{

    $inser=$bdd->prepare('DELETE FROM ToWatchLaterShows WHERE idUser=:idUser AND idShow=:idShow');
    $inser->execute(array(':idUser'=>$idUser,':idShow'=>$idShow));

    echo '0';
 }
 


?>