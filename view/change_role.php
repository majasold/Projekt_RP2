<?php require_once __DIR__ . '/header.php'; ?>


<div class="projections-container">
    <table class="projections">
        <thead class="projections">
            <tr class="projections">
                <th class="projections">Name</th>
                <th class="projections">Surname</th>
                <th class="projections">Role</th>
            </tr>
        </thead>
//treba mijenjat ovo sve dolje
        <tbody>
            <?php foreach ($projForOverview as $proj) : ?>
                <tr class="projections" data-href="index.php?rt=reservations/newReservation1&id_projection=<?php echo $proj['projection']->id_projection; ?>">
                    <td class="projections"><?php echo $proj["projection"]->date; ?></td>
                    <td class="projections"><?php echo $proj["projection"]->time; ?></td>
                    <td class="projections"><?php echo $proj["projection"]->id_hall; ?></td>
                    <td class="projections"><?php echo $proj["freeSeats"]; ?></td>
                </tr>
            <?php endforeach; ?>  
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.projections tbody tr').on('click', function() {
            var href = $(this).data('href');
            if (href) {
                window.location.href = href;
            }
        });
    });
</script>

<?php require_once __DIR__ . '/footer.php'; ?>