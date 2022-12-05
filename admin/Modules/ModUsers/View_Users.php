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
          '. $userListString .'
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

          <label for="username">NOM D\'UTILISATEUR</label>
          <input class="form-input" type="text" name="email" required>

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

  public function show_editUser_form()
  {

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

      <form action="./?module=auth&action=sendEditUser" method="POST">
          <label for="username">NOM D\'UTILISATEUR</label>
          <input class="form-input" type="text" name="username" value="' . $user[0]['username'] . '" required>

          <label for="email">ADRESSE E-MAIL</label>
          <input class="form-input" type="text" name="email" value="' . $user[0]['email'] . '" required>

          <label for="username">DESCRIPTION</label>
          <input class="form-input" type="text" name="about" value="' . $user[0]['about'] . '" required>

          <label for="username">COULEUR DE PROFIL</label>
          <input class="form-input" type="text" name="color" value="' . $user[0]['color'] . '" required>

          <label for="username">ROLE</label>
          <input class="form-input" type="text" name="idRole" value="' . $user[0]['idRole'] . '" required>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="adult" value="' . $user[0]['adult'] . '" onclick="if (this.checked) this.value=1; else this.value=0;" />
            <label class="form-check-label" for="flexSwitchCheckDefault">Afficher les contenus sensibles</label>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="private" value="' . $user[0]['private'] . '" onclick="if (this.checked) this.value=1; else this.value=0;" />
            <label class="form-check-label" for="flexSwitchCheckDefault">Rendre le profil privé</label>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="show_setup" value="' . $user[0]['show_setup'] . '" onclick="if (this.checked) this.value=1; else this.value=0;" />
            <label class="form-check-label" for="flexSwitchCheckDefault">Forcer la configuration du compte</label>
          </div>

          <label for="pin" style="margin-top: 20px; color: red">POUR VALIDER LES MODIFICATIONS, SAISIR LE CODE PIN</label>
          <input class="form-input" type="password" name="pin" maxlength="6" required>

          <button type="submit" id="createUserSubmitButton" class="btngradient btngradient-hover color-9 full" style="margin-top: 20px;">Confirmer les modifications</button>
      </form>
      </div>
  </div>';
  }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>