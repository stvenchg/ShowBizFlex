<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelUsers extends PDOConnection
{

    private $viewAlert;

    public function __construct()
    {
        $this->viewAlert = new Alert;
    }

    // Dashboard
    public function getCountUsers() {
        $stmt = parent::$db->prepare("SELECT COUNT(*) FROM User");
        $stmt->execute();
        $stmtResult = $stmt->fetch();
        return $stmtResult[0];
    }

    public function getCountShows() {
        $stmt = parent::$db->prepare("SELECT * FROM show");
        $stmt->execute();
        $stmtResult = $stmt->fetch();
        var_dump($stmtResult);
    }

    public function getCountComments() {
        $stmt = parent::$db->prepare("SELECT count(*) FROM comment");
        $stmt->execute();
        $stmtResult = $stmt->fetch();
        return $stmtResult[0];
    }

    public function getCountShowsInList() {
        $stmtCount1 = parent::$db->prepare("SELECT count(*) FROM towatchlatershows");
        $stmtCount1->execute();
        $count1 = $stmtCount1->fetch();

        $stmtCount2 = parent::$db->prepare("SELECT count(*) FROM followedshows");
        $stmtCount2->execute();
        $count2 = $stmtCount2->fetch();

        return $count1[0] + $count2[0];
    }

    // Users
    public function getUserListString() {
        $stmt = parent::$db->prepare("SELECT * FROM User");
        $stmt->execute();
        $result = $stmt->fetchAll();

        $userListString = '';

        foreach ($result as $index => $value) {

            if ($value['idRole'] == 2) {
                $role = '<span style="color:orange">Membre</span>';
            } else {
                $role = '<span style="color:red">Administrateur</span>';
            }

            $userListString .= '<div class="user-item">
            <div class="user-infos">
              <img src="../Assets/images/avatar/'. $value['avatar_file'] .'" />
              <p>'. $value['username'] .'</p>
              <p>'. $value['email'] .'</p>
              <p>'. $role .'</p>
              <a href="./?module=users&action=editUser&id=' . $value['id'] . '"><p><i class="fa-solid fa-pen-to-square"></i> Modifier</p></a>
            </div>
          </div>';
        }

        return $userListString;
    }

    public function getUserDetails($id) {
        $stmt = parent::$db->prepare("SELECT * FROM User WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }
}

/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>