<?php

namespace Modules\ModAuth;

require_once("./GenericView.php");

use GenericView;

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
                <form action="" method="POST">
                    <label for="login">NOM D\'UTILISATEUR OU E-MAIL : </label>
                    <input class="form-input" type="text" name="login">

                    <label for="login">MOT DE PASSE : </label>
                    <input class="form-input" type="text" name="login">

                    <label class="forgotpswd"><a href="./module=auth&action=forgot">MOT DE PASSE OUBLIÉ ?</a></label>

                    <button type="button" class="btngradient btngradient-hover color-9 full mt-5p">Se connecter</button>
                </form>
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
                <form action="" method="POST">
                    <label for="username">NOM D\'UTILISATEUR : </label>
                    <input class="form-input" type="text" name="username">

                    <label for="email">ADRESSE E-MAIL : </label>
                    <input class="form-input" type="text" name="email">

                    <label for="login">MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="password">

                    <label for="login">CONFIRMATION DU MOT DE PASSE : </label>
                    <input class="form-input" type="password" name="passwordconfirm">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tos" required>
                        <label class="form-check-label" for="tos">
                            En m\'inscrivant, je confirme avoir lu et accepter les <a href="./">conditions générales d\'utilisations</a>.
                        </label>
                    </div>

                    <button type="submit" class="btngradient btngradient-hover color-9 full mt-5p">S\'inscrire</button>
                </form>
            </div>
        </div>';
    }
}