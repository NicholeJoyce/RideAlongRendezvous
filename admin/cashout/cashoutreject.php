<?php

include '../../includes/connection.php';


$billing_id = $_GET['EMoneyID'];

//Selecting Users

$sql = "SELECT * FROM emoney INNER JOIN userinfo ON emoney.UserID = userinfo.UserID WHERE emoney.EMoneyID = '$billing_id'";
$result = $connection->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){

      
}

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE emoney SET EMoneyStatus = 'Rejected' WHERE EMoneyStatus='$billing_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();


$_SESSION['bg'] =  "danger";
    $_SESSION['message'] = "Cash In has been rejected!";

header('Location: ' . $home . '/admin/cico/cashin_design.php');
}