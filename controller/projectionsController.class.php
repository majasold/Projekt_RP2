<?php

require_once __DIR__ . '/../services/movieService.class.php';
require_once __DIR__ . '/../services/projectionService.class.php';
require_once __DIR__ . '/../services/hallService.class.php';
require_once __DIR__ . '/../services/reservationService.class.php';

class ProjectionsController
{
    public $message = "";

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
                //echo $movie->id . ' ' . $movie->name . ' ' . $movie->url. ' ' .$movie->description;
                $title = $movie->name;
                $ps = new ProjectionService();
                $projections = $ps->getProjectionsByMovieId($idMovie);
                if (!$projections) {
                    $this->message = "Movie " . $movie->name . "has no projections.";
                } else {
                    foreach ($projections as $projection) {
                        $hs = new HallService();
                        $hall = $hs->getHallByHallId($projection->id_hall);
                        $hallSize = $hall->nr_rows * $hall->nr_cols;
                        $rs = new ReservationService();
                        $takenSeats = $rs->getNrOfReservationsByProjectionId($projection->id_projection);
                        $freeSeats = $hallSize - $takenSeats;

                        $proj = array("projection" => $projection, "freeSeats" => $freeSeats);
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