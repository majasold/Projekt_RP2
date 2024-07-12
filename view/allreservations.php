<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="reservation" >RESERVATIONS</h1>

<form method = "post" action = "index.php?rt=reservations/deleteReservation">
  <div class="table-reservations">
      <table class = "reservations">
        <thead class="reservations">
          <tr>
              <th></th>
              <th>Name</th>
              <th>Surname</th>
              <th>Movie Title</th>
              <th>Date</th>
              <th>Time</th>
              <th>Cimena Hall</th>
              <th>Row</th>
              <th>Column</th>
              <th>Details</th>
          </tr>
        </thead>

        <tbody class = "reservations">
          <?php foreach ($allReservations as $res) : ?>
              <tr>
                  <td><input type = "checkbox" name = "reservations[]" value = "<?php echo $res["reservation"]->id_reservation; ?>" class = "checkbox"></td>
                  <td><?php echo $res["user"]->name; ?></td>
                  <td><?php echo $res["user"]->surname; ?></td>
                  <td><?php echo $res["movie"]->name; ?></td>
                  <td><?php echo $res["projection"]->date; ?></td>
                  <td><?php echo $res["projection"]->time; ?></td>
                  <td><?php echo $res["projection"]->id_hall; ?></td>
                  <td><?php echo $res["reservation"]->row; ?></td>
                  <td><?php echo $res["reservation"]->col; ?></td>
                  <?php $ticketCode = $this->generateURL($reservation->id_reservation, $reservation->created); ?>
                  <td><div class= "buttons">
                          <button class = "qr" data-href = <?php echo " <a href='{$ticketCode}' target='_blank'>Ticket code</a>" ?> >
                          </button>
                      </div>
                  </td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  <button type="submit" class="submit">DELETE</button>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>
