<?php

session_start();

include_once("PDOConnection.php");
include_once("Controller.php");

$view;
PDOConnection::initPDO();

$controller = new Controller();
$controller->exec();
	
include_once('Layout.php');


/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>