<?php require_once __DIR__ . '/header.php'; ?>

<div class="newReservation1-container">
    <div class="newReservation1" id="leftbox">
        <div class="newReservation1_header">
            <h1><?php echo  $movie->name ?></h1>
            <h2><?php echo  "Date: " . $projection->date ?></h2>
            <h2><?php echo  "Time: " . $projection->time ?></h2>
        </div>
    </div>

    <div class="newReservation1" id="rightbox2">

    
    <h1>Your deleted reservation</h1>

<?php
foreach ($successfulDelReservations as $reservation) {
    echo "<br>";
    echo "Reserved seat in row: " . $reservation['row'] . " and column: " .  $reservation['col'] . '<br>';
    
}

?>


<h1>Your new reservation</h1>
<?php
foreach ($successfulNewReservations as $reservation) {
    echo "<br>";
    echo "Reserved seat in row: " . $reservation->row . " and column: " . $reservation->col . '<br>';
    echo "Ticket code: (to treba stavit kao link)" . $this->generateURL($reservation->id_reservation, $reservation->created) . '<br>';
}
foreach ($notSuccessfulNewReservations as $reservation) {
    echo "ERROR: Not reserved seat in row: " . $reservation->row . " and column: " . $reservation->col . '<br>';
}
?>
    </div>
</div>



<?php require_once __DIR__ . '/footer.php'; ?>