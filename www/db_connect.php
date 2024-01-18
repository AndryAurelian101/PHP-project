<?php

$sname= "host";
$unmae= "user1";
$password = "Password1";
$db_name = "library_database";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}

?>
