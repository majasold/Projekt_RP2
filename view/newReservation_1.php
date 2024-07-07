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
            <div class = "hall-container">
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
                <div class = "hall-cont" id = "hall">
                    <div class = "screen"></div>
                    <div class = "seating-container" id = "seating"></div>
                </div>
            </div>
        </div>

        <div class = "newReservation1" id = "rightbox">
            <div class = "checkout">
                <h1>CHECKOUT</h1>
                <h3>Selected seats:</h3>
                <div class = "checkout_description"></div>
                <h3 class = "total" >Total price: 0€</h3>
                <div class = "buttons">
                    <button class = "confirm_reservation">
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

        let myReservation = [];

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
                            $newSeat.addClass('taken');
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

        function seatClick(){
            let $seat = $(this);

            //console.log("seatclick");

            if($seat.hasClass('selected')){
                $seat.toggleClass('selected');
                myReservation = myReservation.filter(obj => (obj.row !== $seat.data('row') || obj.col !== $seat.data('col')));
                updateCheckout();
            }else if(!$seat.hasClass('taken')){
                $seat.addClass('selected');
                let newRSeat = { row: $seat.data('row'), col: $seat.data('col'), ticketPrice: $seat.data('ticketPrice') };
                myReservation.push(newRSeat);
                updateCheckout();
            }
        }

        function updateCheckout(){
            let totalPrice = 0;
            $('.checkout_description').html('');

            let $ul = $('<ul></ul>');
            myReservation.forEach(element => {
                let $li = $('<li></li>').text("row: " + element.row +  ", column: " + element.col  +  ", ticket price: " +  element.ticketPrice + "€");
                $ul.append($li);
                totalPrice += element.ticketPrice;
            });
            $('.checkout_description').append($ul);

            $('.total').text('Total price: ' + totalPrice + '€');
        }

        function sendReservation(){
            if(myReservation.length){
                let jsonData = JSON.stringify(myReservation);
                console.log(jsonData); 

                    // Encode JSON string to URI component to pass as query parameter
                let encodedData = encodeURIComponent(jsonData);

                    // Construct the URL with query parameter
                let url = 'index.php?rt=reservations/saveNewReservation1&my_reservation=' + encodedData;
                    
                    // Redirect to process.php with the data encoded in the URL
                window.location.href = url;
   


            }

        }



    </script>


                          

<?php require_once __DIR__ . '/footer.php'; ?>