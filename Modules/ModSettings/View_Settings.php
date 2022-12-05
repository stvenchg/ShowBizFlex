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

    public function headerSettings()
    {
        echo '<div class="settings">
            <div class="page-title">
            <h1>Paramètres</h1>
            <p>Besoin d\'actualiser quelques informations ? C\'est par là.</p>
        </div>';

        $user = $this->model->getUserDetails();
    }

    public function show_settingsProfile()
    {

        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();
            $this->headerSettings();

            echo '<div class="settings-container">
            <div class="settings-nav">
                <a href="./?module=settings">
                    <div class="settings-nav-item settings-nav-item-selected"><i class="fa-solid fa-user"></i> Profil</div>
                </a>
                <a href="./?module=settings&action=account">
                    <div class="settings-nav-item"><i class="fa-solid fa-fingerprint"></i> Compte</div>
                </a>
                <a href="./?module=settings&action=security">
                    <div class="settings-nav-item"><i class="fa-solid fa-shield"></i> Sécurité</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-bell"></i> Notifications</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-list"></i> Listes</div>
                </a>
            </div>

            <div class="settings-content">

            <div class="default-container">
                <label>COULEUR DE PROFIL</label>
                
                <div class="profil-color-palette">
                    <div class="profil-color-palette-item blue" id="paletteBlue"></div>
                    <div class="profil-color-palette-item purple" id="palettePurple"></div>
                    <div class="profil-color-palette-item green" id="paletteGreen"></div>
                    <div class="profil-color-palette-item orange" id="paletteOrange"></div>
                    <div class="profil-color-palette-item red" id="paletteRed"></div>
                    <div class="profil-color-palette-item pink" id="palettePink"></div>
                    <div class="profil-color-palette-item grey" id="paletteGrey"></div>
                    <div class="profil-color-palette-item white" id="paletteWhite"></div>
                </div>
            </div>

            <div class="default-container about-container">
                <label>À PROPOS DE TOI</label>
                <form id="formChangeAbout" action="./?module=settings&action=updateAbout" method="POST">
                    <input class="form-input" type="text" name="about" id="about" value="' . $user['about'] . '">

                    <button type="submit" id="saveChangeAbout" class="btngradient btngradient-hover color-9 hide">Enregistrer</button>
                    <input type="hidden" name="token" value='.$_SESSION['token'].' >
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
                    <div class="bannerPic" style="background: url(\'../Assets/images/banner/' . $user['banner_file'] . '\');"></div>
                </a>
            </div>
        </div>

        </div>
    </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function show_settingsAccount()
    {
        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();
            $this->headerSettings();

            echo '<div class="settings-container">
            <div class="settings-nav">
                <a href="./?module=settings">
                    <div class="settings-nav-item settings-nav-item"><i class="fa-solid fa-user"></i> Profil</div>
                </a>
                <a href="./?module=settings&action=account">
                    <div class="settings-nav-item settings-nav-item-selected"><i class="fa-solid fa-fingerprint"></i> Compte</div>
                </a>
                <a href="./?module=settings&action=security">
                    <div class="settings-nav-item"><i class="fa-solid fa-shield"></i> Sécurité</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-bell"></i> Notifications</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-list"></i> Listes</div>
                </a>
            </div>

            <div class="settings-content">

            <div class="default-container">
                <label>NOM D\'UTILISATEUR</label>
                <form id="formChangeUsername" action="./?module=settings&action=updateUsername" method="POST">
                    <input class="form-input" type="text" name="username" id="username" value="' . $user['username'] . '">

                    <button type="submit" id="saveChangeUsername" class="btngradient btngradient-hover color-9 hide">Enregistrer</button>
                    <input type="hidden" name="token" value='.$_SESSION['token'].' >
                </form>
            </div>

            <div class="default-container">
                <label>ADRESSE E-MAIL</label>
                <form id="formChangeEmail" action="./?module=settings&action=updateEmail" method="POST">
                    <input class="form-input" type="email" name="email" id="email" value="' . $user['email'] . '">

                    <button type="submit" id="saveChangeEmail" class="btngradient btngradient-hover color-9 hide">Enregistrer</button>
                    <input type="hidden" name="token" value='.$_SESSION['token'].' >
                </form>
            </div>

            <div class="default-container">
                <label>MODIFIER LE MOT DE PASSE</label>
                <form>
                    <input class="form-input" type="password" name="password" id="password" placeholder="Nouveau mot de passe">
                    <input class="form-input" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirmer le nouveau mot de passe">
                    <input type="hidden" name="token" value='.$_SESSION['token'].' >
                </form>
            </div>

            <hr>

            <div class="default-container">
                <label>RGPD</label>
                <p>Conformément au RGPD (Règlement Général sur la Protection des Données), tu peux demander à télécharger une copie de tes données stockées sur ShowBizFlex.com en appuyant sur le bouton ci-dessous.</p>

                <button type="submit" id="submit" class="btngradient btngradient-hover color-9 request-data">Demander une copie</button>
            </div>

            <hr>

            <div class="default-container">
                <label style="color:red">SUPPRIMER LE COMPTE</label>
                <p>Attention ! Cette action effacera de manière permanente les données de ton compte.</p>

                <p>Afin de protéger ton compte, tu devras patienter un délais de 24 heures après ta demande de suppression. Une fois que les 24 heures sont passées, reviens sur cette page et appuie à nouveau sur le bouton ci-dessous pour confirmer la suppression du compte.</p>
                <button type="submit" id="submit" class="btngradient btngradient-hover color-11 delete-account">Supprimer le compte</button>
            </div>
        </div>

        </div>
    </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function show_settingsSecurity()
    {
        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();
            $this->headerSettings();

            echo '<div class="settings-container">
            <div class="settings-nav">
                <a href="./?module=settings">
                    <div class="settings-nav-item settings-nav-item"><i class="fa-solid fa-user"></i> Profil</div>
                </a>
                <a href="./?module=settings&action=account">
                    <div class="settings-nav-item"><i class="fa-solid fa-fingerprint"></i> Compte</div>
                </a>
                <a href="./?module=settings&action=security">
                    <div class="settings-nav-item settings-nav-item-selected"><i class="fa-solid fa-shield"></i> Sécurité</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-bell"></i> Notifications</div>
                </a>
                <a href="#">
                    <div class="settings-nav-item"><i class="fa-solid fa-list"></i> Listes</div>
                </a>
            </div>

            <div class="settings-content">

            <div class="default-container">

            <div class="profilVisibility">
            <label>VISIBILITÉ DU PROFIL</label>
            <div class="form-check form-switch">';

            if ($user['private']) {
                echo '<input name="enablePrivate" class="form-check-input checkboxCursor" type="checkbox" id="enablePrivate" checked>';
            } else {
                echo '<input class="form-check-input" type="checkbox" id="enablePrivate">';
            }
            echo '
                <label class="form-check-label" for="enablePrivate">Passer le profil en privé</label>
            </div>

            <br>
                <label style="color: #f74d91;">CONTENUS SENSIBLES (NSFW)</label>
                <div class="form-check form-switch">';

            if ($user['adult']) {
                echo '<input name="enableAdult" class="form-check-input checkboxCursor" type="checkbox" id="enableAdultCheckbox" checked>';
            } else {
                echo '<input class="form-check-input" type="checkbox" id="enableAdultCheckbox">';
            }

            echo '
                    <label class="form-check-label" for="enableAdultCheckbox">Inclure les contenus sensibles dans les résultats de mes recherches</label>
                </div>
            </div>
        </div>
        </div>
    </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function show_uploadAvatar()
    {

        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();

            echo '<div class="settings">
            <div class="page-title">
                <h1>Importer un avatar</h1>
                <p>Prêt à te démarquer avec un avatar personnalisé ?</p>
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
                    <input type="hidden" name="token" value='.$_SESSION['token'].' >
                </form>
            </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function show_uploadBanner()
    {

        if (isset($_SESSION['login'])) {

            $user = $this->model->getUserDetails();

            echo '<div class="settings">
            <div class="page-title">
                <h1>Importer une bannière</h1>
                <p>Prêt à te démarquer avec une bannière personnalisée ?</p>
            </div>
            
            <div class="fileUpload">
                <div class="bannerPic" style="background: url(\'../Assets/images/banner/' . $user['banner_file'] . '\');"></div>

                <form action="./?module=settings&action=sendUploadBanner" method="POST" enctype="multipart/form-data">
                    <label for="formFileSm" class="form-label mt-20">IMPORTER UNE IMAGE :</label>
                    <input class="form-control form-control-sm" type="file" name="bannerFile" required/>
                    <label class="warningFileUpload">Formats autorisés : JPEG, PNG.</label>
                    <label class="warningFileUpload">Taille maximale : 3 Mo.</label>

                    <button type="submit" id="submit" name="submit" class="btngradient btngradient-hover color-9">Importer</button>
                    <a href="./?module=settings&action=deleteCurrentBanner"><label class="deleteCurrentBanner">SUPPRIMER LA BANNIÈRE ACTUELLE</label></a>
                    <input type="hidden" name="token" value='.$_SESSION['token'].' >
                </form>
            </div>';
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/