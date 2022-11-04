<?php

require_once("./GenericView.php");
require_once("Model_Profile.php");

class ViewProfile extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelProfile;
    }

    public function show_page()
    {

        if (isset($_SESSION['login'])) {
            echo 'profile page';
        } else {
            echo "Pas identifié";
        }
    }

    public function show_settings()
    {
        $user = $this->model->getUserDetails();

        if (isset($_SESSION['login'])) {
            echo '<div class="settings">
            <div class="auth-title">
                <h1>Paramètres</h1>
                <p>Besoin d\'actualiser quelques informations ? C\'est par ici.</p>
            </div>

            <div class="profilePicName">
                <div class="profilePic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_id'] .'.png\');"></div>
                <div class="profileName">
                    <form action="#" method="POST">
                    <label>NOM D\'UTILISATEUR :</label>
                    <input class="form-input" type="text" name="username" id="username" value="' . $user['username'] . '">

                    <label>ADRESSE E-MAIL :</label>
                    <input class="form-input" type="text" name="email" id="email" value="' . $user['email'] . '">

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9">Modifier</button>
                    </form>
                </div>
            </div>
        </div>';
        } else {
            echo "Pas identifié";
        }
    }
}
