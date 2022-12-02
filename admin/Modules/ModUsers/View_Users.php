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
            <a href="./?module=users&action=createUser"><button class="btngradient btngradient-hover color-9"><i class="fa-solid fa-user-plus"></i> Ajouter</button></a>
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
            ' . $userListString . '
          </tr>
        </tbody>
      </table>
        </div>
    </div>';
  }

  public function show_createUser_form()
  {
    echo '<div class="overview-panel">
      <div class="title-account">
          <h1>Utilisateurs > Créer un nouvel utilisateur</h1>
      </div>

      <div class="users-container">
      <form action="./?module=auth&action=sendCreateUser" method="POST">

          <label for="login">NOM D\'UTILISATEUR</label>
          <input class="form-input" type="text" name="email" required>

          <label for="login">ADRESSE E-MAIL</label>
          <input class="form-input" type="text" name="email" required>

          <label for="login">MOT DE PASSE</label>
          <input class="form-input" type="password" name="password" required>

          <label for="login">ROLE</label>
          <input class="form-input" type="password" name="password" required>

          <button type="submit" id="submit" class="btngradient btngradient-hover color-9 full" style="margin-top: 20px;">Créer l\'utilisateur</button>
      </form>
      </div>
  </div>';
  }
}
