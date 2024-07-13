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

    function newProjection()
    {
        $title = 'New Projection';
        $ms = new MovieService();
        $movies = $ms->getMovies();
        require_once __DIR__ . '/../view/newprojection.php';
    }

    function addNewProjection()
    {
        $ps = new ProjectionService();
        if (
            !empty($_POST['id_movie']) and
            !empty($_POST['date']) and !empty($_POST['time'])
            and !empty($_POST['id_hall']) and !empty($_POST['regular_price'])
        ) {
            $id_movie = intval($_POST['id_movie']);
            $date = $_POST['date'];
            $time = $_POST['time'];
            $id_hall = intval($_POST['id_hall']);
            $regular_price = intval($_POST['regular_price']);
            $allFieldsOK = true;

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                $allFieldsOK = false;
                $this->message = "Invalid date format.";
                require_once __DIR__ . '/../view/newprojection.php';
            } elseif (!preg_match('/^\d{2}:\d{2}$/', $time)) {
                $allFieldsOK = false;
                $this->message = "Invalid time format";
                require_once __DIR__ . '/../view/newprojection.php';
            } elseif (!preg_match('/^[A-Za-z0-9 ]{1,50}$/', $id_hall)) {
                $allFieldsOK = false;
                $this->message = "Cinema Hall name should be between 1 and 50 alphanumeric characters.";
                require_once __DIR__ . '/../view/newprojection.php';
            } elseif (!is_numeric($regular_price) || $regular_price <= 0) {
                $allFieldsOK = false;
                $this->message = "Ticket Price must be a positive number.";
                require_once __DIR__ . '/../view/newprojection.php';
            } 

            if ($allFieldsOK) {
                list($hour, $minute) = explode(':', $time);
                $hour = intval($hour);
                $minute = intval($minute);

                $formattedTime = sprintf("%02d:%02d:00", $hour, $minute);

                if (!$ps->checkCollision($id_hall, $date, $time)) {
                    $this->message = "There is a collision with an existing projection.";
                    require_once __DIR__ . '/../view/newprojection.php';
                } else {
                    if (!$us->insertNewProjection($id_projekcija, $id_hall, $id_movie, $date, $time, $regular_price)) {
                        $this->message = "Error in adding new projection. Please try again.";
                        require_once __DIR__ . '/../view/newprojection.php';
                    } else {
                        header('Location: index.php?rt=projections');//?
                    }
                }
            }
        } else {
            $this->message = "All spaces are mandatory.";
            require_once __DIR__ . '/../view/newprojection.php';
        }
    }

    function projectionDelete() //brisanje projekcija za $role = 3
    {
        $title = 'Projection';

        $ps = new ProjectionService();
        $projections = $ps->getProjections();
        if(isset($_POST['projections']) && is_array($_POST['projections'])){
            $id_projections = $_POST['projections'];
            if(!$projections){
            $this->message = "There are no projections.";
        } else {
            if(!$id_projections){
            $this->message = "There are no reservations to delete.";
            } else {
                foreach ($id_projections as $id_proj) {
                     $ps->deleteProjectionById($id_proj);
                }
            }
        }
        } else {
            $this->message = "There are no projections to delete.";
        }
        $this->projections();
        //require_once __DIR__ . '/../view/projectionsDelete.php';
    }   
    
    function projections() //opcija PROJECTION za $role = 3
    {
        $title = 'Projections';

        $allProjections = [];
        $ps = new ProjectionService();
        $projections = $ps->getProjections();

        if(!$projections){
          $this->message = "There are no projections.";
        } else {
	        foreach ($projections as $projection) {
                $ms = new MovieService();
                $movie = $ms->getMovieById($projection->id_movie);
               
                $proj = array("projection" => $projection, /*"reservation" => $reservation, */"movie" => $movie/*, "user" => $user*/);
                $allProjections[] = $proj;
            }
		    usort($allProjections, function ($a, $b) {
                $dateTimeA = strtotime($a["projection"]->date . ' ' . $a["projection"]->time);
                $dateTimeB = strtotime($b["projection"]->date . ' ' . $b["projection"]->time);
                return $dateTimeB - $dateTimeA;
            });
        }

        require_once __DIR__ . '/../view/projectionsDelete.php';
    }
}