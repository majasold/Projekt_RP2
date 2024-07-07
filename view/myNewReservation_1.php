<?php require_once __DIR__ . '/header.php'; ?>

<h1>Your new reservation</h1>
<?php
foreach ($myReservation as $reservation){
    echo "<br>";
    echo "rezervirano je sjedalo u redu " . $reservation['row'] . " i stupcu " . $reservation['col'];
}
?>


<?php require_once __DIR__ . '/footer.php'; ?>