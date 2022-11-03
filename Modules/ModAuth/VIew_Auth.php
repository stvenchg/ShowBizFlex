<?php

require_once("./GenericView.php");

class ViewAuth extends GenericView {

    public function __construct()
    {
        parent::__construct();
    }

    public function form_login()
    {
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

                    <label class="forgotpswd"><a href="./module=auth&action=forgot">MOT DE PASSE OUBLIÉ ?</a></label>

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full mt-5p">Se connecter</button>
                </form>

                <div class="auth-title">
                    <p>Pas encore de compte ? <a href="./?module=auth&action=register">S\'inscrire</a>.</p>
                </div>
            </div>
        </div>';
    }

    public function form_register()
    {
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
    }
}