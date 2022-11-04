<?php

require_once("./GenericView.php");

class ViewProfile extends GenericView
{

    public function __construct()
    {
        parent::__construct();
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
        if (isset($_SESSION['login'])) {
            echo '<div class="settings">
            <div class="auth-title">
                <h1>Paramètres</h1>
                <p>Besoin d\'actualiser quelques informations ? C\'est par ici.</p>
            </div>

            <div class="profilePicName">
                <div class="profilePic">
                    
                </div>
                <div class="profileName">
                    <label>NOM D\'UTILISATEUR :</label>
                    <input class="form-input" type="text" name="username" id="username">
                </div>
                <button type="submit" id="submit" class="btngradient btngradient-hover color-9">Modifier</button>
            </div>
        </div>';
        } else {
            echo "Pas identifié";
        }
    }
}
