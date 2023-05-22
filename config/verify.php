<?php

include '../includes/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../config/phpmailer/src/Exception.php';
require '../config/phpmailer/src/PHPMailer.php';
require '../config/phpmailer/src/SMTP.php';

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$timestamp = $now->format('Y-m-d H:i:s');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $email = $_GET['user'];


    // Checks the Email if Verified
    $sql = "SELECT * FROM userinfo WHERE Email='$email'";
    $result = $connection->query($sql);

    $row = $result->fetch_assoc();

    if (!is_null($row['TimeVerified'])) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Email has already been verified!";
        header('Location: index.php');
        return;
    }


    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = "UPDATE userinfo SET TimeVerified='$timestamp', uBalance=10 WHERE Email = '$email'";
    $result = $connection->query($stmnt);
    // $stmnt->bind_param('sss', $timestamp, $email);
    // $stmnt->execute();
    // $stmnt->close();
    // $connection->close();

    $_SESSION['bg'] =  "success";
    $_SESSION['message'] = "Your email is now verified! You have now 10 tickets free! You may now login to your account to view your profile.";
    header('Location: ' . $home . '/index.php');
}
