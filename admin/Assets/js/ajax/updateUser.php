<?php

require_once('connection.php');

session_start();
extract($_POST);

if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == $idUserAdmin && $_SESSION['pin'] == password_verify($pin, $_SESSION['pin'])) {

$stmt = $bdd->prepare('UPDATE User SET username=:username, email=:email, idRole=:idRole, show_setup=:show_setup, about=:about, color=:color, adult=:adult, private=:private WHERE id=:idUser');
$stmt->bindParam(':idUser', $idUser);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':idRole', $idRole);
$stmt->bindParam(':show_setup', $show_setup);
$stmt->bindParam(':about', $about);
$stmt->bindParam(':color', $color);
$stmt->bindParam(':adult', $adult);
$stmt->bindParam(':private', $private);
$stmt->execute();

if ($stmt) {
    echo '1';
}
else {
    echo '0';
}


} else {
    echo '403';
}