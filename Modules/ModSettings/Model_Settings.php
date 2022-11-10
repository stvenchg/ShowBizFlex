<?php

require_once('PDOConnection.php');
require_once('Alert.php');

class ModelSettings extends PDOConnection
{

    private $viewAlert;

    public function __construct()
    {
        $this->viewAlert = new Alert;
    }

    public function getUserDetails()
    {

        $login = $_SESSION['login'];

        try {
            $stmtLogin = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE username=:login");
            $stmtLogin->bindParam(':login', $login);
            $stmtLogin->execute();
            return $stmtLogin->fetch();
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function sendUploadAvatar()
    {
        if (isset($_POST["submit"]) && isset($_SESSION['login'])) {

            $login = $_SESSION['login'];
            $maxFileSize = 2000000;
            $acceptedExt = array('.png', '.jpg', '.jpeg', '.gif');

            $fileName = $_FILES['avatarFile']['name'];
            $fileSize = $_FILES['avatarFile']['size'];
            $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));

            if ($_FILES['avatarFile']['error'] > 0) {
                $this->viewAlert->unknownErrorOccured();
            } else if ($fileSize > $maxFileSize) {
                $this->viewAlert->fileTooBig();
            } else if (!in_array($fileExt, $acceptedExt)) {
                $this->viewAlert->fileInvalidExt();
            } else {
                $tmpFileName = $_FILES['avatarFile']['tmp_name'];
                $uniqueFileName = md5(uniqid(rand(), true));
                $uniqueFileNameWithExt = $login . "_" . $uniqueFileName . $fileExt;
                $finalFileName = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/avatar/" . $uniqueFileNameWithExt;
                $result = move_uploaded_file($tmpFileName, $finalFileName);

                if ($result) {
                    try {
                        $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET avatar_file=:avatar_file WHERE username=:login");
                        $stmtLogin->bindParam(':avatar_file', $uniqueFileNameWithExt);
                        $stmtLogin->bindParam(':login', $login);
                        $stmtLogin->execute();

                        $this->viewAlert->fileTransferSuccess();

                        if (!($_SESSION['avatar_file'] == "1.png")) {
                            $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/avatar/" . $_SESSION['avatar_file'];
                            unlink($oldFileToDelete);
                        }

                        $_SESSION['avatar_file'] = $uniqueFileNameWithExt;
                    } catch (Exception $e) {
                        echo 'Erreur survenue : ',  $e->getMessage(), "\n";
                    }
                } else {
                    $this->viewAlert->fileTransferError();
                }
            }
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function deleteCurrentAvatar()
    {

        if (isset($_SESSION['login'])) {

            $login = $_SESSION['login'];

            if ($_SESSION['avatar_file'] == "1.png") {
                $this->viewAlert->unableToDeleteAvatarIsDefault();
            } else {
                try {
                    $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET avatar_file='1.png' WHERE username=:login");
                    $stmtLogin->bindParam(':login', $login);
                    $stmtLogin->execute();

                    if (!($_SESSION['avatar_file'] == "1.png")) {
                        $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/avatar/" . $_SESSION['avatar_file'];
                        unlink($oldFileToDelete);
                    }

                    $_SESSION['avatar_file'] = "1.png";

                    $this->viewAlert->avatarDeleteSuccess();
                } catch (Exception $e) {
                    echo 'Erreur survenue : ',  $e->getMessage(), "\n";
                }
            }
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function sendUploadBanner()
    {
        if (isset($_POST["submit"]) && isset($_SESSION['login'])) {

            $login = $_SESSION['login'];
            $maxFileSize = 3000000;
            $acceptedExt = array('.png', '.jpg', '.jpeg');

            $fileName = $_FILES['bannerFile']['name'];
            $fileSize = $_FILES['bannerFile']['size'];
            $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));

            if ($_FILES['bannerFile']['error'] > 0) {
                $this->viewAlert->unknownErrorOccured();
            } else if ($fileSize > $maxFileSize) {
                $this->viewAlert->fileTooBig();
            } else if (!in_array($fileExt, $acceptedExt)) {
                $this->viewAlert->fileInvalidExt();
            } else {
                $tmpFileName = $_FILES['bannerFile']['tmp_name'];
                $uniqueFileName = md5(uniqid(rand(), true));
                $uniqueFileNameWithExt = $login . "_" . $uniqueFileName . $fileExt;
                $finalFileName = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/banner/" . $uniqueFileNameWithExt;
                $result = move_uploaded_file($tmpFileName, $finalFileName);

                if ($result) {
                    try {
                        $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET banner_file=:banner_file WHERE username=:login");
                        $stmtLogin->bindParam(':banner_file', $uniqueFileNameWithExt);
                        $stmtLogin->bindParam(':login', $login);
                        $stmtLogin->execute();

                        $this->viewAlert->fileTransferSuccess();

                        if (!($_SESSION['banner_file'] == "1.png")) {
                            $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/banner/" . $_SESSION['banner_file'];
                            unlink($oldFileToDelete);
                        }

                        $_SESSION['banner_file'] = $uniqueFileNameWithExt;
                    } catch (Exception $e) {
                        echo 'Erreur survenue : ',  $e->getMessage(), "\n";
                    }
                } else {
                    $this->viewAlert->fileTransferError();
                }
            }
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function deleteCurrentBanner()
    {

        if (isset($_SESSION['login'])) {

            $login = $_SESSION['login'];

            if ($_SESSION['banner_file'] == "1.png") {
                $this->viewAlert->unableToDeleteBannerIsDefault();
            } else {
                try {
                    $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET banner_file='1.png' WHERE username=:login");
                    $stmtLogin->bindParam(':login', $login);
                    $stmtLogin->execute();

                    if (!($_SESSION['banner_file'] == "1.png")) {
                        $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/banner/" . $_SESSION['banner_file'];
                        unlink($oldFileToDelete);
                    }

                    $_SESSION['banner_file'] = "1.png";

                    $this->viewAlert->bannerDeleteSuccess();
                } catch (Exception $e) {
                    echo 'Erreur survenue : ',  $e->getMessage(), "\n";
                }
            }
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function updateUserDetails()  {
        if (isset($_SESSION['login']) && isset($_POST['username']) && isset($_POST['email'])) {
            $username = $_SESSION['login'];
            $email = $_SESSION['email'];
            $id = $_SESSION['id'];

            $postUsername = htmlspecialchars($_POST['username']);
            $postEmail = htmlspecialchars($_POST['email']);
            $postPassword = htmlspecialchars($_POST['password']);

            // Username
            if (($postUsername != $username) && (strlen($postUsername) > 4) && !empty($postUsername) && (!preg_match('/[\'^£$%&*()}{@#~?><>,\|=_+¬-]./', $postUsername))) {
                $stmtCountUsername = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE username=:username");
                $stmtCountUsername->bindParam(':username', $postUsername);
                $stmtCountUsername->execute();
                $countRowUsername = $stmtCountUsername->rowCount();

                if ($countRowUsername != 0) {
                    $this->viewAlert->usernameAlreadyTaken();
                } else {
                    $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET username=:username WHERE id=:id");
                    $stmtLogin->bindParam(':username', $postUsername);
                    $stmtLogin->bindParam(':id', $id);
                    $stmtLogin->execute();

                    if ($stmtLogin) {
                        $_SESSION['login'] = $postUsername;
                        $this->viewAlert->userDetailsUpdateSuccess();
                    }
                }
            }
            else {
                $this->viewAlert->unknownErrorOccured();
            }
        }
        else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function updateAbout()  {
        if (isset($_SESSION['login']) && isset($_POST['about'])) {

            $about = htmlspecialchars($_POST['about']);
            $id = $_SESSION['id'];

            if (strlen($about) <= 300) {
                $stmtAbout = parent::$db->prepare("UPDATE showbizflex.accounts SET about=:about WHERE id=:id");
                $stmtAbout->bindParam(':about', $about);
                $stmtAbout->bindParam(':id', $id);
                $stmtAbout->execute();

                if ($stmtAbout) {
                    $this->viewAlert->aboutUpdateSuccess();
                }
            }
            else {
                $this->viewAlert->unknownErrorOccured();
            }
        }
        else {
            $this->viewAlert->userNotAuthenticated();
        }
    }
}
