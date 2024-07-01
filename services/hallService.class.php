<?php
require_once __DIR__ . '/../../../db.class.php';
// require_once __DIR__ . '/../model/hall.class.php'; kad se napravi


class HallService
{
    function getHallSizeByHallId($idHall)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM dvorana WHERE id_dvorana=:id_dvorana');
        $st->execute(['id_dvorana' => $idHall]);

        $row = $st->fetch();
        if ($row !== false)
            return $row['br_redova'] * $row['br_stupaca'];   

        return false;
    }
}
