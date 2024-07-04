<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/reservation.class.php';


class ReservationService
{
    function getReservations()
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM rezervacija');
        $st->execute();

        $reservations = [];

        while ($row = $st->fetch()) {
            $reservation = new Reservation($row['id_rezervacija'], $row['id_korisnik'], $row['id_projekcija'], $row['red'], $row['stupac'], $row['cijena'], $row['created']);
            $reservations[] = $reservation;
        }
        if (sizeof($reservations) === 0)
            return false;

        return $reservations;
    }

    function getReservationsByUser($idUser)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM rezervacija WHERE id_korisnik = :id_korisnik');
        $st->execute(['id_korisnik' => $idUser]);

        $reservations = [];

        while ($row = $st->fetch()) {
            $reservation = new Reservation($row['id_rezervacija'], $row['id_korisnik'], $row['id_projekcija'], $row['red'], $row['stupac'], $row['cijena'], $row['created']);
            $reservations[] = $reservation;
        }
        if (sizeof($reservations) === 0)
            return false;

        return $reservations;
    }

    function getNrOfReservationsByProjectionId($idProjection)
    {
        $nrOfTakenSeats = 0;
        $db = DB::getConnection();
        $st = $db->prepare('SELECT COUNT(*) FROM rezervacija WHERE id_projekcija = :id_projekcija');
        $st->execute(['id_projekcija' => $idProjection]);

        $nrOfTakenSeats = $st->fetchColumn();

        return $nrOfTakenSeats;
    }

    function getReservationsByProjectionId($idProjection)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM rezervacija WHERE id_projekcija = :id_projekcija');
        $st->execute(['id_projekcija' => $idProjection]);

        $reservations = [];

        while ($row = $st->fetch()) {
            $reservation = new Reservation($row['id_rezervacija'], $row['id_korisnik'], $row['id_projekcija'], $row['red'], $row['stupac'], $row['cijena'], $row['created']);
            $reservations[] = $reservation;
        }
        if (sizeof($reservations) === 0)
            return false;

        return $reservations;
    }


}
