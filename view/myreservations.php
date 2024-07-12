<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="reservation">MY RESERVATIONS</h1>

<div class="table-reservations">
    <table class = "reservations">
      <thead class="reservations">
        <tr class = "reservations">
            <th class = "reservations">Movie Title</th>
            <th class = "reservations">Date</th>
            <th class = "reservations">Time</th>
            <th class = "reservations">Row</th>
            <th class = "reservations">Column</th>
            <th class = "reservations">Details</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($myReservations as $res) : ?>
            <tr class = "reservations">
                <td class = "reservations"><?php echo $res["movie"]->name; ?></td>
                <td class = "reservations"><?php echo $res["projection"]->date; ?></td>
                <td class = "reservations"><?php echo $res["projection"]->time; ?></td>
                <td class = "reservations"><?php echo $res["reservation"]->row; ?></td>
                <td class = "reservations"><?php echo $res["reservation"]->col; ?></td>
                <td class = "reservations"><?php echo $res["reservation"]->created; ?></td>
            </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
