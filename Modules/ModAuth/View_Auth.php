<?php

require_once("./GenericView.php");
require_once("Alert.php");
require_once("Model_Auth.php");

class ViewAuth extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelAuth;

    }

    public function form_login()
    {

        if (!isset($_SESSION['login'])) {
            echo '
        <div class="auth">
            <div class="page-title">
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

                <div class="page-title">
                    <p>Pas encore de compte ? <a href="./?module=auth&action=register">S\'inscrire</a>.</p>
                </div>
            </div>
        </div>';
        } else {
            $this->viewAlert->alreadyAuthenticated();
        }
    }

    public function form_register()
    {

        if (!isset($_SESSION['login'])) {
            echo '
        <div class="auth">
            <div class="page-title">
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

                <div class="page-title">
                    <p>Déjà un compte ? <a href="./?module=auth&action=login">Se connecter</a>.</p>
                </div>
            </div>
        </div>';
        } else {
            $this->viewAlert->alreadyAuthenticated();
        }
    }

    public function form_forgot() {
        if (!isset($_SESSION['login'])) {
            echo '
        <div class="auth">
            <div class="page-title">
                <h1>Un oubli ?</h1>
                <p>Saisis ton e-mail afin que nous puissions réinitialiser ton mot de passe.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendForgot" method="POST">
                    <label for="email">ADRESSE E-MAIL : </label>
                    <input class="form-input" type="text" name="email" id="email" required>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">Réinitialiser</button>
                </form>

                <div class="page-title">
                    <p>Ça t\'es revenu ? <a href="./?module=auth&action=login">Se connecter</a>.</p>
                </div>
            </div>
        </div>';
        } else {
            $this->viewAlert->alreadyAuthenticated();
        }
    }

    public function form_resetPassword() {
        if (isset($_GET['forgot_auth']) && isset($_GET['email']) && !empty($_GET['forgot_auth']) && !empty($_GET['email']) && !isset($_SESSION['login'])) {
            if ($this->model->verifyResetPassword(htmlspecialchars($_GET['email']), htmlspecialchars($_GET['forgot_auth']))) {
                echo '
        <div class="auth">
            <div class="page-title">
                <h1>Réinitialisation du mot de passe</h1>
                <p>Merci de remplir les champs ci-dessous.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendResetPassword" method="POST">
                    <label for="email">NOUVEAU MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="password" id="password" required>

                    <label for="email">CONFIRMATION DU NOUVEAU MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="confirmpassword" id="confirmpassword" required>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">Réinitialiser</button>
                </form>
            </div>
        </div>';
            }
            else {
                $this->viewAlert->invalidRequestPasswordReset();
            }
        }
        else {
            $this->viewAlert->invalidRequestPasswordReset();
        }
    }
}