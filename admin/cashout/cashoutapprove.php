<?php

include '../../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $billing_id = $_GET['EMoneyID'];
$reference = $_POST['refer'];
$user_id = $_GET['UserID'];
//Selecting Users

$sql = "SELECT * FROM emoney INNER JOIN userinfo ON emoney.UserID = userinfo.UserID WHERE emoney.EMoneyID = '$billing_id'";
$result = $connection->query($sql);

$sqlReference = "UPDATE emoney SET ReferenceNum = $reference WHERE EMoneyID = '$billing_id'";
$referenceResult = $connection->query($sqlReference);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){

        //Declared Variables
        // $username = $row[''];
        // $email = $row['uEmail'];
        // $password = $row['uPassword'];
        // $fname = $row['uFirstName'];
        // $mname = $row['uMiddleName'];
        // $lname = $row['uLastName'];
        // $contact = $row['uContact'];
        // $street = $row['uStreet'];
        // $barangay = $row['uBarangay'];
        // $city = $row['uCity'];
        // $province = $row['uProvince'];
      
        
        $amount = $row['Amount'];
    }
}

$wholeNumber = floor($amount/1000); //get the whole number
$modulo = $amount % 1000;
if($modulo > 0 && $modulo <= 999){
    $wholeNumber += 1;
    $wholeNumber *= 20;
}else{
    $wholeNumber *= 20;
}

$resultCashOut = $amount + $wholeNumber;

// Prepared Statement & Binding (Avoid SQL Injections)
$stmnt = $connection->prepare("UPDATE emoney SET EMoneyStatus = 'approved' WHERE EMoneyID='$billing_id'");
$stmnt->execute();

// Update Cash Out
$stmnt = $connection->prepare("UPDATE emoney SET ProFee = '$wholeNumber' WHERE EMoneyID='$billing_id' ");
$stmnt->execute();
// Update User Type in Users Table
$stmnt = $connection->prepare("UPDATE userinfo INNER JOIN emoney ON emoney.UserID = userinfo.UserID SET uBalance = uBalance - '$resultCashOut' WHERE EMoneyID = '$billing_id'");
//$stmnt = $conn->prepare("UPDATE users INNER JOIN billing ON billing.uID = users.uID SET uBalance = uBalance + '$amount' WHERE billID = '$billing_id'");
$stmnt->execute();
$stmnt->close();
$connection->close();

$_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Cash In has been successfully approved!";
header('Location: ' . $home . '/admin/index.php');
}


 