<?php

require_once __DIR__ . '/../../../db.class.php';

$db = DB::getConnection();

$has_tables = false;

try {
    $st = $db->prepare(
        'SHOW TABLES LIKE :tblname'
    );

    $st->execute(array('tblname' => 'korisnik'));
    if ($st->rowCount() > 0)
        $has_tables = true;

    $st->execute(array('tblname' => 'rezervacija'));
    if ($st->rowCount() > 0)
        $has_tables = true;

    $st->execute(array('tblname' => 'projekcija'));
    if ($st->rowCount() > 0)
        $has_tables = true;

    $st->execute(array('tblname' => 'dvorana'));
    if ($st->rowCount() > 0)
        $has_tables = true;

    $st->execute(array('tblname' => 'film'));
    if ($st->rowCount() > 0)
        $has_tables = true;
} catch (PDOException $e) {
    exit("PDO error [show tables]: " . $e->getMessage());
}


if ($has_tables) {
    exit('Tablice korisnik/rezervacija/projekcija/dvorana već postoje. Obrišite ih pa probajte ponovno.');
}

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS korisnik (' .
            'id_korisnik int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'username varchar(50) NOT NULL,' .
            'name varchar(50) NOT NULL,' .
            'surname varchar(50) NOT NULL,' .
            'password_hash varchar(255) NOT NULL,' .
            'role int NOT NULL' . // user = 1, employee = 2, admin = 3
            ')'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create korisnik]: " . $e->getMessage());
}

echo "Napravio tablicu korisnik.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS dvorana (' .
            'id_dvorana int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'br_redova int NOT NULL,' .
            'br_stupaca int NOT NULL' .
            ')'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create dvorana]: " . $e->getMessage());
}

echo "Napravio tablicu dvorana.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS film (' .
            'id_film int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'ime_filma varchar(255) NOT NULL,' .
            'url_trailer varchar(255) NOT NULL' .
            ')'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create film]: " . $e->getMessage());
}

echo "Napravio tablicu film.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS projekcija (' .
            'id_projekcija int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_dvorana int NOT NULL,' .
            'id_filma int NOT NULL,' .
            'datum date NOT NULL,' .
            'vrijeme time NOT NULL,' .
            'regular_cijena int NOT NULL,' .
            'FOREIGN KEY (id_dvorana) REFERENCES dvorana(id_dvorana) ON DELETE CASCADE,' .
            'FOREIGN KEY (id_filma) REFERENCES film(id_film) ON DELETE CASCADE' .
            ')'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create projekcija]: " . $e->getMessage());
}

echo "Napravio tablicu projekcija.<br />";

try {
    $st = $db->prepare(
        'CREATE TABLE IF NOT EXISTS rezervacija(' .
            'id_rezervacija int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_korisnik int NOT NULL,' .
            'id_projekcija int NOT NULL,' .
            'red int NOT NULL,' .
            'stupac int NOT NULL,' .
            'cijena decimal(4, 2) NOT NULL,' .
            'created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,' .
            'FOREIGN KEY (id_projekcija) REFERENCES projekcija(id_projekcija) ON DELETE CASCADE' .
            ')'
    );

    $st->execute();
} catch (PDOException $e) {
    exit("PDO error [create rezervacija]: " . $e->getMessage());
}

echo "Napravio tablicu rezervacija.<br />";


//-------------- popunjavanje tablica-----------------------

try {
    $st = $db->prepare('INSERT INTO korisnik(username, name, surname, password_hash, role) VALUES (:username, :name, :surname, :password_hash, :role)');
    $st->execute(array('username' => 'mirko123', 'name' => 'Mirko', 'surname' => 'Mirić', 'password_hash' => password_hash('mirkovasifra', PASSWORD_DEFAULT), 'role' => 3)); //id_korisnik = 1
    $st->execute(array('username' => 'ana123', 'name' => 'Ana', 'surname' => 'Anić', 'password_hash' => password_hash('aninasifra', PASSWORD_DEFAULT), 'role' => 1)); //id_korisnik = 2 ...
    $st->execute(array('username' => 'pero123', 'name' => 'Pero', 'surname' => 'Perić', 'password_hash' => password_hash('perinasifra', PASSWORD_DEFAULT), 'role' => 2));
    $st->execute(array('username' => 'maja123', 'name' => 'Maja', 'surname' => 'Majić', 'password_hash' => password_hash('majinasifra', PASSWORD_DEFAULT), 'role' => 1));
} catch (PDOException $e) {
    exit("PDO error [insert korisnik]: " . $e->getMessage());
}

echo "Ubacio u tablicu korisnik.<br />";


try {
    $st = $db->prepare('INSERT INTO dvorana(id_dvorana, br_redova, br_stupaca) VALUES (:id_dvorana, :br_redova, :br_stupaca)');

    $st->execute(array('id_dvorana' => 1, 'br_redova' => 6, 'br_stupaca' => 8));
    $st->execute(array('id_dvorana' => 2, 'br_redova' => 7, 'br_stupaca' => 10));
    $st->execute(array('id_dvorana' => 3, 'br_redova' => 7, 'br_stupaca' => 10));
    $st->execute(array('id_dvorana' => 4, 'br_redova' => 6, 'br_stupaca' => 8));
} catch (PDOException $e) {
    exit("PDO error [insert dvorana]: " . $e->getMessage());
}

echo "Ubacio u tablicu dvorana.<br />";

try {
    $st = $db->prepare('INSERT INTO film(ime_filma, url_trailer) VALUES (:ime_filma, :url_trailer)');

    $st->execute(array('ime_filma' => 'Izvrnuto obrnuto 2', 'url_trailer' => 'https://www.youtube.com/embed/TWYtG2XkkAI'));
    $id_filma1 = $db->lastInsertId();
    $st->execute(array('ime_filma' => 'Kung Fu Panda 4', 'url_trailer' => 'https://www.youtube.com/embed/c-FQGzvwTPc'));
    $id_filma2 = $db->lastInsertId();
    $st->execute(array('ime_filma' => 'DINA: drugi dio', 'url_trailer' => 'https://www.youtube.com/embed/Fi2u6naeQOY'));
    $id_filma3 = $db->lastInsertId();
    $st->execute(array('ime_filma' => 'Građanski rat', 'url_trailer' => 'https://www.youtube.com/embed/vvx5ZRjHApE'));
    $id_filma4 = $db->lastInsertId();
    $st->execute(array('ime_filma' => 'Garfield', 'url_trailer' => 'https://www.youtube.com/embed/juW1f73PwSI'));
    $id_filma5 = $db->lastInsertId();
} catch (PDOException $e) {
    exit("PDO error [insert projekcija]: " . $e->getMessage());
}

echo "Ubacio u tablicu film.<br />";

try {
    $st = $db->prepare('INSERT INTO projekcija(id_dvorana, id_filma, datum, vrijeme, regular_cijena) VALUES (:id_dvorana, :id_filma, :datum, :vrijeme, :regular_cijena)');

    $st->execute(array('id_dvorana' => 1, 'id_filma' => $id_filma1, 'datum' => '2024-07-04', 'vrijeme' => '17:00:00', 'regular_cijena' => 10)); //id_projekcija = 1
    $id_projekcija1 = $db->lastInsertId(); // ovako je sigurnije
    $st->execute(array('id_dvorana' => 2, 'id_filma' => $id_filma2, 'datum' => '2024-07-04', 'vrijeme' => '17:00:00', 'regular_cijena' => 10)); // id_projekcija = 2 ...
    $id_projekcija2 = $db->lastInsertId();
    $st->execute(array('id_dvorana' => 3, 'id_filma' => $id_filma3, 'datum' => '2024-07-04', 'vrijeme' => '18:00:00', 'regular_cijena' => 15));
    $id_projekcija3 = $db->lastInsertId();
    $st->execute(array('id_dvorana' => 3, 'id_filma' => $id_filma4, 'datum' => '2024-07-05', 'vrijeme' => '19:00:00', 'regular_cijena' => 15));
    $id_projekcija4 = $db->lastInsertId();
    $st->execute(array('id_dvorana' => 2, 'id_filma' => $id_filma5, 'datum' => '2024-07-06', 'vrijeme' => '16:00:00', 'regular_cijena' => 10));
    $id_projekcija5 = $db->lastInsertId();
    $st->execute(array('id_dvorana' => 1, 'id_filma' => $id_filma3, 'datum' => '2024-07-10', 'vrijeme' => '19:00:00', 'regular_cijena' => 15));
    $id_projekcija6 = $db->lastInsertId();
    $st->execute(array('id_dvorana' => 4, 'id_filma' => $id_filma2, 'datum' => '2024-07-10', 'vrijeme' => '17:00:00', 'regular_cijena' => 10));
    $id_projekcija7 = $db->lastInsertId();
} catch (PDOException $e) {
    exit("PDO error [insert projekcija]: " . $e->getMessage());
}

echo "Ubacio u tablicu projekcija.<br />";

try {
    $st = $db->prepare('INSERT INTO rezervacija(id_korisnik, id_projekcija, red, stupac, cijena) VALUES (:id_korisnik, :id_projekcija, :red, :stupac, :cijena)');

    $st->execute(array('id_korisnik' => 2, 'id_projekcija' => $id_projekcija1, 'red' => 2, 'stupac' => 5, 'cijena' => 10));
    $st->execute(array('id_korisnik' => 1, 'id_projekcija' => $id_projekcija2, 'red' => 3, 'stupac' => 5, 'cijena' => 10));
    $st->execute(array('id_korisnik' => 3, 'id_projekcija' => $id_projekcija3, 'red' => 6, 'stupac' => 5, 'cijena' => 15));
    $st->execute(array('id_korisnik' => 2, 'id_projekcija' => $id_projekcija4, 'red' => 4, 'stupac' => 7, 'cijena' => 15));
    $st->execute(array('id_korisnik' => 4, 'id_projekcija' => $id_projekcija3, 'red' => 5, 'stupac' => 9, 'cijena' => 15));
    $st->execute(array('id_korisnik' => 1, 'id_projekcija' => $id_projekcija6, 'red' => 3, 'stupac' => 3, 'cijena' => 15));
    $st->execute(array('id_korisnik' => 3, 'id_projekcija' => $id_projekcija7, 'red' => 4, 'stupac' => 6, 'cijena' => 10));
    $st->execute(array('id_korisnik' => 4, 'id_projekcija' => $id_projekcija5, 'red' => 3, 'stupac' => 8, 'cijena' => 10));
} catch (PDOException $e) {
    exit("PDO error [insert rezervacija]: " . $e->getMessage());
}

echo "Ubacio u tablicu rezervacija.<br />";
