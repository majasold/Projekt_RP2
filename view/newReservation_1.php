<?php require_once __DIR__ . '/header.php'; ?>

    <div>
        <?php echo $projection->id_projection . ' ' . $projection->date . ' ' . $projection->time . ' ' . $projection->id_hall; 
            echo "<br>";
            echo "dvorana broj " . $hall->id_hall . " ima redova " . $hall->nr_rows . " i stupaca " . $hall->nr_cols;
            echo "<br>";
            echo "rezervirana sjedala:";
            echo "<br>";
            foreach ($reservations as $reservation){
                echo "<br>";
                echo "rezervirano je sjedalo u redu " . $reservation->row . " i stupcu " . $reservation->col;
            }
        ?>
    </div>

<?php require_once __DIR__ . '/footer.php'; ?>