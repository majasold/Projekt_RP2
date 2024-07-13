<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="newmovie" >NEW MOVIE</h1>

<form method = "post" action = "index.php?rt=home/addNewMovie" enctype="multipart/form-data">
  <div class="add-new-movie">
    <label>Movie title</label> <input type="text" name="movie-title" required>
    <label>Trailer URL</label> <input type="text" name="trailer-url" required>
    <label>Description</label> <input type="text" name="description" required>
    <label>Movie poster</label> <input type="file" name="movie-poster" required>
  </div>
  <button type="submit" class="submit">SUBMIT</button>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>
