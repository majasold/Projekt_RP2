<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/user.class.php';

class UserService
{
    function verifyUser($username, $password)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM korisnik WHERE username = :username');
        $st->execute(['username' => $username]);

        $row = $st->fetch();

        if ($row !== false) {
            $user = new User($row['id_korisnik'], $row['username'], $row['name'], $row['surname'], $row['password_hash'], $row['role']);
            if (password_verify($password, $user->password_hash))
                return $user;
        }
        return false;
    }
}
