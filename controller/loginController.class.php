<?php

require_once __DIR__ . '/../services/userService.class.php';

class LoginController
{
    public $message = "";
    function index()
    {
        $title = 'Login';

        require_once __DIR__ . '/../view/login.php';
    }

    function checkUser()
    {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $us = new UserService();
            $user = $us->verifyUser($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                $this->message = "Incorrect password or username.";
                require_once __DIR__ . '/../view/login.php';
            }
        } else {
            $this->message = "All spaces are mandatory.";
            require_once __DIR__ . '/../view/login.php';
        }
    }

    function logout()
    {
        session_unset();
        session_destroy();

        header('Location: index.php');
        exit();
    }
}
