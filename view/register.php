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
        <h2>PresentingMovies&Films</h2>
        <h3> <?php echo $this->message; ?></h3>
        <label>Email</label>
        <input type="text" name="email" placeholder="Email"><br>

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
            <a href="index.php?rt=login/checkGoogle">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                    </svg>
                </span>
                Continue with Google
            </a>
            <button type="submit">Register</button>
        </div>
    </form>
</body>

</html>