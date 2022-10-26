<?php

session_start();

include_once("./Database/PDOConnection.php");
include_once("Controller.php");

PDOConnection::getPDO();

$view;

$controller = new Controller();
$controller -> exec();
	
include_once('Layout.php');