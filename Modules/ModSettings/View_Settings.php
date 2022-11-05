<?php

require_once("./GenericView.php");
require_once("Model_Settings.php");

class ViewSettings extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelSettings;
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
                <a href="./?module=settings&action=uploadAvatar"><div class="profilePic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_id'] .'.png\');"></div></a>
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

    public function show_uploadAvatar() {

        $user = $this->model->getUserDetails();

        if (isset($_SESSION['login'])) {
            echo '<div class="settings">
            <div class="auth-title">
                <h1>Importer une photo de profil</h1>
                <p>Prêt à te démarquer avec une photo de profil personnalisée ?</p>
            </div>
            
            <div class="fileUpload">
                <div class="profilePic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_id'] .'.png\');"></div>

                <form action="./?module=settings&action=sendUploadAvatar" method="POST">
                    <label for="formFileSm" class="form-label">IMPORTER UNE IMAGE :</label>
                    <input class="form-control form-control-sm" id="formFileSm" type="file" name="avatar" />

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9">Importer</button>
                </form>
            </div>';
        } else {
            echo "Pas identifié";
        }
    }
}
