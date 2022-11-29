<?php

require_once("./GenericView.php");

class ViewProfile extends GenericView {

    public function __construct() {
        parent::__construct();
    }

    public function show_profile($user) {
        if (isset($_SESSION['login'])) {
            foreach($user as $row){
                if($_SESSION['login'] != $row['username']){
                    echo '<b> <a class="followsUsers" href="./?module=profile&action=followsUsers&idUser='.$_SESSION['id'].'&idFollowedUser='.$row['id'].'"> Suivre '.$row['username'].' </a> </b>' . "<br> <br>";
                }
                echo 'Identifiant : ' . $row["username"] . "<br> <br>";
                echo 'Description : ' . $row["about"] . "<br> <br>";
                echo 'Avatar : ' . '<img src="/Assets/images/avatar/'. $row['avatar_file'] . '"</img>' . "<br> <br> <br>";
                echo 'Bannière : ' . '<img src="/Assets/images/banner/' . $row['banner_file'] . '" . width="300px" </img>';
            }
        } else {
            echo "Utilisateur non identifié";
        }
    }

    public function showfollowedUsersList($userListShow){
        foreach($userListShow as $row){
            echo 'Les séries suivies de ' . $row['username'] . ' sont : ' . $row['idShow'] . "<br> <br>";
        }
    }

    public function show_other_profile($otherUsers){
        $this->show_profile($otherUsers);
    }

}
