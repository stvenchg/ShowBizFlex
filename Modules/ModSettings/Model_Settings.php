<?php

require_once('PDOConnection.php');
require_once('View_Settings.php');

class ModelSettings extends PDOConnection
{

    //private $view;

    public function __construct()
    {
        //$this->view = new ViewSettings;
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
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Une erreur est survenue.',
                    'error'
                  ).then(function() {
                    window.location = './?module=settings&action=uploadAvatar';
                });</script>";
            } else if ($fileSize > $maxFileSize) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Le poids du fichier sélectionné dépasse la limite autorisée (500 Ko).',
                    'error'
                  ).then(function() {
                    window.location = './?module=settings&action=uploadAvatar';
                });</script>";
            } else if (!in_array($fileExt, $acceptedExt)) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Uniquement les fichiers au format .PNG sont acceptés.',
                    'error'
                  ).then(function() {
                    window.location = './?module=settings&action=uploadAvatar';
                });</script>";
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

                        echo "<script>Swal.fire(
                            'Importation réussie !',
                            'Le fichier a bien été chargé et ta photo de profil a été mise à jour.',
                            'success'
                          ).then(function() {
                            window.location = './?module=settings';
                        });</script>";
                        $_SESSION['avatar_id'] = $uniqueFileName;
                        
                    } catch (Exception $e) {
                        echo 'Erreur survenue : ',  $e->getMessage(), "\n";
                    }
                }
                else {
                    echo "<script>Swal.fire(
                        'Il y a un problème !',
                        'Le transfert du fichier a échoué. Merci de réessayer.',
                        'error'
                      ).then(function() {
                        window.location = './?module=settings&action=uploadAvatar';
                    });</script>";
                }
            }
        } else {
            echo "<script>Swal.fire(
                'Il y a un problème !',
                'Tu n\'es pas connecté.',
                'error'
              ).then(function() {
                window.location = './?module=auth&action=login';
            });</script>";
        }
    }
}
