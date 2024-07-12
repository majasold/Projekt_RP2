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

    function newMovie()
    {
         //sluzi za prikazivanje pocetne forme
         $title = 'NEW MOVIE';

         require_once __DIR__ . '/../view/newmovie.php';

    }

   function addNewMovie()
    {
       if(isset($_POST['movie-title']) && $_POST['trailer-url'] && $_POST['description'] && $_FILES['movie-poster']){
         $trailer_url = $_POST['trailer-url'];

         if (strpos($trailer_url, 'embed/') !== false) {
             // URL već sadrži embed, ne trebamo ništa mijenjati
             $embedded_url = $trailer_url;
         } elseif (strpos($trailer_url, 'watch?v=') !== false) {
             // URL sadrži watch?v=, zamijenimo ga s embed/
             $embedded_url = str_replace('watch?v=', 'embed/', $trailer_url);
         } else {
             // URL ne sadrži niti embed/ niti watch?v=, pa je neispravan
             $this->message = "Invalid trailer URL format.";
             require_once __DIR__ . '/../view/newmovie.php';
             return; // Prekidamo daljnje izvršavanje
         }

         $poster_name = $_FILES['movie-poster']['name']; // Izvorno ime datoteke
         $file_info = new SplFileInfo($poster_name);
         $extension = $file_info->getExtension();

         if (strtolower($extension) !== 'jpg') {
             $this->message = "Invalid file format. Only .jpg files are allowed.";
         } else {
             $movie_title = $_POST['movie-title'];
             $description = $_POST['description'];
             $poster_file = $_FILES['movie-poster']['tmp_name']; // Privremena putanja datoteke

             $ms = new MovieService();
             $movie = $ms->addMovie($movie_title, $embedded_url, $description, $poster_file);

             $this->message = "Movie added successfully";

         }
       } else {
          $this->message = "There are no movie to add.";
       }

       require_once __DIR__ . '/../view/newmovie.php';
    }

}
