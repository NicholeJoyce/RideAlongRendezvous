<?php

include '../includes/connection.php';

$user_id = $_SESSION['auth_id'];

$fname = $_POST['FirstName'];
$lname = $_POST['LastName'];
$contact_no = $_POST['ContactNum'];
$st = $_POST['Street'];
$unitnum = $_POST['UnitNum'];
$barangay = $_POST['Baranggay'];
$municipalicity = $_POST['Municipality'];
$zipcode = $_POST['ZipCode'];
$province = $_POST['Province'];
$id_type = $_POST['IDtype'];
$id_number = $_POST['ValidIDNum'];

$stmnt = $connection->prepare("UPDATE userinfo SET FirstName = '$fname', LastName = '$lname',
    ContactNum = '$contact_no', Street = '$st', UnitNum = '$unitnum', Baranggay = '$barangay', Municipality = '$municipality', Province = '$province' WHERE UserID='$user_id'");
$stmnt->execute();

$stmnt = $connection->prepare("UPDATE passengerinfo SET IDtype = '$id_type', ValidIDNum = '$id_number' WHERE UserID='$user_id'");
$stmnt->execute();

$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
$_SESSION['message'] = "Profile has been successfully updated!";
header('Location: ' . $home . '/user/profile.php');
