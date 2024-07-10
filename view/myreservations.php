<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="reservation">MY RESERVATIONS</h1>

<div class="table-reservations">
    <table>
        <tr>
            <th>Movie Title</th>
            <th>Date</th>
            <th>Time</th>
            <th>Row</th>
            <th>Column</th>
            <th>Details</th>
        </tr>
        <?php foreach ($myReservations as $res) : ?>
            <tr>
                <td><?php echo $res["movie"]->name; ?></td>
                <td><?php echo $res["projection"]->date; ?></td>
                <td><?php echo $res["projection"]->time; ?></td>
                <td><?php echo $res["reservation"]->row; ?></td>
                <td><?php echo $res["reservation"]->col; ?></td>
                <td><?php echo $res["reservation"]->created; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>