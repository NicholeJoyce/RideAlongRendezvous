<?php

include '../../includes/connection.php';

$pass_id = $_GET['PassengerID'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE passengerinfo SET IDstatus = 1 WHERE PassengerID='$pass_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "danger";
$_SESSION['message'] = "ID has been rejected!";
header('Location: ' . $home . '/admin/index.php');
