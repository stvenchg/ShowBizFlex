<?php

session_start();
extract($_POST);

if (isset($_SESSION['login']) && $_SESSION['id'] == $idUser) {


$dsn = "mysql:host=localhost;dbname=dutinfopw201637;charset=UTF8";
$bdd = new PDO($dsn, 'root', '');

$stmtLogin = $bdd->prepare("UPDATE User SET adult=:adult WHERE id=:id");
$stmtLogin->bindParam(':adult', $adult);
$stmtLogin->bindParam(':id', $idUser);
$stmtLogin->execute();

echo $adult;

if ($adult == 1)
{
    $_SESSION['adult'] = 1;
} else {
    $_SESSION['adult'] = 0;
}

} else {
    echo 'Non authentifié.';
}