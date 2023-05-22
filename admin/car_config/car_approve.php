<?php

include '../../includes/connection.php';

$car_id = $_GET['CarID'];
$user_id = $_GET['UserID'];
$id = $_SESSION['auth_id'];

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');

$sql = "SELECT CarID FROM car WHERE DriverID = '$user_id' AND TimeCarConfirmed IS NOT NULL";
$result = $connection->query($sql);

if ($result->num_rows == 0){

    $stmnt = "UPDATE userinfo SET uBalance = uBalance + 40 WHERE UserID = '$user_id'";
    $result = $connection->query($stmnt);
    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("UPDATE car SET TimeCarConfirmed = '$timestamp' WHERE CarID='$car_id'");
    $stmnt->execute();
    $stmnt->close();
    $connection->close();
    
    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Car has been successfully approved!";
    header('Location: ' . $home . '/admin/index.php');

}else{
    
    // echo "bakit ka nandito? else to ah? don ka sa if!";
    $stmnt = $connection->prepare("UPDATE car SET TimeCarConfirmed = '$timestamp' WHERE CarID='$car_id'");
    $stmnt->execute();
    $stmnt->execute();
    $stmnt->close();
    $connection->close();
    
    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Car has been successfully approved!";
    header('Location: ' . $home . '/admin/index.php');

}
