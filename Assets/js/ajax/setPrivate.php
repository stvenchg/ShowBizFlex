<?php

require_once('connection.php');

session_start();
extract($_POST);

if (isset($_SESSION['login']) && $_SESSION['id'] == $idUser) {

$stmt = $bdd->prepare("UPDATE User SET private=:private WHERE id=:id");
$stmt->bindParam(':private', $private);
$stmt->bindParam(':id', $idUser);
$stmt->execute();

echo $private;

} else {
    echo 'Non authentifié.';
}