<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/projection.class.php';


class ProjectionService
{
    function getProjections()
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekcija ORDER BY datum DESC, vrijeme DESC');
        $st->execute();

        $projections = [];

        while ($row = $st->fetch()) {
            $projection = new Projection($row['id_projekcija'], $row['id_dvorana'], $row['id_filma'], $row['datum'], $row['vrijeme'], $row['regular_cijena']);
            $projections[] = $projection;
        }
        if (sizeof($projections) === 0)
            return false;

        return $projections;
    }


    function getProjectionById($idProjection)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekcija WHERE id_projekcija=:id_projekcija');
        $st->execute(['id_projekcija' => $idProjection]);

        $row = $st->fetch();
        if ($row !== false) {
            $projection = new Projection($row['id_projekcija'], $row['id_dvorana'], $row['id_filma'], $row['datum'], $row['vrijeme'], $row['regular_cijena']);
            return $projection;
        }
        return false;
    }

    function getProjectionsByMovieId($idMovie)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekcija WHERE id_filma=:id_filma');
        $st->execute(['id_filma' => $idMovie]);

        $projections = [];

        while ($row = $st->fetch()) {
            $projection = new Projection($row['id_projekcija'], $row['id_dvorana'], $row['id_filma'], $row['datum'], $row['vrijeme'], $row['regular_cijena']);
            $projections[] = $projection;
        }
        if (sizeof($projections) === 0)
            return false;

        return $projections;
    }

    function checkCollision($id_hall, $date, $time)
    {
        $db = DB::getConnection();
        $st = $db->prepare("SELECT * FROM projekcija WHERE vrijeme < ADDTIME(:time, '3:00:00') AND :time < ADDTIME(vrijeme, '3:00:00') AND id_dvorana = :id_hall AND datum = :date");
        $st->execute([':time' => $time, ':id_hall' => $id_hall, ':date' => $date]);

        return $st->rowCount() === 0;
    }

    function insertNewProjection($id_hall, $id_movie, $date, $time, $regular_price)
    {
        $db = DB::getConnection();
        $st = $db->prepare('INSERT INTO projekcija (id_dvorana, id_filma, datum, vrijeme, regular_cijena) VALUES (:id_hall, :id_movie, :date, :time, :regular_price)');
        $success = $st->execute([':id_hall' => $id_hall, ':id_movie' => $id_movie, ':date' => $date, ':time' => $time, ':regular_price' => $regular_price]);

        if ($success) {
            return true;
        } else {
            return false;
        }
    }

    function deleteProjectionById($idProjection)
    {
        $db = DB::getConnection();
        $st = $db->prepare('DELETE FROM projekcija WHERE id_projekcija = :id_projekcija');
        $st->execute(['id_projekcija' => $idProjection]);

        if ($st->rowCount() > 0)
            return true;
        return false;
    }
}
