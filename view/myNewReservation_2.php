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
        <div class="newReservation1_description">
            <?php if (sizeof($successfulNewReservations) > 0): ?>
                <br>
                <h1>Your new reservation</h1>
                <div class="projections-container">
                    <table class="reservations">
                        <tbody>
                            <?php foreach ($successfulNewReservations as $reservation) : ?>
                                <tr class="reservations" >
                                    <td class="reservations"><?php echo "Seat in";  ?></td>
                                    <td class="reservations"><?php echo "row: " . $reservation->row; ?></td>
                                    <td class="reservations"><?php echo "and"; ?></td>
                                    <td class="reservations"><?php echo "col: " . $reservation->col; ?></td>
                                    <td class="reservations">
                                        <div class="buttons">
                                            <button class="qr" data-href=<?php echo $this->generateURL($reservation->id_reservation, $reservation->created); ?>>
                                                ticket QR code
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <br>
            <?php if (sizeof($successfulDelReservations) > 0): ?>
                <br>
                <h1>Your deleted reservation</h1>
                <div class="projections-container">
                    <table class="reservations">
                        <tbody>
                            <?php foreach ($successfulDelReservations as $reservation) : ?>
                                <tr class="reservations" >
                                    <td class="reservations"><?php echo "Seat in";  ?></td>
                                    <td class="reservations"><?php echo "row: " . $reservation['row']; ?></td>
                                    <td class="reservations"><?php echo "and"; ?></td>
                                    <td class="reservations"><?php echo "col: " . $reservation['col']; ?></td>
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.qr').on('click', function() {
            var href = $(this).data('href');
            if (href) {
                window.location.href = href;
            }
        });
    });
</script>



<?php require_once __DIR__ . '/footer.php'; ?>