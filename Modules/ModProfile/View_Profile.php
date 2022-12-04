<?php

require_once("./GenericView.php");

class ViewProfile extends GenericView {

    public function __construct() {
        parent::__construct();
    }

    public function show_profile($user, $showsInListCount, $commentsCount, $userActivity)
    {
        if (!$user[0]['private'] || $_SESSION['idRole'] == 1 || $user[0]['id'] == $_SESSION['id']) {

            echo '<style>
            header {
                position: absolute;
                top: 3px;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 10000;
                height: 5%;
            }

            :root {
                --profile-color: '. $user[0]['color'] .';
              }
        </style>';

            foreach($user as $value){
                $username = $value["username"];
                $about = $value["about"];
                $avatarFile = $value['avatar_file'];
                $bannerFile = $value['banner_file'];
                $registerDatetime = $value['register_date'];
                $registerDate = (new DateTime($registerDatetime))->format('j F Y');

                echo '<div class="profile-box">';

                echo '<div class="header-profile-container">';

                echo '<div class="profileBanner">
                    <div class="banner" style="background: url(\'./Assets/images/banner/' . $bannerFile . '\'); background-size: cover;"></div>
                ';

                echo '<div class="profileAvatarAndInfos">
                        <div class="profileInfos">
                            <img src="./Assets/images/avatar/'. $avatarFile . '" />
                            <div class="usernameAndSubscribeButton">
                            <div class="usernameAndInfos">
                                <h1>'. $username  .'</h1> <span class="memberSince">est membre de ShowBizFlex depuis le '. $registerDate .'.</span>
                            </div>
                            <div class="subscribe-button">';

                if ($_SESSION['login'] == $username) {
                    echo '<a href="./?module=settings"><button class="btngradient btngradient-hover color-9 w-200">Modifier mon profil</button></a>';
                }
                else {
                    echo '<button id="followButton" class="btngradient btngradient-hover color-9">Suivre</button>';
                }

                echo '
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>';

                echo '<div class="profile-body">
                    <div class="panel-info-left">
                        <h2 class="panel-subtitle-left"><i class="fa-solid fa-pen-nib"></i> À propos de moi</h2>
                        <div class="user-about">
                            <p>'. $about .'</p>
                        </div>

                        <h2 class="panel-subtitle-left mt-30"><i class="fa-solid fa-star"></i> Genres favoris</h2>
                        <div class="user-favGenres">
                            <p>'. $about .'</p>
                        </div>

                        <h2 class="panel-subtitle-left mt-30"><i class="fa-solid fa-users"></i> Abonnés</h2>
                        <div class="user-followers">
                            <p>'. $about .'</p>
                        </div>

                        <h2 class="panel-subtitle-left mt-30"><i class="fa-solid fa-users"></i> Abonnements</h2>
                        <div class="user-followers">
                            <p>'. $about .'</p>
                        </div>
                    </div>

                    <div class="panel-right">
                        <div class="user-stats-lists">
                            <div class="stats-showsInList">
                                <h3>Séries en liste</h3>
                                <h1>'. $showsInListCount .'</h1>
                            </div>
                            <div class="stats-userComments">
                                <h3>Commentaires</h3>
                                <h1>'. $commentsCount .'</h1>
                            </div>
                            <div class="stats-userRating">
                                <h3>Évaluations</h3>
                                <h1>N/A</h1>
                            </div>
                        </div>

                        <div class="user-activity">
                        <h2 class="panel-subtitle-left mt-30"><i class="fa-solid fa-bars-staggered"></i> Activités récentes</h2>

                        '. $userActivity .'
                        <div>
                    </div>
                </div>';

                echo '</div>';

                echo '</div>';
            }
        } else {
            echo '
            <div style="color: white; text-align:center">
                <h1 style="font-size: 20px;">Désolé, ce profil est privé.</h1>
            </div>';
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
