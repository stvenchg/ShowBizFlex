<?php

require_once('PDOConnection.php');

class ModelAuth extends PDOConnection
{

    private $view;

    public function __construct()
    {}

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
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Ce nom d'utilisateur ainsi que cet email sont déjà utilisé.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
                echo "Ce nom d'utilisateur ainsi que cet email sont déjà utilisé.";
            } else if ($countRowEmail >= 1) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Cet email est déjà utilisé.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
                echo "Cet email est déjà utilisé.";
            } else if ($countRowUsername >= 1) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Ce nom d'utilisateur est déjà utilisé.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
                echo "Ce nom d'utilisateur est déjà utilisé.";
            } else if (strlen($username) < 4) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Le nom d'utilisateur saisi est trop court. Il doit comporter au moins 4 caractères.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
                echo "Le nom d'utilisateur saisi est trop court. Il doit comporter au moins 4 caractères.";
            } else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]./', $username)) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Le nom d'utilisateur doit uniquement être constitué de chiffres et de lettres.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
                echo "Le nom d'utilisateur doit uniquement être constitué de chiffres et de lettres.";
            } else if (!str_contains($email, '@') || !str_contains($email, '.') || preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email)) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'L'adresse e-mail saisie est incorrecte.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
                echo "L'adresse e-mail saisie est incorrecte.";
            } else if ($password !== $passwordconfirm) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Les mots de passe saisis ne sont pas identiques.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
            } else if (strlen($password) < 6) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Le mot de passe saisi est trop court. Il doit comporter au moins 4 caractères.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
            } else if ($tos != 1) {
                echo "<script>Swal.fire(
                    'Il y a un problème !',
                    'Il est nécessaire d'accepter les conditions générales d'utilisation.',
                    'error'
                  ).then(function() {
                    window.location = './?module=auth&action=register';
                });</script>";
            } else {

                $stmtRegisterNewUser = parent::$db->prepare("INSERT INTO accounts(username, email, password, is_admin) VALUES (:username, :email, :password, 0)");
                $stmtRegisterNewUser->bindParam(':username', $username);
                $stmtRegisterNewUser->bindParam(':email', $email);
                $stmtRegisterNewUser->bindParam(':password', $passwordhashed);
                $stmtResult = $stmtRegisterNewUser->execute();

                if ($stmtResult) {
                    echo "<script>Swal.fire(
                        'Inscription validée !',
                        'Tu recevras dans un instant un e-mail de confirmation.',
                        'success'
                      ).then(function() {
                        window.location = './?module=auth&action=login';
                    });</script>";


                } else {
                    echo "<script>Swal.fire(
                        'Il y a un problème !',
                        'Une erreur est survenue. Merci de recommencer ton inscription.',
                        'error'
                      ).then(function() {
                        window.location = './?module=auth&action=register';
                    });</script>";
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
                echo '<p style="color:green">Vous êtes bien connecté.</p>';
            } else {
                echo '<p style="color:red">Le login ou le mot de passe est invalide.</p>';
            }
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        echo '<p style="color:green">Vous avez été déconnecté.</p>';
        header("refresh:2;url=index.php");
    }
}
