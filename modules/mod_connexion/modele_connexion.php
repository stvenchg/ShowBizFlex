<?php

require_once('connexion.php');

class ModeleConnexion extends Connexion {

    public $liste;
    public $liste2;

    public function __construct(){
        
    }
    
    public function inscription() {
        $sql4 = 'SELECT username FROM Utilisateur WHERE username = :username';
        $requete4 = parent::$bdd->prepare($sql4);
        $requete4->execute(array(':username'=>$_POST['username']));
        $verif2 = $requete4->fetch();

        $sql7 = 'SELECT email FROM Utilisateur WHERE email = :email';
        $requete7 = parent::$bdd->prepare($sql7);
        $requete7->execute(array(':email'=>$_POST['email']));
        $verif7 = $requete7->fetch();

        if(!$verif2 && !$verif7 && $_POST['mdp'] != null) {
            $sql3 = 'INSERT INTO Utilisateur VALUES (NULL, :username, :email, :mdp, 2)';
            $requete3 = parent::$bdd->prepare($sql3);
            $requete3->execute(array(':username'=>$_POST['username'], ':email'=>$_POST['email'], ':mdp'=>password_hash($_POST['mdp'], PASSWORD_DEFAULT)));
            echo 'Inscription reussie !';
        }else {
            echo 'Echec de l\'inscription : Username nul ou deja existant ! <br> ';
        }

    }

    public function connexion() {
        $sql2 = 'SELECT * FROM Utilisateur WHERE username = :username';
        $requete2 = parent::$bdd->prepare($sql2);
        $requete2->execute(array(':username'=>$_POST['username']));
        $verif = $requete2->fetch();

        if($verif && password_verify($_POST['mdp'], $verif['mdp'])) { 
            $_SESSION['username'] = $verif['username'];
            echo 'Connexion reussie !';
        } else {
            echo 'Echec de la connexion : un ou plusieurs termes sont incorrects ! <br> ';
        }

    }

    public function deconnexion() {
        if (isset($_SESSION['username'])) {
            session_unset();
            session_destroy();
            echo 'Deconnexion reussie ! ';
        } 
    }


}


?>