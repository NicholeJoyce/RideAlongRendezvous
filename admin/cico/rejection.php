<?php

include '../../includes/connection.php';

$emoney_id = $_GET['EMoneyID'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE emoney SET EMoneyStatus = 'rejected' WHERE EMoneyID='$emoney_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "danger";
$_SESSION['message'] = "Car has been rejected!";
header('Location: ' . $home . '/admin/index.php');
