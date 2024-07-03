<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/projection.class.php';


class ProjectionService
{
    function getProjections()
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekcija');
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
}
