<?php

$dbc = mysqli_connect("localhost", "root", "", "retro_kicks");

if (!$dbc) {
    die("Greška pri spajanju na bazu: " . mysqli_connect_error());
}

mysqli_set_charset($dbc, "utf8mb4");

?>