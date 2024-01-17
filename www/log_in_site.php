<!DOCTYPE HTML>
<html lang="ro"> 
<HTML>
    <head>
        <title>Log In</title>
        <link rel="icon" type="image/x-icon" href="img/book.ico">
        <link rel="stylesheet" href="log_in_style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="index.html" target="_self">
    </head>
    <body>
        <main>
            <h3 id=log_in_header>Log In
            </h3>
            <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

            <?php } ?>
            <form method="POST" action="connect.php">
                <label for="user">User:</label><br>
                <input type="text" id="user" name="user"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br>
                <br>
                <input type="submit" value="Log In">
            </form>
            <br>
            <article>
                <p id=inv>Nu ai cont? <a href ="register.php">Înregistreaza-te acum!</a></p>
            </article>
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