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
                    <div style="background: url(\'./Assets/images/banner/' . $bannerFile . '\'); background-size: cover;"></div>
                </div>';

                echo '<div class="profileAvatarAndInfos">
                        <div class="profileInfos">
                            <img src="./Assets/images/avatar/'. $avatarFile . '" />
                            <div class="usernameAndInfos">
                                <h1>'. $username  .'</h1> <span class="memberSince">est membre de ShowBizFlex depuis le '. $registerDate .'.</span>
                            </div>
                        </div>
                    </div>';

                echo '<div class="profile-body">
                    <div class="panel-info-left">
                    Salut
                    </div>

                    <div class="panel-right">
                    Ca va
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
