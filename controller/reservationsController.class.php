<?php

require_once __DIR__ . '/../services/movieService.class.php';
require_once __DIR__ . '/../services/projectionService.class.php';
require_once __DIR__ . '/../services/hallService.class.php';
require_once __DIR__ . '/../services/reservationService.class.php';

class ReservationsController
{
    public $message = "";

    function newReservation1() //rezervacije za $role = 1
    {
        if (isset($_GET['id_projection'])) {
            $idProjection = $_GET['id_projection'];
            $ps = new ProjectionService();
            $projection = $ps->getProjectionById($idProjection);
            if (!$projection) {
                $this->message = "There is no projection with id = " . $idProjection;
            } else {
                $ms = new MovieService();
                $movie = $ms->getMovieById($projection->id_movie);
                $title = $movie->name;
                $rs = new ReservationService();
                $reservations = $rs->getReservationsByProjectionId($idProjection);
                //var_dump($reservations);
                $hs = new HallService();
                $hall = $hs->getHallByHallId($projection->id_hall);

                /*for ($i = 0; $i < count($reservations); $i++) {
                    echo "Reserved seat in row " . $reservations[$i]->row . " and column " . $reservations[$i]->col;
                }
                    
                foreach ($reservations as $reservation) {
                    echo "<br>";
                    echo "Reserved seat in row " . $reservation->row . " and column " . $reservation->col;
                }*/

                $reservations_json = json_encode($reservations);
                //echo $reservations_json;

                /*// Output reservations as JSON
                $reservations_json = json_encode($reservations);
                if ($reservations_json === false) {
                    echo "JSON encoding error: " . json_last_error_msg();
                } else {
                    echo $reservations_json;
                }*/


                $projection_json = json_encode($projection);

                $hall_json = json_encode($hall);
                //echo $hall_json;

                
            }
        } else {
            $this->message = "Needed id in URL for projection.";
        }
        
        require_once __DIR__ . '/../view/newReservation_1.php';
    }
}
