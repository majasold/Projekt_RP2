<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="title">
            <h1>PresentingMovies&Films</h1>
        </div>
        <div class="routes">

            <?php
            if (!isset($_SESSION['user'])) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=login">LOGIN</a></div>';
            } else if (isset($_SESSION['user']) and $_SESSION['user']->role === 1) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=home/newMovie">NEW MOVIE</a></div>' .
                    '<div class="right"><a href="index.php?rt=reservations">MY RESERVATIONS</a></div>' .
                    '<div class="right"><a href="index.php?rt=login/logout">LOGOUT</a></div>';
            } else if (isset($_SESSION['user']) and $_SESSION['user']->role === 2) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=home/newMovie">NEW MOVIE</a></div>' .
                    '<div class="right"><a href="index.php?rt=reservations/reservations">RESERVATIONS</a></div>' .
                    '<div class="right"><a href="index.php?rt=login/logout">LOGOUT</a></div>';
            } else if (isset($_SESSION['user']) and $_SESSION['user']->role === 3) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=reservations/reservations">RESERVATIONS</a></div>' .
                    '<div class="right"><a href="index.php?rt=login/logout">LOGOUT</a></div>';
            }
            ?>
        </div>
    </div>
</body>
<?php
if (!empty($this->message)) {
    echo '<h3>' . $this->message . '</h3><br>';
    exit();
}
?>

</html>
