<?php

require_once("./GenericView.php");

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
            'Tu recevras dans un instant un e-mail de confirmation.',
            'success'
          ).then(function() {
            window.location = './?module=auth&action=login';
        });</script>";
    }

    public function userDidNotAcceptedTOS() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Il est nécessaire d\'accepter les conditions générales d'utilisation.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=register';
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

    // Alert for ModSettings
    public function userNotAuthenticated() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Tu n\'es pas connecté.',
            'error'
          ).then(function() {
            window.location = './?module=auth&action=login';
        });</script>";
    }

    public function fileTransferError() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le transfert du fichier a échoué. Merci de réessayer.',
            'error'
          ).then(function() {
            window.location = './?module=settings&action=uploadAvatar';
        });</script>";
    }

    public function fileTransferSuccess() {
        echo "<script>Swal.fire(
            'Importation réussie !',
            'Le fichier a bien été chargé et ta photo de profil a été mise à jour.',
            'success'
          ).then(function() {
            window.location = './?module=settings';
        });</script>";
    }

    public function fileInvalidExt() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Uniquement les fichiers au format .PNG sont acceptés.',
            'error'
          ).then(function() {
            window.location = './?module=settings&action=uploadAvatar';
        });</script>";
    }

    public function fileTooBig() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le poids du fichier sélectionné dépasse la limite autorisée (500 Ko).',
            'error'
          ).then(function() {
            window.location = './?module=settings&action=uploadAvatar';
        });</script>";
    }

    public function unknownErrorOccured() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Une erreur est survenue.',
            'error'
          ).then(function() {
            window.location = './?module=settings';
        });</script>";
    }

    public function unableToDeleteAvatarIsDefault() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Impossible de supprimer la photo de profil actuelle. Tu as la photo de profil par défaut.',
            'error'
          ).then(function() {
            window.location = './?module=settings&action=uploadAvatar';
        });</script>";
    }

    public function avatarDeleteSuccess() {
        echo "<script>Swal.fire(
            'Suppression réussie !',
            'Ta photo de profil actuelle a bien été supprimée.',
            'success'
          ).then(function() {
            window.location = './?module=settings&action=uploadAvatar';
        });</script>";
    }

    public function usernameAlreadyTaken() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'Le nom d\'utilisateur saisi est déjà pris.',
            'error'
          ).then(function() {
            window.location = './?module=settings';
        });</script>";
    }

    public function userDetailsUpdateSuccess() {
        echo "<script>Swal.fire(
            'Modification apportée !',
            'Tes changements ont bien été pris en compte.',
            'success'
          ).then(function() {
            window.location = './?module=settings';
        });</script>";
    }

    public function emailAlreadyTaken() {
        echo "<script>Swal.fire(
            'Il y a un problème !',
            'L\'adresse e-mail saisie est déjà prise.',
            'error'
          ).then(function() {
            window.location = './?module=settings';
        });</script>";
    }
}