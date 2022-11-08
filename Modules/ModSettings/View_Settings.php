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
            <div class="page-title">
            <h1>Paramètres</h1>
            <p>Besoin d\'actualiser quelques informations ? C\'est par là.</p>
        </div>

        <div class="settings-container">
            <div class="settings-nav">
                <a href="./?module=settings">
                    <div class="settings-nav-item settings-nav-item-selected"><i class="fa-solid fa-user"></i> Profil</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-gear"></i> Compte</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-bell"></i> Notifications</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-list"></i> Listes</div>
                </a>
            </div>

            <div class="settings-content">

            <div class="default-container about-container">
                <label>A PROPOS DE TOI</label>
                <form>
                    <input class="form-input" type="text" name="about" id="about">
                </form>
            </div>

            <div class="default-container avatarPic-container">
                <label>AVATAR</label>
                <a href="./?module=settings&action=uploadAvatar">
                    <div class="avatarPic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_file'] . '\');"></div>
                </a>
            </div>

            <div class="default-container banner-container">
                <label>BANNIÈRE</label>
                <a href="./?module=settings&action=uploadBanner">
                    <div class="bannerPic" style=""></div>
                </a>
            </div>

            <button type="submit" id="submit" class="btngradient btngradient-hover color-9">Valider les modifications</button>
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
            <div class="page-title">
                <h1>Importer un avatar</h1>
                <p>Prêt à te démarquer avec un avatar personnalisée ?</p>
            </div>
            
            <div class="fileUpload">
                <div class="avatarPic" style="background: url(\'../Assets/images/avatar/' . $user['avatar_file'] . '\');"></div>

                <form action="./?module=settings&action=sendUploadAvatar" method="POST" enctype="multipart/form-data">
                    <label for="formFileSm" class="form-label">IMPORTER UNE IMAGE :</label>
                    <input class="form-control form-control-sm" type="file" name="avatarFile" required/>
                    <label class="warningFileUpload">Formats autorisés : JPEG, PNG, GIF.</label>
                    <label class="warningFileUpload">Taille maximale : 2 Mo. Dimensions recommandées : 300x300.</label>

                    <button type="submit" id="submit" name="submit" class="btngradient btngradient-hover color-9">Importer</button>
                    <a href="./?module=settings&action=deleteCurrentAvatar"><label class="deleteCurrentAvatar">SUPPRIMER L\'AVATAR ACTUEL</label></a>
                </form>
            </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }
}