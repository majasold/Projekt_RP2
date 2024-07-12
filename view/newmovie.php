<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="newmovie" >NEW MOVIE</h1>

<form method = "post" action = "index.php?rt=home/addNewMovie" enctype="multipart/form-data">
  <div class="add-new-movie">
    <label class="new-movie">Movie title</label> <input type="text" name="movie-title" class="new-movie-input" required>
    <label class="new-movie">Trailer URL</label> <input type="text" name="trailer-url" class="new-movie-input" required>
    <label class="new-movie">Description</label> <input type="text" name="description" class="new-movie-input" required>
    <label class="new-movie">Movie poster</label> <input type="file" name="movie-poster" class="new-movie-input" required>
  </div>
  <button type="submit" class="submit">SUBMIT</button>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>
