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
        $tos = htmlspecialchars($_POST['tos']);

        try {
            $stmtCountUsername = parent::$bdd->prepare("SELECT * FROM accounts WHERE username=:username");
            $stmtCountUsername->bindParam(':username', $username);
            $stmtCountUsername->execute();
            $countRowUsername = $stmtCountUsername->rowCount();

            $stmtCountEmail = parent::$bdd->prepare("SELECT * FROM accounts WHERE email=:email");
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
                echo "<script>Swal.fire(
                    'Inscription validée !',
                    'Tu recevras dans un instant un e-mail de confirmation.',
                    'success'
                  ).then(function() {
                    window.location = './?module=auth&action=login';
                });</script>";
            }
        } catch (Exception $e) {
            echo 'Erreur survenue : ',  $e->getMessage(), "\n";
        }
    }

    public function sendLogin()
    {
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }
}
