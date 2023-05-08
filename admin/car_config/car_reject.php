<?php

include '../../includes/connection.php';

$car_id = $_GET['CarID'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE car SET Status = 1 WHERE CarID='$car_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "danger";
$_SESSION['message'] = "Car has been rejected!";
header('Location: ' . $home . '/admin/index.php');
