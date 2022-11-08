<?php

require_once('PDOConnection.php');
require_once('Alert.php');
require_once('./Mail/Mail.php');

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

    public function sendRegister()
    {

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordconfirm = htmlspecialchars($_POST['passwordconfirm']);
        $passwordhashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $tos = htmlspecialchars($_POST['tos']);
        $ip = $this->getIP();
        $ua = $this->getUA();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && !empty($_POST['username'])) {
            try {
                $stmtCountUsername = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE username=:username");
                $stmtCountUsername->bindParam(':username', $username);
                $stmtCountUsername->execute();
                $countRowUsername = $stmtCountUsername->rowCount();

                $stmtCountEmail = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE email=:email");
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
                } else if (!str_contains($email, '@') || !str_contains($email, '.') || preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email)) {
                    $this->viewAlert->invalidEmail();
                } else if ($password !== $passwordconfirm) {
                    $this->viewAlert->passwordDifferents();
                } else if (strlen($password) < 6) {
                    $this->viewAlert->passwordTooShort();
                } else if ($tos != 1) {
                    $this->viewAlert->userDidNotAcceptedTOS();
                } else {

                    $stmtRegisterNewUser = parent::$db->prepare("INSERT INTO showbizflex.accounts(username, email, password, registration_ip, registration_ua, is_admin, avatar_file) VALUES (:username, :email, :password, :registration_ip, :registration_ua, 0, '1.png')");
                    $stmtRegisterNewUser->bindParam(':username', $username);
                    $stmtRegisterNewUser->bindParam(':email', $email);
                    $stmtRegisterNewUser->bindParam(':password', $passwordhashed);
                    $stmtRegisterNewUser->bindParam(':registration_ip', $ip);
                    $stmtRegisterNewUser->bindParam(':registration_ua', $ua);
                    $stmtResult = $stmtRegisterNewUser->execute();

                    if ($stmtResult) {
                        $this->viewAlert->registrationSuccessful();
                        $this->sendMail->sendWelcomeEmail($username, $email);
                    } else {
                        $this->viewAlert->unknownErrorWhileRegistration();
                    }
                }
            } catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
        else {
            $this->viewAlert->invalidRequest();
        }
    }

    public function sendLogin()
    {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && !empty($_POST['login'])) {
        try {
            $stmtLogin = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE username=:login OR email=:login");
            $stmtLogin->bindParam(':login', $login);
            $stmtLogin->execute();
            $stmtResult = $stmtLogin->fetch();

            if ($stmtResult && password_verify($password, $stmtResult['password'])) {
                $_SESSION["id"] = $stmtResult['id'];
                $_SESSION["login"] = $stmtResult['username'];
                $_SESSION["email"] = $stmtResult['email'];
                $_SESSION["avatar_file"] = $stmtResult['avatar_file'];

                if ($stmtResult['is_admin'] == 1) {
                    $_SESSION["is_admin"] = "1";
                }

                header('Location: ./');
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

    public function sendLogout()
    {
        if (isset($_SESSION['login'])) {
            session_unset();
            session_destroy();

            $this->viewAlert->logoutSuccessful();
        } else {
            $this->viewAlert->logoutError();
        }
    }

    public function sendForgot()
    {
        if (isset($_POST['email']) && !empty($_POST['email']) && str_contains($_POST['email'], '@') && str_contains($_POST['email'], '.') && !preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $_POST['email'])) {
            try {
                $email = htmlspecialchars($_POST['email']);
                $forgot_auth = sha1(uniqid(rand(), true));
    
                $stmtCountEmail = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE email=:email");
                $stmtCountEmail->bindParam(':email', $email);
                $stmtCountEmail->execute();
                $stmtCountEmailResult = $stmtCountEmail->fetch();
                $countRowEmail = $stmtCountEmail->rowCount();

                if ($countRowEmail == 0) {
                    $this->viewAlert->emailDontExist();
                } else {
                    $stmtLogin = parent::$db->prepare("UPDATE showbizflex.accounts SET forgot_auth=:forgot_auth WHERE email=:email");
                    $stmtLogin->bindParam(':forgot_auth', $forgot_auth);
                    $stmtLogin->bindParam(':email', $email);
                    $stmtLogin->execute();

                    $this->sendMail->sendForgotEmail($stmtCountEmailResult['username'], $email, $forgot_auth);
                    $this->viewAlert->forgotEmailSent();
                }
            }
            catch (Exception $e) {
                echo 'Erreur survenue : ',  $e->getMessage(), "\n";
            }
        }
        else {
            $this->viewAlert->invalidRequestForgot();
        }
    }

    public function verifyResetPassword($email, $forgot_auth)
    {

        //  Fonctionnel mais à fix, il y a des warnings qu'il faut examiner.

        $stmtEmail = parent::$db->prepare("SELECT * FROM showbizflex.accounts WHERE email=:email");
        $stmtEmail->bindParam(':email', $email);
        $stmtEmail->execute();
        $stmtEmailResult = $stmtEmail->fetch();
        $stmtEmailRowCount = $stmtEmail->rowCount();

        $emailInDB = $stmtEmailResult['email'];
        $forgotAuthInDB = $stmtEmailResult['forgot_auth'];

        if ($stmtEmailRowCount == 1) {
            if (($email == $emailInDB) && ($forgot_auth == $forgotAuthInDB)) {
                $_SESSION['passwordResetEmail'] = $email;
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function sendResetPassword() {
        if (isset($_SESSION['passwordResetEmail'])) {
            if (isset($_POST['password']) && isset($_POST['confirmpassword']) && !empty($_POST['password']) && !empty($_POST['confirmpassword']) && strlen($_POST['password']) >= 6) {

                $email = $_SESSION['passwordResetEmail'];
                $password = htmlspecialchars($_POST['password']);
                $confirmpassword = htmlspecialchars($_POST['confirmpassword']);

                if ($password == $confirmpassword) {

                    $passwordhashed = password_hash($password, PASSWORD_DEFAULT);

                    $stmtReset = parent::$db->prepare("UPDATE showbizflex.accounts SET password=:password WHERE email=:email");
                    $stmtReset->bindParam(':password', $passwordhashed);
                    $stmtReset->bindParam(':email', $email);
                    $stmtReset->execute();

                    if ($stmtReset) {
                        $stmtResetForgotAuth = parent::$db->prepare("UPDATE showbizflex.accounts SET forgot_auth=NULL WHERE email=:email");
                        $stmtResetForgotAuth->bindParam(':email', $email);
                        $stmtResetForgotAuth->execute();

                        if ($stmtResetForgotAuth) {
                            session_unset();
                            session_destroy();

                            $this->viewAlert->passwordResetSuccess();
                        }
                    }
                }
                else {
                    $this->viewAlert->passwordDifferents();
                }
            }
            else {
                $this->viewAlert->invalidRequestForgot();
            }
        }
        else {
            $this->viewAlert->invalidRequestForgot();
        }
    }
}