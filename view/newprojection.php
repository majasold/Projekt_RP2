<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW PROJECTION</title>
    <link rel="stylesheet" href="./view/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <form action="index.php?rt=login/addUser" method="post"> //nez sta tu ide
        <h3> <?php echo $this->message; ?></h3>
        <label>Movie Title</label>
        <select name="id_movie" id="movies">
            <?php foreach ($movies as $movie): ?>
                <option value="<?php echo htmlspecialchars($movie['id']); ?>">
                    <?php echo htmlspecialchars($movie['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Date</label>
        <input type="date" name="date" placeholder="YYYY-MM-DD"><br>

        <label>Time</label>
        <input type="time" name="time" placeholder="HH:MM"><br>

        <label>Cinema Hall</label>
        <input type="text" name="id_hall"><br>

        <label>Ticket Price</label>
        <input type="text" name="regular_price"><br>

        <br>
        <div class="buttons">
            <a href="index.php?rt=login">Login</a> //nesto drugo
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>