<?php

require_once('connection.php');

session_start();
extract($_POST);

$acceptedGenres = array(16, 18, 35, 37, 80, 99, 9648, 10751, 10759, 10762, 10763, 10764, 10765, 10766, 10767, 10768);

if (isset($_SESSION['login']) && $_SESSION['id'] == $idUser && $_SESSION['show_setup'] == 1) {
    foreach ($idGenre as $genre) {
        if (in_array($genre, $acceptedGenres)) {
            $stmt = $bdd->prepare("INSERT INTO `FavGenres` (`idUser`, `idGenre`) VALUES (:idUser, :idGenre)");
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':idGenre', $genre);
            $stmt->execute();
        }
    }
    
    $_SESSION['show_setup'] = '0';
    $_SESSION['setupCompleted'] = '1';

    $stmt = $bdd->prepare("UPDATE User SET show_setup=0 WHERE id=:idUser");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();

    echo '1';

} else {
    'Pas autorisé.';
}