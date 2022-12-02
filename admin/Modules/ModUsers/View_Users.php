<?php

require_once("./GenericView.php");
require_once("Alert.php");
require_once("Model_Users.php");

class ViewUsers extends GenericView
{

    private $viewAlert;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->viewAlert = new Alert;
        $this->model = new ModelUsers;
    }

    public function show_overview($userListString)
    {

        $this->model->getUserListString();

        echo '<div class="overview-panel">
        <div class="title-account">
            <h1>Utilisateurs</h1>
            <button class="btngradient btngradient-hover color-9"><i class="fa-solid fa-user-plus"></i> Ajouter</button>
        </div>

        <div class="users-container">

        <div class="users-container-top">
            <div class="user-rows-count">
                <label>N/A</label>
            </div>
            <div class="search-user">
                <input class="form-input" type="text" name="userSearchQuery" placeholder="Rechercher...">
            </div>
        </div>

        <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Photo de profil</th>
            <th scope="col">Nom d\'utilisateur</th>
            <th scope="col">E-mail</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            '. $userListString .'
          </tr>
        </tbody>
      </table>
        </div>
    </div>';
    }
}
