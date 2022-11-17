<?php

require_once('PDOConnection.php');
require_once('Alert.php');
require_once('./Mail/Mail.php');

class ModelSettings extends PDOConnection
{

    private $viewAlert;
    private $sendMail;

    public function __construct()
    {
        $this->viewAlert = new Alert;
        $this->sendMail = new Mail;
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
                $finalFileName = $_SERVER['DOCUMENT_ROOT'] . "/Assets/images/avatar/" . $uniqueFileNameWithExt;
                $result = move_uploaded_file($tmpFileName, $finalFileName);

                if ($result) {
                    try {
                        $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET avatar_file=:avatar_file WHERE username=:login");
                        $stmtLogin->bindParam(':avatar_file', $uniqueFileNameWithExt);
                        $stmtLogin->bindParam(':login', $login);
                        $stmtLogin->execute();

                        $this->viewAlert->fileTransferSuccess();

                        if (!($_SESSION['avatar_file'] == "1.png")) {
                            $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "/Assets/images/avatar/" . $_SESSION['avatar_file'];
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
                        $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "/Assets/images/avatar/" . $_SESSION['avatar_file'];
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
                $finalFileName = $_SERVER['DOCUMENT_ROOT'] . "/Assets/images/banner/" . $uniqueFileNameWithExt;
                $result = move_uploaded_file($tmpFileName, $finalFileName);

                if ($result) {
                    try {
                        $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET banner_file=:banner_file WHERE username=:login");
                        $stmtLogin->bindParam(':banner_file', $uniqueFileNameWithExt);
                        $stmtLogin->bindParam(':login', $login);
                        $stmtLogin->execute();

                        $this->viewAlert->fileTransferSuccess();

                        if (!($_SESSION['banner_file'] == "1.png")) {
                            $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "/Assets/images/banner/" . $_SESSION['banner_file'];
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
                        $oldFileToDelete = $_SERVER['DOCUMENT_ROOT'] . "/Assets/images/banner/" . $_SESSION['banner_file'];
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

    public function updateUsername()  {
        if (isset($_SESSION['login']) && isset($_POST['username'])) {

            $user = $this->getUserDetails();

            $current_username = $user['username'];
            $email = $user['email'];
            $username = htmlspecialchars($_POST['username']);
            $id = $_SESSION['id'];

            $stmtCheckIfUsernameAlreadyTaken = parent::$db->prepare("SELECT username FROM showbizflex.accounts WHERE username=:username");
            $stmtCheckIfUsernameAlreadyTaken->bindParam(':username', $username);
            $stmtCheckIfUsernameAlreadyTaken->execute();
            $stmtUsernameCount = $stmtCheckIfUsernameAlreadyTaken->rowCount();

            if ((strlen($username) > 4) && !preg_match("/[\'^£$%&*()}{@#~?><>,\|=_+¬-].!/", $username) && $stmtUsernameCount == 0) {
                
                $stmtUsername = parent::$db->prepare("UPDATE showbizflex.accounts SET username=:username WHERE id=:id");
                $stmtUsername->bindParam(':username', $username);
                $stmtUsername->bindParam(':id', $id);
                $stmtUsername->execute();

                if ($stmtUsername) {
                    $this->viewAlert->usernameUpdateSuccess();
                    $this->sendMail->sendNotificationUsernameChanged($current_username, $username, $email);
                    $_SESSION['login'] = $username;
                }
            }
            else if ($stmtUsernameCount > 0) {
                $this->viewAlert->usernameUpdateAlreadyTaken();
            }
            else {
                $this->viewAlert->unknownErrorOccured();
            }
        }
        else {
            $this->viewAlert->userNotAuthenticated();
        }
    }

    public function updateEmail()  {
        if (isset($_SESSION['login']) && isset($_POST['email'])) {

            $current_email = $_SESSION['email'];
            $email = htmlspecialchars($_POST['email']);
            $id = $_SESSION['id'];

            $stmtCheckIfEmailAlreadyTaken = parent::$db->prepare("SELECT email FROM showbizflex.accounts WHERE email=:email");
            $stmtCheckIfEmailAlreadyTaken->bindParam(':email', $email);
            $stmtCheckIfEmailAlreadyTaken->execute();
            $stmtEmailCount = $stmtCheckIfEmailAlreadyTaken->rowCount();

            if ((strlen($email) > 5) && preg_match("/@/", $email) && $stmtEmailCount == 0) {
                
                $stmtEmail = parent::$db->prepare("UPDATE showbizflex.accounts SET email=:email WHERE id=:id");
                $stmtEmail->bindParam(':email', $email);
                $stmtEmail->bindParam(':id', $id);
                $stmtEmail->execute();

                if ($stmtEmail) {
                    $this->viewAlert->emailUpdateSuccess();
                    $this->sendMail->sendNotificationEmailChanged($current_email, $email, $current_email, $email);
                    
                    $_SESSION['email'] = $email;
                }
            }
            else if ($stmtEmailCount > 0) {
                $this->viewAlert->emailAlreadyTaken();
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
