<?php require_once __DIR__ . '/header.php'; ?>

<div class="movies-container">
    <?php foreach ($movies as $movie) : ?>
        <a class="movie-card" href="index.php?rt=projections/overview&id_movie=<?php echo $movie->id; ?>">
            <div class="movie-bg" style="background-image: url('./images/<?php echo 'movie_' . $movie->id; ?>.jpg');"></div>
            <div class="movie-name"><?php echo $movie->name; ?></div>
        </a>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>