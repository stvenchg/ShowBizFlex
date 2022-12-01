<?php

session_start();

include_once("PDOConnection.php");
include_once("Controller.php");

$view;
PDOConnection::initPDO();

$controller = new Controller();
$controller->exec();
	
include_once('Layout.php');