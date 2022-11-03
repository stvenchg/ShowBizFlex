<?php

session_start();

include_once("PDOConnection.php");
include_once("Controller.php");

PDOConnection::initConnection();

$view;

$controller = new Controller();
$controller -> exec();
	
include_once('Layout.php');