<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/hall.class.php';


class HallService
{

    function getHallByHallId($idHall)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM dvorana WHERE id_dvorana=:id_dvorana');
        $st->execute(['id_dvorana' => $idHall]);

        $row = $st->fetch();
        if ($row !== false) {
            $hall = new Hall($row['id_dvorana'], $row['br_redova'] , $row['br_stupaca']);
            return $hall;
        }
        return false;
    }

}
