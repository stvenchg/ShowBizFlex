<?php

require_once('connection.php');

session_start();
extract($_POST);

if (isset($_SESSION['login']) && $_SESSION['id'] == $idUser && $_SESSION['show_setup'] == 1) {
    foreach ($idGenre as $genre) {
        $stmt = $bdd->prepare("INSERT INTO `FavGenres` (`idUser`, `idGenre`) VALUES (:idUser, :idGenre)");
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':idGenre', $genre);
        $stmt->execute();
    }

    echo '1';
} else {
    'Pas autorisé.';
}