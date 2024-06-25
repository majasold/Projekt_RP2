<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./view/login.css">
</head>

<body>
    <form action="index.php?rt=login/checkUser" method="post">
        <h2>PresentingMoviesFilms</h2>
        <h3> <?php echo $this->message; ?></h3>
        <label>Username</label>
        <input type="text" name="username" placeholder="Username"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <div class="buttons">
            <a href="index.php?rt=login/register">Register</a>
            <button type="submit">Login</button>
        </div>
    </form>
</body>

</html>