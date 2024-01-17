<!DOCTYPE HTML>
<html lang="ro"> 
<HTML>
    <head>
        <title>Register</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="icon" type="image/x-icon" href="img/book.ico">
        <link rel="stylesheet" href="register_style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="index.html" target="_self">
    </head>
    <body>
            <main>
                <form action="verify_recaptcha.php" method="post">
                    <h1>Sign Up</h1>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div>
                        <label for="password">Parola:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div>
                        <label for="password2">Repetă parola:</label>
                        <input type="password" name="password2" id="password2">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcY3DUpAAAAAGE4s2_iEtQuwYyZ4YdF0e-5Rfid"></div>
                    <input class="btn btn-info" type="submit" name="submit" value="Register" >
                    <!-- <button type="submit">Register</button> -->
                    <p>Ai deja cont? <a href="log_in_site.php">Log In</a></p>
                </form>
            </main>
            <footer>
                <p>Site created by <a href="https://github.com/AndryAurelian101/PHP-project.git">Andry101</a>
                </p>
                <p>Student at the Faculty of Mathematics and Informatics Bucharest.
                </p>
                <p>Contact me <a href = "form.php">here</a>
                </p>
            </footer>
    </body>
</HTML>