<?php

$sname= "mysql-andry-library.alwaysdata.net";
$unmae= "335087_manager1";
$password = "PhpIsMyPassword1";
$db_name = "andry-library_admin";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}

?>