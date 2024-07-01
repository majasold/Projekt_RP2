<?php
require_once __DIR__ . '/../../../db.class.php';
// require_once __DIR__ . '/../model/reservation.class.php'; kad se napravi


class ReservationService
{
    function getNrOfReservationsByProjectionId($idProjection)
    {
        $nrOfTakenSpaces = 0;
        $db = DB::getConnection();
        $st = $db->prepare('SELECT COUNT(*) FROM rezervacija WHERE id_projekcija = :id_projekcija');
        $st->execute(['id_projekcija' => $idProjection]);

        $nrOfTakenSpaces = $st->fetchColumn();

        return $nrOfTakenSpaces;
    }
}