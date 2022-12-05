<?php

require_once("GenericView.php");
require_once("Alert.php");
require_once("Model_Panel.php");

class ViewPanel extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelPanel;
    }

    public function show_dashboard($userCount, $commentCount, $showsInListCount)
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ./?module=auth&action=login");
        }
        else {
            echo '<div class="overview-panel">
                <h1>Vue d\'ensemble</h1>

                <h2 class="panel-subtitle">Données statistiques</h2>
                <div class="global-stats">
                    <div class="stats">
                        <div>
                            <h2 class="stats-title">Nombre d\'utilisateurs</h2>
                            <h1 class="stats-value">' . $userCount . '</h1>
                        </div>
                        <div>
                            <i class="fa-solid fa-users fa-3x"></i>
                        </div>
                    </div>
                    <div class="stats">
                        <div>
                            <h2 class="stats-title">Séries enregistrées</h2>
                            <h1 class="stats-value">' . 'N/A' . '</h1>
                        </div>
                        <div>
                            <i class="fa-solid fa-tv fa-3x"></i>
                        </div>
                    </div>
                    <div class="stats">
                        <div>
                            <h2 class="stats-title">Commentaires postés</h2>
                            <h1 class="stats-value">'. $commentCount .'</h1>
                        </div>
                        <div>
                            <i class="fa-solid fa-comments fa-3x"></i>
                        </div>
                    </div>
                    <div class="stats">
                        <div>
                            <h2 class="stats-title">Séries en liste</h2>
                            <h1 class="stats-value">'. $showsInListCount .'</h1>
                        </div>
                        <div>
                            <i class="fa-solid fa-list fa-3x"></i>
                        </div>
                    </div>
                </div>

                <h2 class="panel-subtitle">Activités récentes</h2>
                <div class="latest-activity">

                </div>
            </div>';
        }
    }
}


/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/