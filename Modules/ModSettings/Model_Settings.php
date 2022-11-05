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
            $maxFileSize = 500000;
            $acceptedExt = array('.png');

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
                $finalFileName = $_SERVER['DOCUMENT_ROOT'] . "Assets/images/avatar/" . $uniqueFileName . $fileExt;
                $result = move_uploaded_file($tmpFileName, $finalFileName);

                if ($result) {
                    try {
                        $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET avatar_id=:avatar_id WHERE username=:login");
                        $stmtLogin->bindParam(':avatar_id', $uniqueFileName);
                        $stmtLogin->bindParam(':login', $login);
                        $stmtLogin->execute();

                        $this->viewAlert->fileTransferSuccess();
                        $_SESSION['avatar_id'] = $uniqueFileName;
                        
                    } catch (Exception $e) {
                        echo 'Erreur survenue : ',  $e->getMessage(), "\n";
                    }
                }
                else {
                    $this->viewAlert->fileTransferError();
                }
            }
        } else {
            $this->viewAlert->userNotAuthenticated();
        }
    }
}