<?php

require_once("GenericView.php");
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

        if (!isset($_SESSION['admin_id']) && isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {
            echo '
        <div class="auth">
            <div class="page-title">
                <h1>Espace administrateur</h1>
                <p>Une authentification supplémentaire est nécessaire.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendLogin" method="POST">
                    <label for="login">ADRESSE E-MAIL</label>
                    <input class="form-input" type="text" name="email" required>

                    <label for="login">MOT DE PASSE</label>
                    <input class="form-input" type="password" name="password" required>

                    <label for="login">CODE CONFIDENTIEL</label>
                    <input class="form-input" type="password" maxlength="6" name="pin" required>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">Se connecter</button>
                </form>

                <div class="page-title">
                    <label><a href="./?module=auth&action=register">CRÉER UN COMPTE</a></label>
                </div>
            </div>
        </div>';
        } else if (isset($_SESSION['admin_id']) && isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {
            $this->viewAlert->alreadyAuthenticated();
        } else {
            $this->viewAlert->notAllowedPage();
        }
    }

    public function form_register()
    {

        if (!isset($_SESSION['admin_id']) && isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {
            echo '
        <div class="auth">
            <div class="page-title">
                <h1>Inscription</h1>
                <p>Merci de compléter le formulaire ci-dessous.</p>
            </div>
            <div class="auth-form">
                <form action="./?module=auth&action=sendRegister" method="POST">
                    <label>NOM D\'UTILISATEUR</label>
                    <input class="form-input" type="text" name="username" required>

                    <label>ADRESSE E-MAIL</label>
                    <input class="form-input" type="text" name="email" required>

                    <label>MOT DE PASSE</label>
                    <input class="form-input" type="password" name="password" required>

                    <label>CONFIRMATION DU MOT DE PASSE</label>
                    <input class="form-input" type="password" name="confirmpassword" required>

                    <label>CODE CONFIDENTIEL</label>
                    <input class="form-input" type="password" maxlength="6" name="pin" required>

                    <label>CONFIRMATION DU CODE CONFIDENTIEL</label>
                    <input class="form-input" type="password" maxlength="6" name="confirmpin" required>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">S\'inscrire</button>
                </form>
            </div>
        </div>';
        } else if (isset($_SESSION['admin_id']) && isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {
            $this->viewAlert->alreadyAuthenticated();
        } else {
            $this->viewAlert->notAllowedPage();
        }
    }
}


/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/