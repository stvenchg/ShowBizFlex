<?php

require_once('connection.php');

session_start();
extract($_POST);

$email = $_SESSION["email"];

if (isset($_SESSION['login']) && $_SESSION['id'] == $idUser) {

$stmtLogin = $bdd->prepare("UPDATE User SET adult=:adult WHERE id=:id");
$stmtLogin->bindParam(':adult', $adult);
$stmtLogin->bindParam(':id', $idUser);
$stmtLogin->execute();

echo $adult;

if ($adult == 1)
{
    $_SESSION['adult'] = 1;
    $parameterValue = 'Activé';
} else {
    $_SESSION['adult'] = 0;
    $parameterValue = 'Désactivé';
}

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