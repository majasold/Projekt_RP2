<?php

require_once __DIR__ . '/../services/movieService.class.php';

class HomeController
{
    public $message = "";
    function index()
    {
        $title = 'HOME';

        $ms = new MovieService();

        $movies = $ms->getMovies();

        if (!$movies)
            $message = 'No movies available.';

        require_once __DIR__ . '/../view/home.php';
    }

    function changeRole()
    {
        $title = 'CHANGE ROLE';
        $us = new UserService();
        $users = $us->getUsers();
        require_once __DIR__ . '/../view/change_role.php';
    }

    function changeThisRole()
    {
        $usersForChangeRole = [];
        if(isset($_POST['users']) && is_array($_POST['users'])){
            if(!$users){
                $this->message = "There are no users in data.";
            }
            else {
                //echo $user->id . ' ' . $user->name . ' ' . $user->surname. ' ' .$user->role;
                foreach ($users as $user) {
                    $idKorisnik = $_POST['id_korisnik'];
                    $user = $us->getUserById($idKorisnik);
                    //$idKorisnik = $_POST['id_korisnik'];
                    $role = $_POST['role'];
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    if (!$user){
                        $this->message = "There is no user with id = " . $idKorisnik;
                    } else {
                        $list = array("id" => $idKorisnik, "name" => $name, "surname" => $surname, "role" => $role);
                        $usersForChangeRole[] = $list;
                    }
                }
            }
        } else {
            $this->message = "Needed id for user.";
        }
        require_once __DIR__ . '/../view/change_role.php';
    }
}