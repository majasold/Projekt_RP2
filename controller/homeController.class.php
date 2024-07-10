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

        $message = "";

        $usersForChangeRole = [];
        if(isset($_POST['id_korisnik'])){
            $idKorisnik = $_POST['id_korisnik'];
            $role = $_POST['role'];
            $us = new UserService();
            $user = getUserById($idKorisnik);
            if(!$user){
                $this->message = "There is no user with id = " . $idKorisnik;
            }
            else {
                //echo $user->id . ' ' . $user->name . ' ' . $user->surname. ' ' .$user->role;
                $users = $us->getUsers();
                if (!$users){
                    $this->message = "There are no users in data.";
                } else {
                    foreach ($users as $user) {
                        $list = array("id" => $idKorisnik, "name" => $name, "surname" => $surname, "role" => $role);
                        $usersForChangeRole[] = $list;
                    }
                }
            }
        } else {
            $this->message = "Needed id in URL for user.";
        }
        require_once __DIR__ . '/../view/change_role.php';
    }
}