<?php

require_once("./GenericView.php");

class ViewProfile extends GenericView
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show_myProfile($user)
    {
        if (isset($_SESSION['login'])) {

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
                            <div class="subscribe-button">
                                <button type="submit" id="submit" class="btngradient btngradient-hover color-9">Suivre</button>
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

                        </div>

                        <div class="user-activity">
                        <h2 class="panel-subtitle-left mt-30"><i class="fa-solid fa-bars-staggered"></i> Activités récentes</h2>
                        <div>
                    </div>
                </div>';

                echo '</div>';

                echo '</div>';
            }
        } else {
            echo "Pas identifié";
        }
    }

    public function show_viewProfile($otherUsers){
        $this->show_myProfile($otherUsers);
    }

}
