<?php

require_once("./GenericView.php");
require_once("Model_Setup.php");

class ViewSetup extends GenericView
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelSetup;
    }

    public function show_selectGenres()
    {

        if (isset($_SESSION['show_setup']) && $_SESSION['show_setup'] == 1) {

            echo '

        <div class="setup-container animate__animated animate__fadeIn animate__slow">
            <div class="setup-title">
                <h1 class="animate__animated animate__fadeInUp">Bienvenue ' . $_SESSION['login'] . ', choisis 3 genres que tu aimes.</h1>

                <p class="animate__animated animate__fadeInUp animate__delay-1s">Grâce à ça, nous pourrons te recommander des séries susceptibles de te plaire. <span>Sélectionne les genres que tu aimes.</span></p>
            </div>
            <div class="setup-content">
            <form id="formSetupGenres">
            <ul class="ks-cboxtags animate__animated animate__fadeIn animate__delay-2s">
                <li><input name="genres[]" type="checkbox" id="Animation" value="16"><label for="Animation">Animation</label></li>
                <li><input name="genres[]" type="checkbox" id="Drame" value="18"><label for="Drame">Drame</label></li>
                <li><input name="genres[]" type="checkbox" id="Comedie" value="35"><label for="Comedie">Comédie</label></li>
                <li><input name="genres[]" type="checkbox" id="Western" value="37"><label for="Western">Western</label></li>
                <li><input name="genres[]" type="checkbox" id="Crime" value="80"><label for="Crime">Crime</label></li>
                <li><input name="genres[]" type="checkbox" id="Documentaire" value="99"><label for="Documentaire">Documentaire</label></li>
                <li><input name="genres[]" type="checkbox" id="Mystere" value="9648"><label for="Mystere">Mystère</label></li>
                <li><input name="genres[]" type="checkbox" id="Familial" value="10751"><label for="Familial">Familial</label></li>
                <li><input name="genres[]" type="checkbox" id="ActionAventure" value="10759"><label for="ActionAventure">Action & Aventure</label></li>
                <li><input name="genres[]" type="checkbox" id="Enfants" value="10762"><label for="Enfants">Enfants</label></li>
                <li><input name="genres[]" type="checkbox" id="Actualite" value="10763"><label for="Actualite">Actualité</label></li>
                <li><input name="genres[]" type="checkbox" id="Realite" value="10764"><label for="Realite">Réalité</label></li>
                <li><input name="genres[]" type="checkbox" id="ScifiFantastique" value="10765"><label for="ScifiFantastique">Science-Fiction & Fantastique</label></li>
                <li><input name="genres[]" type="checkbox" id="Feuilleton" value="10766"><label for="Feuilleton">Feuilleton</label></li>
                <li><input name="genres[]" type="checkbox" id="Discussion" value="10767"><label for="Discussion">Discussion</label></li>
                <li><input name="genres[]" type="checkbox" id="GuerrePolitique" value="10768"><label for="GuerrePolitique">Guerre & Politique</label></li>
          </ul>
          </form>
        </div>
        </div>

        <div class="setup-bar">
            <button type="submit" id="submitSetupGenres" class="btngradient btngradient-hover color-9 w-200px">Continuer</button>
        <div>
        
        ';
        }
    }

    public function show_settingUp()
    {
        if (isset($_SESSION['show_setup']) && isset($_SESSION['setupCompleted'])) {
            echo '<div class="setup-container animate__animated animate__fadeIn animate__slow">
            <div class="setupLoadingContainer">
            <h1>Un petit instant, nous personnalisons ton expérience en sélectionnant des séries rien que pour toi.</h1>
            <div class="spinner"></div>
            </div>
        </div>';

            unset($_SESSION['setupCompleted']);
            header("refresh:4;url=./");
        }
    }
}


/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/