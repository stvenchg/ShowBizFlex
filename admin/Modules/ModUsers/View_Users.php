<?php

require_once("GenericView.php");
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

    if (!isset($_SESSION['admin_id'])) {
      header("Location: ./?module=auth&action=login");
    } else {

      $this->model->getUserListString();

      echo '<div class="overview-panel">
        <div class="title-account">
            <h1>Utilisateurs</h1>
            <a href="./?module=users&action=createUser"><button class="btngradient btngradient-hover color-9"><i class="fa-solid fa-user-plus"></i> Ajouter</button></a>
        </div>

        <div class="usersSearch">
          <h2>Rechercher un utilisateur</h2>
          <input class="form-input" type="text" name="userSearchQuery" required>
        </div>

        <div class="usersList">
          ' . $userListString . '
        </div>
    </div>';
    }
  }

  public function show_createUser_form()
  {

    if (!isset($_SESSION['admin_id'])) {
      header("Location: ./?module=auth&action=login");
    } else {
      echo '<div class="overview-panel">
      <div class="title-account">
          <h1>Créer un nouvel utilisateur</h1>
      </div>

      <div class="users-container">
      <form action="./?module=auth&action=sendCreateUser" method="POST">

          <label for="username">NOM D\'UTILISATEUR</label>
          <input class="form-input" type="text" name="username" required>

          <label for="email">ADRESSE E-MAIL</label>
          <input class="form-input" type="text" name="email" required>

          <label for="password">MOT DE PASSE</label>
          <input class="form-input" type="password" name="password" required>

          <label for="role">ROLE</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="role" value="2" checked>
            <label class="form-check-label" for="inlineRadio1">User</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="role" value="1">
            <label class="form-check-label" for="inlineRadio2">Admin</label>
          </div>

          <label for="pin" style="margin-top: 20px">POUR VALIDER LA MODIFICATION, SAISIR LE CODE PIN</label>
          <input class="form-input" type="password" name="pin" maxlength="6" required>

          <button type="submit" id="createUserSubmitButton" class="btngradient btngradient-hover color-9 full" style="margin-top: 20px;">Créer l\'utilisateur</button>
      </form>
      </div>
  </div>';
    }
  }

  public function show_editUser_form()
  {

    if (!isset($_SESSION['admin_id'])) {
      header("Location: ./?module=auth&action=login");
    } else {

      $user = $this->model->getUserDetails(htmlspecialchars($_GET['id']));

      echo '<div class="overview-panel">
      <div class="title-account">
          <h1>Édition de l\'utilisateur : ' . $user[0]['username'] . '</h1>
      </div>

      <div class="users-container">

      <label style="margin-bottom: 20px">INSCRIT SUR SHOWBIZFLEX DEPUIS LE : ' . $user[0]['register_date'] . '</label>

      <label for="username">AVATAR</label>
      <img style="width: 200px; height: 200px; border-radius: 50%; margin-bottom: 20px" src="../Assets/images/avatar/' . $user[0]['avatar_file'] . '" />

      <label for="username">BANNIERE</label>
      <img style="width: 500px; height: 200px; border-radius: 10px; margin-bottom: 20px" src="../Assets/images/banner/' . $user[0]['banner_file'] . '" />

      <form class="editUser-form">

          <input class="form-input" type="text" name="id" id="id" value="' . $user[0]['id'] . '" hidden required>

          <label for="username">NOM D\'UTILISATEUR</label>
          <input class="form-input" type="text" name="username" id="username" value="' . $user[0]['username'] . '" required>

          <label for="email">ADRESSE E-MAIL</label>
          <input class="form-input" type="text" name="email" id="email" value="' . $user[0]['email'] . '" required>

          <label for="about">DESCRIPTION</label>
          <input class="form-input" type="text" name="about" id="about" value="' . $user[0]['about'] . '">

          <label for="color">COULEUR DE PROFIL</label>
          <input class="form-input" type="text" name="color" id="color" value="' . $user[0]['color'] . '" required>

          <label for="idRole">ROLE</label>
          <input class="form-input" type="text" name="idRole" id="idRole" value="' . $user[0]['idRole'] . '" required>

          <label for="show_setup">FORCER LA CONFIGURATION DU COMPTE</label>
          <input class="form-input" type="text" name="show_setup" id="show_setup" value="' . $user[0]['show_setup'] . '" required>

          <label for="private">PROFIL PRIVE</label>
          <input class="form-input" type="text" name="private" id="private" value="' . $user[0]['private'] . '" required>

          <label for="adult">AFFICHER LES CONTENUS SENSIBLES</label>
          <input class="form-input" type="text" name="adult" id="adult" value="' . $user[0]['adult'] . '" required>

          <label for="pin" style="margin-top: 20px; color: red">POUR VALIDER LES MODIFICATIONS, SAISIR LE CODE PIN</label>
          <input class="form-input" type="password" name="pin" id="pin" maxlength="6" required>
      </form>

          <button id="editUserButton" class="btngradient btngradient-hover color-9 full" style="margin-top: 20px;">Confirmer les modifications</button>

          <button id="deleteUserButton" class="btngradient btngradient-hover color-11 full" style="margin-top: 20px;">Supprimer cet utilisateur</button>
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
?>