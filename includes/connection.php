<?php
// localhost
$server = "localhost";
$server_username = "root";
$server_password = "";
$server_database = "carpool";
$home = "http://localhost/trylang/";

//hosting
// $server = "localhost";
// $server_username = "u235219407_ridealong";
// $server_password = "RideAlongRendezvous01*";
// $server_database = "u235219407_ridealong";
// $home = "https://ridealong.dnails.shop//";

$connection = mysqli_connect($server, $server_username, $server_password, $server_database);
session_start();

?>