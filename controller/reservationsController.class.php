<?php

require_once __DIR__ . '/../services/movieService.class.php';
require_once __DIR__ . '/../services/projectionService.class.php';
require_once __DIR__ . '/../services/hallService.class.php';
require_once __DIR__ . '/../services/reservationService.class.php';
require_once __DIR__ . '/../services/userService.class.php';

class ReservationsController
{
    public $message = "";


    function index() // MY RESERVATION za $role = 1
    {
        $myReservations = [];
        if(isset($_SESSION['user']))
        {
          $idUser = $_SESSION['user']->id;
          $rs = new ReservationService();
          $reservations = $rs->getReservationsByUser($idUser);

          if(!$reservations){
            $this->message = "There is no reservations.";
          } else {
              foreach ($reservations as $reservation) {
                $ps = new ProjectionService();
                $projection = $ps->getProjectionById($reservation->id_projection);
                $ms = new MovieService();
                $movie = $ms->getMovieById($projection->id_movie);

                $res = array("reservation" => $reservation, "projection" => $projection, "movie" => $movie);
                $myReservations[] = $res;
              }
              usort($myReservations, function ($a, $b) {
                  return strtotime($b["projection"]->date) - strtotime($a["projection"]->date);
              });
          }
        } else {
          $this->message = "User not logged in.";
        }
          require_once __DIR__ . '/../view/myreservations.php';
    }


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

                $hs = new HallService();
                $hall = $hs->getHallByHallId($projection->id_hall);

                $reservations_json = json_encode($reservations);
                $projection_json = json_encode($projection);
                $hall_json = json_encode($hall);
            }
        } else {
            $this->message = "Needed id in URL for projection.";
        }
        
        require_once __DIR__ . '/../view/newReservation_1.php';
    }


    function saveNewReservation1()
    {
        if (isset($_GET['my_reservation'])) {
            // Decode URI component (JSON string) into PHP object or array
            $jsonData = urldecode($_GET['my_reservation']);
            $myReservation = json_decode($jsonData, true); // true parameter to get associative array

            //var_dump($myReservation);
        }

        require_once __DIR__ . '/../view/myNewReservation_1.php';

    }

}
