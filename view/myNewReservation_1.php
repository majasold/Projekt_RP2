<?php require_once __DIR__ . '/header.php'; ?>

<h1>Your new reservation</h1>
<?php
foreach ($successfulReservations as $reservation) {
    echo "<br>";
    echo "Reserved seat in row: " . $reservation->row . " and column: " . $reservation->col . '<br>';
    echo "Ticket code: (to treba stavit kao link)" . $this->generateURL($reservation->id_reservation, $reservation->created) . '<br>';
}
foreach ($notSuccessfulReservations as $reservation) {
    echo "ERROR: Not reserved seat in row: " . $reservation->row . " and column: " . $reservation->col . '<br>';
}
?>


<?php require_once __DIR__ . '/footer.php'; ?>