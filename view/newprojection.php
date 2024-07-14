<?php require_once __DIR__ . '/header.php'; ?>

<div class="projections">
<form action="index.php?rt=projections/addNewProjection" method="post">
    <div class="add-new-movie">
        <label>Movie Title</label><br>
        <select name="id_movie" id="movies">
            <?php foreach ($movies as $movie): ?>
                <option value="<?php echo $movie->id; ?>">
                    <?php echo $movie->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Date</label>
        <input type="date" name="date" placeholder="YYYY-MM-DD"><br>

        <label>Time</label>
        <input type="time" name="time" placeholder="HH:MM"><br>

        <label>Cinema Hall</label>
        <input type="text" name="id_hall"><br>

        <label>Ticket Price</label>
        <input type="text" name="regular_price"><br>

        <br>
        <h3> <?php echo $this->message; ?></h3>
        <br>
        <div class="button">
            <button type="submit">Submit</button>
        </div>
    </div>
    </form>
</div>   


<?php require_once __DIR__ . '/footer.php'; ?>