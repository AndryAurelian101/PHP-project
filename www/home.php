<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirecteaza catre pagina de introducere a adresei de e-mail
    header('Location: log_in_site.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="ro"> 
<HTML>
    <head>
        <title>Biblioteca proiect</title>
        <link rel="icon" type="image/x-icon" href="img/book.ico">
        <link rel="stylesheet" href="main_style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="index.html" target="_self">
    </head>
    <body>
        <h1>Bun venit USER!</h1>
        <a href="logout.php">Logout</a>
    </body>
</HTML>