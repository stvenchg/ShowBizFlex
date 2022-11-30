<?php
    extract($_POST);

    $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201637;charset=UTF8";
    $bdd = new PDO($dsn, 'dutinfopw201637', 'suqebamu');
?>