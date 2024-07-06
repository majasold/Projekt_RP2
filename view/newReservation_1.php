<?php require_once __DIR__ . '/header.php'; ?>

<br>

    <div class = "newReservation1-container">
        <div class = "newReservation1" id = "leftbox">
            <div class = "newReservation1_header">
                <h1><?php echo  $movie->name?></h1>
                <h2><?php echo  "Date: " . $projection->date?></h2>
                <h2><?php echo  "Time: " . $projection->time?></h2>
            </div>
        </div>

        <div class = "newReservation1" id = "middlebox">
            <div class="hall-container">
                <ul class = "showcase">
                    <li>
                        <div class = "seat"></div>
                        <small> free </small>
                    </li>
                    <li>
                        <div class = "seat selected"></div>
                        <small> selected </small>
                    </li>
                    <li>
                        <div class = "seat taken"></div>
                        <small> taken </small>
                    </li>
                </ul>
                <div class="hall-cont">
                    <div class="screen"></div>
                    <div class="seating-container" id="seating"></div>
                </div>
            </div>
        </div>

        <div class = "newReservation1" id = "rightbox">
            <div class = "checkout">
                <h1>CHECKOUT</h1>
                <div class = "checkout_description"></div>
                <div class="buttons">
                    <button class = "confirm_reservation">Confirm the reservation!</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            drawHall();
        });

        function drawHall() {
            const reservations = JSON.parse(<?php echo json_encode($reservations_json); ?>);

            const projection = JSON.parse(<?php echo json_encode($projection_json); ?>);
            const hall = JSON.parse('<?php echo $hall_json; ?>');


            $('#seating').html('');
            
            for (let i = 1; i <= hall.nr_rows; i++) {
                let $newRow = $('<div></div>').addClass('row');
                for (let j = 1; j <= hall.nr_cols; j++) {
                    let $newSeat = $('<div></div>').addClass('seat');
                    //$newSeat.html('sjedalo');
                    reservations.forEach(element => {
                        if (element.row == i && element.col == j) {
                            $newSeat.addClass('seat taken');
                            //$newSeat.html('zauzeto');
                        }
                    });
                    console.log("new seat created");
                    $newSeat.data('row', i).data('col', j);
                    if (i === 1) {
                        $newSeat.data('ticketPrice', 0.8 * projection.regular_price);
                        console.log($newSeat.data('ticketPrice'));
                    } else if (i === hall.nr_rows) {
                        $newSeat.data('ticketPrice', 1.2 * projection.regular_price);
                        console.log($newSeat.data('ticketPrice'));
                    } else {
                        $newSeat.data('ticketPrice', projection.regular_price);
                        console.log($newSeat.data('ticketPrice'));
                    }
                    $newRow.append($newSeat);
                }
                $('#seating').append($newRow);
            }
        }
    </script>


                          

<?php require_once __DIR__ . '/footer.php'; ?>