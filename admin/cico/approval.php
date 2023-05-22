<?php

include '../../includes/connection.php';

$emoney_id = $_GET['EMoneyID'];
$user_id = $_GET['UserID'];
$amount = $_GET['Amount'];
$id = $_SESSION['auth_id'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

$sql = "SELECT EMoneyID FROM emoney WHERE UserID = '$id' AND EMoneyStatus = 'approved'";
$result = $connection->query($sql);

    if($amount == '50.00'){
        $ticketamount = 40;
    }
    else if($amount == '100.00'){
        $ticketamount = 80;
    } 
    else if($amount == '250.00'){
        $ticketamount = 200;
    } 
    else if($amount == '500.00'){
        $ticketamount = 450;
    } 

    $stmnt = $connection->prepare("UPDATE emoney SET EMoneyStatus = 'approved' WHERE EMoneyID='$emoney_id'");
    $stmnt->execute();

    
    $stmnt = $connection->prepare("UPDATE userinfo SET uBalance = uBalance + '$ticketamount' WHERE UserID='$user_id'");
    $stmnt->execute();
    $stmnt->close();
    $connection->close();
    
    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Cash In has been successfully approved!";
    header('Location: ' . $home . '/admin/index.php');

