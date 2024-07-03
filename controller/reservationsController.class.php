<?php

require_once __DIR__ . '/../services/movieService.class.php';
require_once __DIR__ . '/../services/projectionService.class.php';
require_once __DIR__ . '/../services/hallService.class.php';
require_once __DIR__ . '/../services/reservationService.class.php';

class ReservationsController
{
    public $message = "";
    /* za MY RESERVATIONS -> U reservationsController
    function index()
    {
    }
    */
    function newReservation1() //rezervacije za $role = 1
    {
        if (isset($_GET['id_projection'])) {
            $idProjection = $_GET['id_projection'];
            $ps = new ProjectionService();
            $projection = $ps->getProjectionById($idProjection);
            if (!$projection) {
                $this->message = "There is no projection with id = " . $idProjection;
            } else {
                //echo $projection->id_projection . ' ' . $projection->date . ' ' . $projection->time . ' ' . $projection->id_hall;
                $ms = new MovieService();
                $movie = $ms->getMovieById($projection->id_movie);
                $title = $movie->name;
                $rs = new ReservationService();
                $reservations = $rs->getReservationsByProjectionId($idProjection);
                $hs = new HallService();
                $hall = $hs->getHallByHallId($projection->id_hall);

                //$reservationsInHall = array("reservations" => $reservations, "hall" => $hall); mozda mi i netreba...
            }
        } else {
            $this->message = "Needed id in URL for projection.";
        }
        require_once __DIR__ . '/../view/newReservation_1.php';
    }
}