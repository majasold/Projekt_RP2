<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/movie.class.php';


class MovieService
{
    function getMovies()
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM film');
        $st->execute();

        $movies = [];

        while ($row = $st->fetch()) {
            $movie = new Movie($row['id_film'], $row['ime_filma'], $row['url_trailer'], $row['opis']);
            $movies[] = $movie;
        }
        if (sizeof($movies) === 0)
            return false;

        return $movies;
    }

    function getMovieById($idMovie)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM film WHERE id_film=:id_film');
        $st->execute(['id_film' => $idMovie]);

        $row = $st->fetch();
        if ($row !== false) {
            $movie = new Movie($row['id_film'], $row['ime_filma'], $row['url_trailer'], $row['opis']);
            return $movie;
        }
        return false;
    }
}
