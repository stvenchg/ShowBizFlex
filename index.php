
<?php

    session_start();

    require_once('modules/mod_connexion/mod_connexion.php');
    require_once('connexion.php');
    require_once('vue_generique.php');
    require_once('composants/comp_menu/comp_menu.php');
    

    Connexion::initConnexion();

    $moduleConnexion ; 

    $affichage;

    $vueGenerique = new VueGenerique;
  
    

    $_GET['module'] = isset($_GET['module']) ? $_GET['module'] : "accueil";

    switch ($_GET['module']) {

        case "accueil":
            $vueGenerique->affichage();
            break;
        case "connexion":
            $moduleConnexion = new ModConnexion();
            if (!isset($_SESSION['username'])) {
                echo("<br>");
                echo(" <a href=\"index.php?module=connexion&action=form_connexion\" id=\"lien\">Connexion</a>");
                echo("<br>");
                echo(" <a href=\"index.php?module=connexion&action=form_inscription\" id=\"lien\">Inscription</a>");
            } else {
                echo("<br>");
                echo(" <a href=\"index.php?module=connexion&action=deconnexion\" id=\"lien\">Deconnexion</a>");
            }
            echo("<br>");
            $vueGenerique->affichage();
            break;
        default:
            die("module inconnu");
            break;
    }

    $composantMenu = new CompMenu();
    require_once('template.php');

?>

