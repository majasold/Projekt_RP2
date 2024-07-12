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

    function deleteReservationById($idReservation)
    {
        $db = DB::getConnection();
        $st = $db->prepare('DELETE FROM rezervacija WHERE id_rezervacija = :id_rezervacija');
        $st->execute(['id_rezervacija' => $idReservation]);

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

    function getReservationById($id)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM rezervacija WHERE id_rezervacija = :id_rezervacija');
        $st->execute(['id_rezervacija' => $id]);
        $row = $st->fetch();
        if ($row !== false) {
            $reservation = new Reservation($row['id_rezervacija'], $row['id_korisnik'], $row['id_projekcija'], $row['red'], $row['stupac'], $row['cijena'], $row['created']);
            return $reservation;
        }
        return false;
    }

    function insertNewReservation($idUser, $idProjection, $row, $column, $price)
    {
        $db = DB::getConnection();
        $st = $db->prepare('INSERT INTO rezervacija (id_korisnik, id_projekcija, red, stupac, cijena) VALUES (?, ?, ?, ?, ?)');
        $data = array($idUser, $idProjection, $row, $column, $price);
        $st->execute($data);

        if ($st->rowCount() > 0) {
            $id = $db->lastInsertId();
            $reservation = $this->getReservationById($id);
            return $reservation;
        }
        return false;
    }

    function deleteReservationByProjectionRowCol($idProjection, $row, $col)
    {
        $db = DB::getConnection();
        $st = $db->prepare('DELETE FROM rezervacija WHERE id_projekcija = :id_projekcija AND red = :red AND stupac = :stupac');
        $st->execute([
            'id_projekcija' => $idProjection,
            'red' => $row,
            'stupac' => $col
        ]);

    }

    function getReservationByProjectionRowCol($idProjection, $row, $col)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM rezervacija WHERE id_projekcija = :id_projekcija AND red = :red AND stupac = :stupac');
        $st->execute([
            'id_projekcija' => $idProjection,
            'red' => $row,
            'stupac' => $col
        ]);

        $row = $st->fetch();
        if ($row !== false) {
            $reservation = new Reservation($row['id_rezervacija'], $row['id_korisnik'], $row['id_projekcija'], $row['red'], $row['stupac'], $row['cijena'], $row['created']);
            return $reservation;
        }
        return false;

    }
}
