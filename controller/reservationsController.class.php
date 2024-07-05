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

    function deleteReservation() //brisanje razervacije za $role = 2
    {
      $rs = new ReservationService();
      $reservations = $rs->getReservations();
      if(isset($_POST['reservations']) && is_array($_POST['reservations'])){
          $id_reservations = $_POST['reservations'];
          if(!$reservations){
            $this->message = "There are no reservations.";
          } else {
              if(!$id_reservations){
                $this->message = "There are no reservations to delete.";
              } else {
                  foreach ($id_reservations as $id_res) {
                        $rs->deleteReservationById($id_res);
                    }
              }
          }
      } else {
         $this->message = "There are no reservations to delete.";
      }
      $this->reservations();
    }

    function reservations() //opcija RESERVATION za $role = 2
    {
        $allReservations = [];
        $rs = new ReservationService();
        $reservations = $rs->getReservations();

        if(!$reservations){
          $this->message = "There are no reservations.";
        } else {
	     foreach ($reservations as $reservation) {
              $ps = new ProjectionService();
              $projection = $ps->getProjectionById($reservation->id_projection);
              $ms = new MovieService();
              $movie = $ms->getMovieById($projection->id_movie);
              $us = new UserService();
              $user = $us->getUserById($reservation->id_user);

              $res = array("reservation" => $reservation, "projection" => $projection, "movie" => $movie, "user" => $user);
              $allReservations[] = $res;
            }
		        usort($allReservations, function ($a, $b) {
                return strtotime($b["projection"]->date) - strtotime($a["projection"]->date);
            });
        }

        require_once __DIR__ . '/../view/allreservations.php';
    }
}
