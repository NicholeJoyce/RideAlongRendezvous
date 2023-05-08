<?php

include '../../includes/connection.php';

$car_id = $_GET['CarID'];
$user_id = $_GET['UserID'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE car SET TimeCarConfirmed = '$timestamp' WHERE CarID='$car_id'");
$stmnt->execute();

$stmnt = $connection->prepare("UPDATE userinfo SET UserLevel = 'driver' WHERE UserID='$user_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['message'] = "Car has been successfully approved!";
header('Location: ' . $home . '/admin/index.php');
