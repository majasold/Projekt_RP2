<?php require_once __DIR__ . '/header.php'; ?>

<div class="movie-spec-container">
    <div class="movie-spec">
        <h1><?php echo $movie->name; ?></h1>
        <p><?php echo $movie->description; ?></p>
    </div>

    <div class="movie-spec">
        <div class="video-wrapper">
            <iframe src="<?php echo $movie->url; ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<br>

<div class="projections-container">
    <table class="projections">
        <thead class="projections">
            <tr class="projections">
                <th class="projections">Date</th>
                <th class="projections">Time</th>
                <th class="projections">Cinema Hall</th>
                <th class="projections">Free Seats</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($projForOverview as $proj) : ?>
                <tr class="projections" data-id-projection="<?php echo $proj["projection"]->id_projection; ?>">
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
            let role = <?php echo isset($_SESSION['user']) ? $_SESSION['user']->role : 0; ?>;
            console.log("role je " + role);
            let projectionId = $(this).data('id-projection');
            let url;
            if(role <= 1){
                url = 'index.php?rt=reservations/newReservation1&id_projection=' + projectionId;
            } else if(role > 1) {
                url = 'index.php?rt=reservations/newReservation2&id_projection=' + projectionId;
            }
            window.location.href = url;
        });
    });
</script>

<?php require_once __DIR__ . '/footer.php'; ?>