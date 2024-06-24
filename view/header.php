<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./view/index.css">
</head>

<body>
    <div class="header">
        <div class="title">
            <h1>PresentingMoviesFilms</h1>
        </div>
        <div class="routes">

            <?php
            if (!isset($_SESSION['user'])) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=login">LOGIN</a></div>';
            } else if (isset($_SESSION['user']) and $_SESSION['user']->role === 1) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=login/logout">LOGOUT</a></div>';
            } else if (isset($_SESSION['user']) and $_SESSION['user']->role === 2) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=login/logout">LOGOUT</a></div>';
            } else if (isset($_SESSION['user']) and $_SESSION['user']->role === 3) {
                echo '<div class="left"><a class="active" href="index.php?rt=home">HOME</a></div>' .
                    '<div class="right"><a href="index.php?rt=login/logout">LOGOUT</a></div>';
            }
            ?>
        </div>
    </div>
</body>

</html>