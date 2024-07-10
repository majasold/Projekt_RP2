<?php require_once __DIR__ . '/header.php';

echo 'Ticket owner: ' . $user->name . ' ' . $user->surname . '<br>';
echo 'Movie: ' . $movie->name . '<br>';
echo 'Date: ' . $projection->date . '<br>';
echo 'Time: ' . $projection->time . '<br>';
echo 'Hall: ' . $projection->id_hall . '<br>';
echo 'Seat in row: ' . $reservation->row . ' ' . ' and column: ' . $reservation->col . '<br>';
echo 'Price: ' . $reservation->price;


require_once __DIR__ . '/footer.php';
