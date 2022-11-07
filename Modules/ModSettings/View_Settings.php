<?php

require_once("./GenericView.php");
require_once("Model_Settings.php");
require_once("Alert.php");

class ViewSettings extends GenericView
{

    private $model;
    private $viewAlert;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelSettings;
        $this->viewAlert = new Alert;
    }

    public function show_settings()
    {

        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();

            echo '<div class="settings">
            <div class="auth-title">
                <h1>Paramètres</h1>
                <p>Besoin d\'actualiser quelques informations ? C\'est par ici.</p>
            </div>

            <div class="profilePicName">
                <a href="./?module=settings&action=uploadAvatar"><div class="profilePic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_file'] . '\');"><i class="fa fa-pencil editIconProfilePic"></i></div></a>
                <div class="profileName">
                    <form action="./?module=settings&action=updateUserDetails" method="POST">
                    <label>NOM D\'UTILISATEUR :</label>
                    <input class="form-input" type="text" name="username" id="username" value="' . $user['username'] . '">

                    <label>ADRESSE E-MAIL :</label>
                    <input class="form-input" type="text" name="email" id="email" value="' . $user['email'] . '">

                    <label>DÉFINIR UN NOUVEAU MOT DE PASSE :</label>
                    <input class="form-input" type="password" name="password" id="password">

                    <button type="submit" id="submit" class="btngradient btngradient-hover color-9">Modifier</button>
                    </form>
                </div>
            </div>
        </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function show_uploadAvatar() {

        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();

            echo '<div class="settings">
            <div class="auth-title">
                <h1>Importer une photo de profil</h1>
                <p>Prêt à te démarquer avec une photo de profil personnalisée ?</p>
            </div>
            
            <div class="fileUpload">
                <div class="profilePic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_file'] . '\');"></div>

                <form action="./?module=settings&action=sendUploadAvatar" method="POST" enctype="multipart/form-data">
                    <label for="formFileSm" class="form-label">IMPORTER UNE IMAGE :</label>
                    <input class="form-control form-control-sm" type="file" name="avatarFile" required/>
                    <label class="warningFileUpload">Format de fichier autorisé : .png, .jpg, .gif</label>
                    <label class="warningFileUpload">Taille maximale du fichier : 2 Mo</label>

                    <button type="submit" id="submit" name="submit" class="btngradient btngradient-hover color-9">Importer</button>
                    <a href="./?module=settings&action=deleteCurrentAvatar"><label class="deleteCurrentAvatar">SUPPRIMER LA PHOTO DE PROFIL ACTUELLE</label></a>
                </form>
            </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }
}