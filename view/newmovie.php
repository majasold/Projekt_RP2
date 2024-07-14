<?php require_once __DIR__ . '/header.php'; ?>

<h1 class="newmovie">NEW MOVIE</h1>

<form method="post" action="index.php?rt=home/addNewMovie" enctype="multipart/form-data">
  <div class="add-new-movie">

    <label>Movie title</label> <input type="text" name="movie-title" required>
    <br>
    <br>
    <label>Trailer URL</label> <input type="text" name="trailer-url" required>
    <br>
    <br>
    <label>Description</label> <input type="text" name="description" required>
    <br>
    <br>
    <label>Movie poster</label> <input type="file" name="movie-poster" required>
    <br>
    <br>
  </div>
  <div class="buttons">
    <button type="submit" class="submit">SUBMIT</button>
  </div>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>