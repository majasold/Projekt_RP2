<?php require_once __DIR__ . '/header.php'; ?>

<br>

<div class="newReservation1-container">
    <div class="newReservation1" id="leftbox">
        <div class="newReservation1_header">
            <h1><?php echo  $movie->name ?></h1>
            <h2><?php echo  "Date: " . $projection->date ?></h2>
            <h2><?php echo  "Time: " . $projection->time ?></h2>
        </div>
    </div>

    <div class="newReservation1" id="middlebox">
        <div class="hall-container">
            <ul class="showcase">
                <li>
                    <div class="seat"></div>
                    <small> free </small>
                </li>
                <li>
                    <div class="seat taken2"></div>
                    <small> taken </small>
                </li>
                <li>
                    <div class="seat selected"></div>
                    <small> selected </small>
                </li>
                <li>
                    <div class="seat delete"></div>
                    <small> delete </small>
                </li>
            </ul>
            <div class="hall-cont" id="hall">
                <div class="screen"></div>
                <div class="seating-container" id="seating"></div>
            </div>
        </div>
    </div>

    <div class="newReservation1" id="rightbox">
        <div class="checkout">
            <h1>CHECKOUT</h1>
            <h3>Selected seats:</h3>
            <div class="checkout_description"></div>
            <h3 class="total">Total price: 0€</h3>
            <div class="buttons">
                <button class="confirm_reservation">
                    Confirm the reservation!
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const reservations = JSON.parse(<?php echo json_encode($reservations_json); ?>);
    const projection = JSON.parse(<?php echo json_encode($projection_json); ?>);
    const hall = JSON.parse(<?php echo json_encode($hall_json); ?>);

    let newReservation = [];

    $(document).ready(function() {
        drawHall();
        $('#seating').on('click', '.seat', seatClick);
        $('.confirm_reservation').on('click', sendReservation);
    });

    function drawHall() {
        $('#seating').html('');

        for (let i = 1; i <= hall.nr_rows; i++) {
            let $newRow = $('<div></div>').addClass('row');
            for (let j = 1; j <= hall.nr_cols; j++) {
                let $newSeat = $('<div></div>').addClass('seat');
                //$newSeat.html('sjedalo');
                reservations.forEach(element => {
                    if (element.row == i && element.col == j) {
                        $newSeat.addClass('taken2');
                        //$newSeat.html('zauzeto');
                    }
                });
                //console.log("new seat created");
                $newSeat.data('row', i).data('col', j);
                if (i === 1) {
                    $newSeat.data('ticketPrice', 0.8 * projection.regular_price);
                    //console.log($newSeat.data('ticketPrice'));
                } else if (i === hall.nr_rows) {
                    $newSeat.data('ticketPrice', 1.2 * projection.regular_price);
                    //console.log($newSeat.data('ticketPrice'));
                } else {
                    $newSeat.data('ticketPrice', projection.regular_price);
                    //console.log($newSeat.data('ticketPrice'));
                }
                $newRow.append($newSeat);
            }
            $('#seating').append($newRow);
        }
    }

    function seatClick() {
        let $seat = $(this);

        if ($seat.hasClass('selected')) {
            $seat.toggleClass('selected');
            newReservation = newReservation.filter(obj => (obj.row !== $seat.data('row') || obj.col !== $seat.data('col')));
            updateCheckout();
        } else if ($seat.hasClass('delete')) {
            $seat.toggleClass('delete');
            newReservation = newReservation.filter(obj => (obj.row !== $seat.data('row') || obj.col !== $seat.data('col')));
            updateCheckout();
        } else if ($seat.hasClass('taken2')) {
            $seat.addClass('delete');
            let newRSeat = {
                act: "del",
                projectionId: projection.id_projection,
                row: $seat.data('row'),
                col: $seat.data('col'),
                ticketPrice: Number($seat.data('ticketPrice'))
            };
            newReservation.push(newRSeat);
            updateCheckout();
        } else if (!$seat.hasClass('taken2')) {
            $seat.addClass('selected');
            let newRSeat = {
                act: "add",
                projectionId: projection.id_projection,
                row: $seat.data('row'),
                col: $seat.data('col'),
                ticketPrice: Number($seat.data('ticketPrice'))
            };
            newReservation.push(newRSeat);
            updateCheckout();
        }
    }

    function updateCheckout() {
        let totalPrice = 0;
        $('.checkout_description').html('');

        let $ul = $('<ul></ul>').addClass('price');
        newReservation.forEach(element => {
            if (element.act === "add") {
                let $li = $('<li></li>').text("row: " + element.row + ", column: " + element.col + ", ticket price: " + element.ticketPrice + "€");
                $li.addClass('positive');
                $ul.append($li);
                totalPrice += element.ticketPrice;
            } else {
                let $li = $('<li></li>').text("row: " + element.row + ", column: " + element.col + ", ticket price: " + element.ticketPrice + "€");
                $li.addClass('negative');
                $ul.append($li);
                totalPrice -= element.ticketPrice;
            }

        });
        $('.checkout_description').append($ul);

        $('.total').text('Total price: ' + totalPrice + '€');
    }

    function sendReservation() {
        if (newReservation.length) {
            let jsonData = JSON.stringify(newReservation);
            console.log(jsonData);

            let encodedData = encodeURIComponent(jsonData);

            let url = 'index.php?rt=reservations/saveNewReservation2&my_reservation=' + encodedData;
            window.location.href = url;
        }
    }
</script>




<?php require_once __DIR__ . '/footer.php'; ?>