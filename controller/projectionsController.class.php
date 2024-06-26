<?php

require_once __DIR__ . '/../services/movieService.class.php';
// require_once __DIR__ . '/../services/projectionService.class.php'; jednom kad se napravi projectionService.class.php i projection.class.php

class ProjectionsController
{
    public $message = "";
    /* za MY PROJECTIONS
    function index()
    {
    }
    */
    function overview()
    {
        if (isset($_GET['id_movie'])) {
            $idMovie = $_GET['id_movie'];
            $ms = new MovieService();
            $movie = $ms->getMovieById($idMovie);
            if (!$movie) {
                $this->message = "There is no movie with id = " . $idMovie;
            } else {
                echo $movie->id . ' ' . $movie->name . ' ' . $movie->url;
                /* TO DO 
                $ps = new ProjectionService();
                $projections = $ps->getProjectionsByMovieId($idMovie);
                if (!$projections) {
                    $this->message = "Movie " . $movie->name . "has no projections.";
                }
                */
            }
        } else {
            $this->message = "Needed id in URL for movie.";
        }
        // require_once __DIR__ . '/../view/overview_projections.php'; kad se napravi overview_projections.php s tablicom svih projekcija ($projections) za taj film
    }
}
