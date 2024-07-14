<?php
require_once __DIR__ . '/../../../db.class.php';
require_once __DIR__ . '/../model/user.class.php';

class UserService
{
    function verifyUser($email, $password)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM korisnik WHERE email = :email');
        $st->execute(['email' => $email]);

        $row = $st->fetch();

        if ($row !== false) {
            $user = new User($row['id_korisnik'], $row['email'], $row['name'], $row['surname'], $row['password_hash'], $row['role']);
            if (password_verify($password, $user->password_hash))
                return $user;
        }
        return false;
    }
    function getExistingUser($email)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM korisnik WHERE email = :email');
        $st->execute(['email' => $email]);

        $row = $st->fetch();
        if ($row !== false) {
            $user = new User($row['id_korisnik'], $row['email'], $row['name'], $row['surname'], $row['password_hash'], $row['role']);
            return $user;
        }
        return false;
    }

    function getUserById($id)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM korisnik WHERE id_korisnik = :id_korisnik');
        $st->execute(['id_korisnik' => $id]);
        $row = $st->fetch();
        if ($row !== false) {
            $user = new User($row['id_korisnik'], $row['email'], $row['name'], $row['surname'], $row['password_hash'], $row['role']);
            return $user;
        }
        return false;
    }

    function insertNewUser($email, $firstName, $lastName, $password)
    {
        $db = DB::getConnection();
        $st = $db->prepare('INSERT INTO korisnik(email, name, surname, password_hash, role) VALUES (:email, :name, :surname, :password_hash, :role)');
        $st->execute(array('email' => $email, 'name' => $firstName, 'surname' => $lastName, 'password_hash' => password_hash($password, PASSWORD_DEFAULT), 'role' => 1));

        if ($st->rowCount() > 0) {
            $id = $db->lastInsertId();
            $user = $this->getUserById($id);
            return $user;
        }
        return false;
    }

    function getUsers()
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM korisnik');
        $st->execute();

        $users = [];

        while ($row = $st->fetch()) {
            $projection = new User($row['id_korisnik'], $row['name'], $row['surname'], $row['role']);
            $users[] = $user;
        }
        if (sizeof($users) === 0)
            return false;

        return $users;
    }

    function updateUserRole($id_korisnik, $role)
    {
        $db = DB::getConnection();
        $st = $db->prepare('UPDATE korisnik SET role = :role WHERE id_korisnik = :id_korisnik');
        $st->execute(['role' => $role, 'id_korisnik' => $id_korisnik]);
    }
}
