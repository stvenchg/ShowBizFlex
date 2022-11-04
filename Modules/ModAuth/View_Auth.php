<?php

require_once("./GenericView.php");

class ViewAuth extends GenericView
{

    public function __construct()
    {
        parent::__construct();
    }

    public function form_login()
    {

        if (!isset($_SESSION['login'])) {
            echo '
        <div class="auth">
            <div class="auth-title">
                <h1>Content de te revoir !</h1>
                <p>Merci de saisir tes identifiants afin que nous puissions t\'authentifier.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendLogin" method="POST">
                    <label for="login">NOM D\'UTILISATEUR OU E-MAIL : </label>
                    <input class="form-input" type="text" name="login" required>

                    <label for="login">MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="password" required>

                    <label class="forgotpswd"><a href="./?module=auth&action=forgot">MOT DE PASSE OUBLIÉ ?</a></label>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">Se connecter</button>
                </form>

                <div class="auth-title">
                    <p>Pas encore de compte ? <a href="./?module=auth&action=register">S\'inscrire</a>.</p>
                </div>
            </div>
        </div>';
        } else {
            $this->alreadyAuthenticated();
        }
    }

    public function form_register()
    {

        if (!isset($_SESSION['login'])) {
            echo '
        <div class="auth">
            <div class="auth-title">
                <h1>Créer un compte</h1>
                <p>Merci de renseigner les informations suivantes.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendRegister" method="POST">
                    <label for="username">NOM D\'UTILISATEUR : </label>
                    <input class="form-input" type="text" name="username" id="username" required>

                    <label for="email">ADRESSE E-MAIL : </label>
                    <input class="form-input" type="text" name="email" id="email" required>

                    <label for="login">MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="password" id="password" required>

                    <label for="login">CONFIRMATION DU MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="passwordconfirm" id="passwordconfirm" required>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="tos" name="tos" required>
                        <label class="form-check-label" for="tos">
                            En m\'inscrivant, je confirme avoir lu et accepter les <a href="./">conditions générales d\'utilisation</a>.
                        </label>
                    </div>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">S\'inscrire</button>
                </form>

                <div class="auth-title">
                    <p>Déjà un compte ? <a href="./?module=auth&action=login">Se connecter</a>.</p>
                </div>
            </div>
        </div>';
        } else {
            $this->alreadyAuthenticated();
        }
    }

    public function form_forgot() {
        if (!isset($_SESSION['login'])) {
            echo '
        <div class="auth">
            <div class="auth-title">
                <h1>Ta mémoire te joue des tours ?</h1>
                <p>Saisis ton e-mail afin que nous puissions réinitialiser ton mot de passe.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendForgot" method="POST">
                    <label for="email">ADRESSE E-MAIL : </label>
                    <input class="form-input" type="text" name="email" id="email" required>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">Réinitialiser</button>
                </form>

                <div class="auth-title">
                    <p>Ça t\'es revenu ? <a href="./?module=auth&action=login">Se connecter</a>.</p>
                </div>
            </div>
        </div>';
        } else {
            $this->alreadyAuthenticated();
        }
    }

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
        echo "<script>Swal.fire(
            'Déconnexion réussie !',
            'On espère te revoir bientôt.',
            'success'
          ).then(function() {
            window.location = './';
        });</script>";
    }

    public function logoutError() {
        echo "<script>Swal.fire(
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


}
