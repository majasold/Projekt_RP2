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
        if (!empty($_POST['email']) and !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $us = new UserService();
            $user = $us->verifyUser($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                $this->message = "Incorrect password or email.";
                require_once __DIR__ . '/../view/login.php';
            }
        } else {
            $this->message = "All spaces are mandatory.";
            require_once __DIR__ . '/../view/login.php';
        }
    }

    function checkGoogle()
    {
        require_once __DIR__ . '/../../../googleauth.php';
        // If the captured code param exists and is valid
        if (isset($_GET['code']) && !empty($_GET['code'])) {
            // Execute cURL request to retrieve the access token
            $params = [
                'code' => $_GET['code'],
                'client_id' => $google_oauth_client_id,
                'client_secret' => $google_oauth_client_secret,
                'redirect_uri' => $google_oauth_redirect_uri,
                'grant_type' => 'authorization_code'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response, true);
            // Make sure access token is valid
            if (isset($response['access_token']) && !empty($response['access_token'])) {
                // Execute cURL request to retrieve the user info associated with the Google account
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
                $response = curl_exec($ch);
                curl_close($ch);
                $profile = json_decode($response, true);
                // Make sure the profile data exists
                if (isset($profile['email'])) {
                    $firstName = isset($profile['given_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['given_name']) : '';
                    $lastName = isset($profile['family_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['family_name']) : '';
                    // Authenticate the user
                    session_regenerate_id();
                    $email = $profile['email'];
                    $us = new UserService();
                    $user = $us->getExistingUser($email);
                    if ($user) {
                        $_SESSION['user'] = $user;
                    } else { // ako ga nema u bazi trebamo ga dodati
                        $password = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 10)), 0, 10);
                        $user = $us->insertNewUser($email, $firstName, $lastName, $password);
                        if ($user) {
                            $_SESSION['user'] = $user;
                        }
                    }
                    header('Location: index.php');
                } else {
                    exit('Could not retrieve profile information! Please try again later!');
                }
            } else {
                exit('Invalid access token! Please try again later!');
            }
        } else {
            // Define params and redirect to Google Authentication page
            $params = [
                'response_type' => 'code',
                'client_id' => $google_oauth_client_id,
                'redirect_uri' => $google_oauth_redirect_uri,
                'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
                'access_type' => 'offline',
                'prompt' => 'consent'
            ];
            header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
            exit;
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
            !empty($_POST['email']) and
            !empty($_POST['firstname']) and !empty($_POST['lastname'])
            and !empty($_POST['password']) and !empty($_POST['confirm_password'])
        ) {
            $email = $_POST['email'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $password = $_POST['password'];
            $checkPassword = $_POST['confirm_password'];
            $allFieldsOK = true;

            if ($us->getExistingUser($email)) {
                $allFieldsOK = false;
                $this->message = "Account with this email already exists.";
                require_once __DIR__ . '/../view/register.php';
            } elseif (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false)) {
                $allFieldsOK = false;
                $this->message = "The email address is not valid.";
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
                if (!$us->insertNewUser($email, $firstName, $lastName, $password)) {
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
