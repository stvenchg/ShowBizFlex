<?php

require_once('PDOConnection.php');
require_once('View_Auth.php');

class ModelAuth extends PDOConnection
{

    private $view;

    public function __construct()
    {
        $this->view = new ViewAuth;
    }

    public function sendRegister()
    {

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordconfirm = htmlspecialchars($_POST['passwordconfirm']);
        $passwordhashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $tos = htmlspecialchars($_POST['tos']);

        try {
            $stmtCountUsername = parent::$db->prepare("SELECT * FROM accounts WHERE username=:username");
            $stmtCountUsername->bindParam(':username', $username);
            $stmtCountUsername->execute();
            $countRowUsername = $stmtCountUsername->rowCount();

            $stmtCountEmail = parent::$db->prepare("SELECT * FROM accounts WHERE email=:email");
            $stmtCountEmail->bindParam(':email', $email);
            $stmtCountEmail->execute();
            $countRowEmail = $stmtCountEmail->rowCount();

            if ($countRowUsername >= 1 && $countRowEmail >= 1) {
                $this->view->usernameAndPasswordAlreadyUsed();
            } else if ($countRowEmail >= 1) {
                $this->view->emailAlreadyUsed();
            } else if ($countRowUsername >= 1) {
                $this->view->usernameAlreadyUsed();
            } else if (strlen($username) < 4) {
                $this->view->usernameTooShort();
            } else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]./', $username)) {
                $this->view->specialCharsInUsername();
            } else if (!str_contains($email, '@') || !str_contains($email, '.') || preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email)) {
                $this->view->invalidEmail();
            } else if ($password !== $passwordconfirm) {
                $this->view->passwordDifferents();
            } else if (strlen($password) < 6) {
                $this->view->passwordTooShort();
            } else if ($tos != 1) {
                $this->view->userDidNotAcceptedTOS();
            } else {

                $stmtRegisterNewUser = parent::$db->prepare("INSERT INTO accounts(username, email, password, is_admin) VALUES (:username, :email, :password, 0)");
                $stmtRegisterNewUser->bindParam(':username', $username);
                $stmtRegisterNewUser->bindParam(':email', $email);
                $stmtRegisterNewUser->bindParam(':password', $passwordhashed);
                $stmtResult = $stmtRegisterNewUser->execute();

                if ($stmtResult) {
                    $this->view->registrationSuccessful();
                } else {
                    $this->view->unknownErrorWhileRegistration();
                }
            }
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function sendLogin()
    {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        try {
            $stmtLogin = parent::$db->prepare("SELECT * FROM accounts WHERE username=:login OR email=:login");
            $stmtLogin->bindParam(':login', $login);
            $stmtLogin->execute();
            $stmtResult = $stmtLogin->fetch();
            
            if ($stmtResult && password_verify($password, $stmtResult['password'])) {
                $_SESSION["login"] = $stmtResult['username'];
                header('Location: ./');
            } else {
                $this->view->invalidLoginDetails();
            }
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['login'])) {
            session_unset();
            session_destroy();

            $this->view->logoutSuccessful();
        }
        else {
            $this->view->logoutError();
        }
    }
}