<?php

require_once('PDOConnection.php');
require_once('Alert.php');
require_once('Mail/Mail.php');

class ModelAuth extends PDOConnection
{

    private $viewAlert;
    private $sendMail;

    public function __construct()
    {
        $this->viewAlert = new Alert;
        $this->sendMail = new Mail;
    }

    public function getIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getUA()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function sendLogin()
    {

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $pin = htmlspecialchars($_POST['pin']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['pin']) && !empty($_POST['pin']) && isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {

        try {
            $stmtLoginAdmin = parent::$db->prepare("SELECT * FROM UserAdmin WHERE email=:email");
            $stmtLoginAdmin->bindParam(':email', $email);
            $stmtLoginAdmin->execute();
            $stmtResult = $stmtLoginAdmin->fetch();

            if ($stmtResult && password_verify($password, $stmtResult['password']) && password_verify($pin, $stmtResult['pin'])) {
                $_SESSION["admin_id"] = $stmtResult['id'];
                $_SESSION["admin_username"] = $stmtResult['username'];
                $_SESSION["admin_email"] = $stmtResult['email'];              
                header('Location: ./');
                $this->viewAlert->emailUpdateSuccess();
            } else {
                $this->viewAlert->invalidLoginDetails();
            }
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
        } else {
            $this->viewAlert->invalidRequest();
        }
    }

    public function sendRegister()
    {

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordconfirm = htmlspecialchars($_POST['confirmpassword']);
        $passwordhashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $pin = htmlspecialchars($_POST['pin']);
        $pinconfirm = htmlspecialchars($_POST['confirmpin']);
        $pinhashed = password_hash($_POST['pin'], PASSWORD_DEFAULT);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && !empty($_POST['username']) && isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1) {
            try {
                $stmtCountUsername = parent::$db->prepare("SELECT * FROM UserAdmin WHERE username=:username");
                $stmtCountUsername->bindParam(':username', $username);
                $stmtCountUsername->execute();
                $countRowUsername = $stmtCountUsername->rowCount();

                $stmtCountEmail = parent::$db->prepare("SELECT * FROM UserAdmin WHERE email=:email");
                $stmtCountEmail->bindParam(':email', $email);
                $stmtCountEmail->execute();
                $countRowEmail = $stmtCountEmail->rowCount();

                if ($countRowUsername >= 1 && $countRowEmail >= 1) {
                    $this->viewAlert->usernameAndPasswordAlreadyUsed();
                } else if ($countRowEmail >= 1) {
                    $this->viewAlert->emailAlreadyUsed();
                } else if ($countRowUsername >= 1) {
                    $this->viewAlert->usernameAlreadyUsed();
                } else if (strlen($username) < 4) {
                    $this->viewAlert->usernameTooShort();
                } else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]./', $username)) {
                    $this->viewAlert->specialCharsInUsername();
                } else if ($password !== $passwordconfirm) {
                    $this->viewAlert->passwordDifferents();
                } else if ($pin !== $pinconfirm) {
                    $this->viewAlert->passwordDifferents();
                } else if (strlen($password) < 6) {
                    $this->viewAlert->passwordTooShort();
                } else if (!is_numeric($pin)) {
                    $this->viewAlert->pinOnlyNumberAllowed();
                } else {
                    // Insertion des informations concernant le compte de administrateur
                    $stmtRegisterNewAdmin = parent::$db->prepare("INSERT INTO UserAdmin(username, email, password, pin) VALUES (:username, :email, :password, :pin)");
                    $stmtRegisterNewAdmin->bindParam(':username', $username);
                    $stmtRegisterNewAdmin->bindParam(':email', $email);
                    $stmtRegisterNewAdmin->bindParam(':password', $passwordhashed);
                    $stmtRegisterNewAdmin->bindParam(':pin', $pinhashed);
                    $stmtResult = $stmtRegisterNewAdmin->execute();

                    if ($stmtResult) {
                        $this->viewAlert->registrationSuccessful();
                    } else {
                        $this->viewAlert->unknownErrorWhileRegistration();
                    }
                }
            } catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        } else {
            $this->viewAlert->invalidRequest();
        }
    }

    public function sendLogout()
    {
        if (isset($_SESSION['admin_id'])) {

            session_unset();
            session_destroy();

            header('Location: ./');
        } else {
            $this->viewAlert->logoutError();
        }
    }
}


/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/