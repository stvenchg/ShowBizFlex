<?php

require_once('vue_generique.php');

class VueConnexion extends VueGenerique {
    
    public function __construct () {
        parent::__construct();
    }

    public function menu() {
        /*
        if (!isset($_SESSION['username'])) {
            echo("<br>");
            echo(" <a href=\"index.php?module=connexion&action=form_connexion\" id=\"lien\">Connexion</a>");
            echo("<br>");
            echo(" <a href=\"index.php?module=connexion&action=form_inscription\" id=\"lien\">Inscription</a>");
        }
        echo("<br>");
        
        if (isset($_SESSION['username'])) {
            echo("<br>");
            echo(" <a href=\"index.php?module=connexion&action=deconnexion\" id=\"lien\">Deconnexion</a>");
        }
        echo("<br>");
        */
    }

    public function form_inscription() {
        echo'<h1>Inscription</h1>
        
            <form action="index.php?module=connexion&action=inscription" method="post">
		        <label for="username">Username</label>
                <input type="text" name="username" />

                <label for="email">Email</label>
                <input type="email" name="email" />


                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" />
		        
                <input type="submit" name="s\'inscrire"/>
            </form>';
    }

    public function form_connexion() {
        echo'<h1>Connexion</h1>
        
            <form action="index.php?module=connexion&action=connexion" method="post">
		        <label for="username">Username</label>
                <input type="text" name="username" />
                
                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" />
		        
                <input type="submit" name="se connecter"/>
            </form>';       
    }

    public function confirm_connexion() {
        echo 'Connexion reussie';
    }

    public function confirm_inscription() {
        echo 'Inscription reussie';
    }


}


?>