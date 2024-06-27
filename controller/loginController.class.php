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

    function register()
    {
        $title = 'Register';
        require_once __DIR__ . '/../view/register.php';
    }

    function addUser()
    {
        $us = new UserService();
        if (
            !empty($_POST['username']) and
            !empty($_POST['firstname']) and !empty($_POST['lastname'])
            and !empty($_POST['password']) and !empty($_POST['confirm_password'])
        ) {
            $username = $_POST['username'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $password = $_POST['password'];
            $checkPassword = $_POST['confirm_password'];
            $allFieldsOK = true;

            if ($us->verifyExistingUser($username)) {
                $allFieldsOK = false;
                $this->message = "Account with this username already exists.";
                require_once __DIR__ . '/../view/register.php';
            } elseif (!preg_match('/^[A-Za-z0-9]{3,10}$/', $_POST['username'])) {
                $allFieldsOK = false;
                $this->message = "Username should be between 3 and 10 alphanumeric characters.";
                require_once __DIR__ . '/../view/register.php';
            } elseif (!preg_match('/^[A-Za-z]{1,20}$/', $firstName) or !preg_match('/^[A-Za-z]{1,20}$/', $lastName)) {
                $allFieldsOK = false;
                $this->message = "First Name and Last Name should be between 1 and 20 letters.";
                require_once __DIR__ . '/../view/register.php';
            } elseif ($password !== $checkPassword) {
                $allFieldsOK = false;
                $this->message = "Password and Check Password need to match.";
                require_once __DIR__ . '/../view/register.php';
            } elseif (!preg_match('/^(?=.*\d).{8,}$/', $password)) {
                $allFieldsOK = false;
                $this->message = "Password needs to have minimum length 8 and at least one number.";
                require_once __DIR__ . '/../view/register.php';
            }

            if ($allFieldsOK) {
                if (!$us->insertNewUser($username, $firstName, $lastName, $password)) {
                    $this->message = "Error in adding new user. Please try again.";
                    require_once __DIR__ . '/../view/register.php';
                } else {
                    header('Location: index.php?rt=login');
                }
            }
        } else {
            $this->message = "All spaces are mandatory.";
            require_once __DIR__ . '/../view/register.php';
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
