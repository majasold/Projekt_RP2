<?php

require_once __DIR__ . '/../services/movieService.class.php';
require_once __DIR__ . '/../services/projectionService.class.php';
require_once __DIR__ . '/../services/hallService.class.php';
require_once __DIR__ . '/../services/reservationService.class.php'; 

class ProjectionsController
{
    public $message = "";
    /* za MY RESERVATIONS -> U reservationsController
    function index()
    {
    }
    */
    function overview()
    {
        $projForOverview = [];
        if (isset($_GET['id_movie'])) {
            $idMovie = $_GET['id_movie'];
            $ms = new MovieService();
            $movie = $ms->getMovieById($idMovie);
            if (!$movie) {
                $this->message = "There is no movie with id = " . $idMovie;
            } else {
                //echo $movie->id . ' ' . $movie->name . ' ' . $movie->url;
                
                $ps = new ProjectionService();
                $projections = $ps->getProjectionsByMovieId($idMovie);
                if (!$projections) {
                    $this->message = "Movie " . $movie->name . "has no projections.";
                } else {
                    foreach ($projections as $projection){
                        $hs = new HallService();
                        $hallSize = $hs->getHallSizeByHallId($projection->id_hall);
                        $rs = new ReservationService();
                        $takenSpaces = $rs->getNrOfReservationsByProjectionId($projection->id_projection);
                        $freeSp = $hallSize - $takenSpaces;

                        $proj = array("projection"=>$projection, "freeSpaces"=>$freeSp);
                        $projForOverview[] = $proj;
                    }
                }               
            }
        } else {
            $this->message = "Needed id in URL for movie.";
        }
        require_once __DIR__ . '/../view/overview_projections.php';
    }
}
