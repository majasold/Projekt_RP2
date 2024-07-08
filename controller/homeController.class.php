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

        if(isset($_GET['id_korisnik'])){
            $idKorisnik = $_GET['id_korisnik'];
            $us = new UserService();
            $user = getUserById($idKorisnik);
            if(!$user){
                $this->message = "There is no user with id = " . $idKorisnik;
            }
            else {
                //echo $user->id . ' ' . $user->name . ' ' . $user->surname. ' ' .$user->role;
                $ps = new ProjectionService();
                $projections = $ps->getProjectionsByMovieId($idMovie);
                if (!$projections) {
                    $this->message = "Movie " . $movie->name . "has no projections.";
                } else {
                    /*foreach ($projections as $projection) {
                        $hs = new HallService();
                        $hall = $hs->getHallByHallId($projection->id_hall);
                        $hallSize = $hall->nr_rows * $hall->nr_cols;
                        $rs = new ReservationService();
                        $takenSeats = $rs->getNrOfReservationsByProjectionId($projection->id_projection);
                        $freeSeats = $hallSize - $takenSeats;

                        $proj = array("projection" => $projection, "freeSeats" => $freeSeats);
                        $projForOverview[] = $proj;
                    }*/
                }
            }
        } else {
            $this->message = "Needed id in URL for user.";
        }
        require_once __DIR__ . '/../view/change_role.php';
    }
}
