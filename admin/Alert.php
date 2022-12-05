<?php

require_once("GenericView.php");

class Alert extends GenericView
{

    public function __construct()
    {
        parent::__construct();
    }

    //  Alert for ModAuth
    public function alreadyAuthenticated()
    {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Tu es déjà connecté.',
            'error'
          ).then(function() {
            window.location = './';
        });</script>";
    }

    public function logoutSuccessful() {
        echo "<script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Déconnexion réussie !',
        showConfirmButton: false,
        timer: 950
        }).then(function() {
            window.location = './';
        });</script>";
    }

    public function logoutError() {
        echo "<script>Swal.fire({
            'Il y a un problème !',
            'Tu es déjà déconnecté.',
            'error'
          ).then(function() {
            window.location = './';
        });</script>";
    }

    public function invalidLoginDetails() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Les informations d\'identification fournies ne sont pas valides.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=login';
        });</script>";
    }

    public function unknownErrorWhileRegistration() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Une erreur est survenue. Merci de recommencer ton inscription.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function registrationSuccessful()
    {
        echo "<script>Swal.fire(
            'Inscription validée !',
            'Le compte administrateur a été crée.',
            'success'
          ).then(function() {
            window.location = './?module=auth&action=login';
        });</script>";
    }

    public function usernameAndPasswordAlreadyUsed() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Ce nom d\'utilisateur ainsi que cet email sont déjà utilisés.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function emailAlreadyUsed() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Cet email est déjà utilisé.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function usernameAlreadyUsed() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Ce nom d\'utilisateur est déjà utilisé.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function usernameTooShort() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le nom d\'utilisateur saisi est trop court. Il doit comporter au moins 4 caractères.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function specialCharsInUsername() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le nom d\'utilisateur doit uniquement être constitué de chiffres et de lettres.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function invalidEmail() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'L\'adresse e-mail saisie est incorrecte.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function passwordDifferents() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Les mots de passe saisis ne sont pas identiques.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function passwordTooShort() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le mot de passe saisi est trop court. Il doit comporter au moins 4 caractères.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function invalidRequest() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'La requête est invalide.',
            'error'
          ).then(function() {
            window.location = './';
        });</script>";
    }

    public function pinDifferents() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Les codes pin saisis ne sont pas identiques.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function pinOnlyNumberAllowed() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le code pin doit être uniquement constitué de chiffres.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
        });</script>";
    }

    public function notAllowedPage() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Vous n'êtes pas autorisé à accéder à cette page.',
            'error'
          ).then(function() {
            window.location = './';
        });</script>";
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>