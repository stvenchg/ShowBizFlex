<?php

require_once('Model_Auth.php');
require_once('View_Auth.php');

class ContAuth 
{
    private $view;
    private $model;
    private $action;

    public function __construct() 
    {
        $this->view = new ViewAuth();
        $this->model = new ModelAuth();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "login";
    }

    public function getAction() {
        return $this->action;
    }

    // Login
    public function login() {
        $this->view->form_login();
    }

    public function sendLogin() {
        $this->model->sendLogin();
    }

    // Register
    public function register() {
        $this->view->form_register();
    }

    public function sendRegister() {
        $this->model->sendRegister();
    }

    // Logout
    public function logout() {
        $this->model->sendLogout();
    }

    // Forgot password
    public function forgot() {
        $this->view->form_forgot();
    }

    public function sendForgot() {
        $this->model->sendForgot();
    }

    public function resetPassword() {
        $this->view->form_resetPassword();
    }

    public function sendResetPassword() {
        $this->model->sendResetPassword();
    }


    public function exec() {
        $this->view->view();
    }
}