<?php

$server = "localhost";
$server_username = "root";
$server_password = "";
$server_database = "carpool";
$home = "http://localhost/trylang/";

// $server = "localhost";
// $server_username = "u235219407_jeyymsantos";
// $server_password = "Jeyym@15";
// $server_database = "u235219407_carpool_app";
// $home = "https://carpool.jeyymsantos.com/";

$connection = mysqli_connect($server, $server_username, $server_password, $server_database);
session_start();

?>