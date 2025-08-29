<?php
    $uname = "root";
    $pass = "";
    $server = "localhost";
    $db = "unit4_practice";
    $connection = mysqli_connect($server, $uname, $pass, $db);

    if(!$connection) {
        echo "Not Connected";
    }
?>