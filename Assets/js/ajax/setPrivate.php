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



/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>