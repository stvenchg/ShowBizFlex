<!DOCTYPE html>
<!--SHOWBIZFLEX-->

<html>
 
<head>
    <meta charset="UTF-8" />
    <link href="style.css" rel="stylesheet" type="text/css">
    <title> index.html </title>
</head>

<body>
    <!--Partie visible du programme-->

    <header>

    <div id="Logos">

        <a href="index.php" id="Logo"><img src="Images/LogoShowBizFlex.png" alt="Logo" /></a>

    </div>

        <?php

        session_start();

        require_once('modules/mod_connexion/mod_connexion.php');
        require_once('connexion.php');

        Connexion::initConnexion();

        $moduleConnexion ; 

        $_GET['module'] = isset($_GET['module']) ? $_GET['module'] : "accueil";

        switch ($_GET['module']) {

            case "accueil":
                echo(" <a href=\"index.php?module=connexion&action=bienvenue\">Connexion</a>");
                echo("<br>");
                break;
            case "connexion":
                if (isset($moduleEquipes)) {
                    $moduleEquipes = null; 
                } 
                if (isset($moduleJoueurs)) {
                    $moduleJoueurs = null; 
                } 
                $moduleConnexion = new ModConnexion();
                break;
        }

        ?>


    </header>

    <main>

   

</main>

<footer>

    <p> Droits d'auteurs : Rachid ABDOULALIME, Steven CHING et Yanis HAMANI - IUT de Montreuil </p> 

</footer>

</body>

</html>
