<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="movie-spec" ><?php echo $movie->name; ?></h1>
<div class="movie-spec">
    <iframe width="560" height="315" src=<?php echo $movie->url; ?> frameborder="0" allowfullscreen></iframe>
</div>

<div class="projections-container">
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Cinema Hall</th>
            <th>Free Spaces</th>
        </tr>
        <?php foreach ($projForOverview as $proj) : ?>
            <tr>
                <td><?php echo $proj["projection"]->date; ?></td>
                <td><?php echo $proj["projection"]->time; ?></td>
                <td><?php echo $proj["projection"]->id_hall; ?></td>
                <td><?php echo $proj["freeSpaces"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>