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

    function getMovieByProjectionId($idProjection)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT f.* FROM film f JOIN projekcija p ON f.id_film = p.id_filma WHERE p.id_projekcija = :id_projekcija');
        $st->execute(['id_projekcija' => $idProjection]);

        $row = $st->fetch();
        if ($row !== false) {
            $movie = new Movie($row['id_film'], $row['ime_filma'], $row['url_trailer'], $row['opis']);
            return $movie;
        }
        return false;
    }

    function addMovie($movie_title, $embedded_url, $description, $poster_file)
    {
        $db = DB::getConnection();
        $st = $db->prepare('INSERT INTO film(ime_filma, url_trailer, opis) VALUES (:ime_filma, :url_trailer, :opis)');
        $st->execute(array('ime_filma' => $movie_title, 'url_trailer' => $embedded_url, 'opis' => $description));
        $id_filma = $db->lastInsertId();

        move_uploaded_file($poster_file, __DIR__ . '/../images/' . 'movie_' . $id_filma . '.jpg');
    }
}
