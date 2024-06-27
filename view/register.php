<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="./view/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <form action="index.php?rt=login/addUser" method="post">
        <h2>PresentingMoviesFilms</h2>
        <h3> <?php echo $this->message; ?></h3>
        <label>Username</label>
        <input type="text" name="username" placeholder="Username"><br>

        <label>First Name</label>
        <input type="text" name="firstname" placeholder="First Name"><br>

        <label>Last Name</label>
        <input type="text" name="lastname" placeholder="Last Name"><br>

        <label>Password</label>
        <input name="password" id="password" type="password" /><br>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" />
        <span id='message'></span>

        <script>
            $('#password, #confirm_password').on('keyup', function() {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#message').html('Matching password.<br>').css('color', 'green');
                } else
                    $('#message').html('Not matching password.<br>').css('color', 'red');
            });
        </script>
        <br>
        <div class="buttons">
            <a href="index.php?rt=login">Login</a>
            <button type="submit">Register</button>
        </div>
    </form>
</body>

</html>