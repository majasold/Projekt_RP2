<link rel="stylesheet" href="./view/index.css">
<?php
require_once __DIR__ . '/model/user.class.php';
session_start();

/* $role najmanji potrebni role da se pristupi ruti
$role = 0 za one vidljive svima (bez logina)
$role = 1 mogu pristupati user, employee i admin
$role = 2 mogu pristupati employee i admin
$role = 3 moze pristupiti samo admin
*/
$routes = array(
    array('con' => 'login', 'action' => 'index', 'role' => 0),
    array('con' => 'login', 'action' => 'checkUser', 'role' => 0),
    array('con' => 'login', 'action' => 'logout', 'role' => 1),
    array('con' => 'home', 'action' => 'index', 'role' => 0),
    array('con' => 'login', 'action' => 'register', 'role' => 0),
    array('con' => 'login', 'action' => 'addUser', 'role' => 0),
    array('con' => 'projections', 'action' => 'overview', 'role' => 0)
);

if (!isset($_GET['rt'])) {
    $con = 'home';
    $action = 'index';
} else {
    $rt = $_GET['rt'];
    $x = explode('/', $rt);

    if (count($x) === 1) {
        $con = $x[0];
        $action = 'index';
    } else {
        $con = $x[0]; // con je controller na koji ga saljemo
        $action = $x[1]; // action je funkcija u controlleru
    }
    if (isset($_SESSION['user'])) {
        $role = $_SESSION['user']->role;
        foreach ($routes as $route) {
            if ($route['con'] === $con and $route['action'] === $action) {
                if ($role < $route['role']) {
                    $con = 'home';
                    $action = 'index';
                }
                break;
            }
        }
    }
}


$controllerName = $con . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . '.class.php';
$c = new $controllerName;

$c->$action();
