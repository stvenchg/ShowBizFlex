<?php

require_once('connection.php');

session_start();
extract($_POST);

if (isset($_SESSION['login']) && $_SESSION['id'] == $idUser) {

$stmt = $bdd->prepare("UPDATE User SET color=:color WHERE id=:id");
$stmt->bindParam(':color', $color);
$stmt->bindParam(':id', $idUser);

if ($stmt->execute()) {
    echo '1';
} else {
    echo '0';
}

} else {
    echo 'Non authentifié.';
}