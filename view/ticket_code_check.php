<?php require_once __DIR__ . '/header.php'; ?>

<div class="newReservation1" id="midbox">
    <div class="newReservation1_description">
        <div class="projections-container">
            <table class="reservations">
                <tbody>
                    <tr class="reservations" >
                        <td class="reservations"><?php echo "Ticket owner:";  ?></td>
                        <td class="reservations"><?php echo $user->name . ' ' . $user->surname; ?></td>  
                    </tr>
                    <tr class="reservations" >
                        <td class="reservations"><?php echo "Movie:";  ?></td>
                        <td class="reservations"><?php echo $movie->name; ?></td>  
                    </tr>
                    <tr class="reservations" >
                        <td class="reservations"><?php echo "Date:";  ?></td>
                        <td class="reservations"><?php echo  $projection->date; ?></td>  
                    </tr>
                    <tr class="reservations" >
                        <td class="reservations"><?php echo "Time:";  ?></td>
                        <td class="reservations"><?php echo $projection->time; ?></td>  
                    </tr>
                    <tr class="reservations" >
                        <td class="reservations"><?php echo "Seat in row: "  . $reservation->row; ?></td>
                        <td class="reservations"><?php echo "and column: " . $reservation->col; ?></td>  
                    </tr>
                    <tr class="reservations" >
                        <td class="reservations"><?php echo "Price:";  ?></td>
                        <td class="reservations"><?php echo $reservation->price; ?></td>  
                    </tr>       
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>