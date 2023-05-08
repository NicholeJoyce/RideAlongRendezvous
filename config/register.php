<?php

include '../includes/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = 'passenger';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact_no = $_POST['contact_no'];
    $st = $_POST['st'];
    $unitnum = $_POST['unitnum'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id_type = $_POST['idtype'];
    $id_number = $_POST['idnumber'];

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Invalid email format!";
        header('Location: ' . $home .'/index.php');
        return;
    }

    // Checks the Email 
    $sql = "SELECT * FROM userinfo WHERE Email='$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Email already exist!";
        header('Location: ' . $home .'/index.php');
        return;
    }

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO userinfo (UserLevel, FirstName, 
                                    LastName, ContactNum, 
                                    Email, Password, Street, UnitNum, Baranggay, 
                                    Municipality, ZipCode, Province)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('ssssssssssss', $type, $fname, $lname, $contact_no, 
                                    $email, $password, $st, $unitnum, $barangay, $municipality, $zipcode, $province);
    $stmnt->execute();

    // Adding to Passenger
    $sql = "SELECT UserID, TimeVerified, UserLevel  FROM userinfo WHERE Email='$email' AND Password='$password'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $user_id = $row['UserID'];

    $stmnt = $connection->prepare("INSERT INTO passengerinfo (UserID, IDtype, ValidIDNum)
            VALUES (?, ?, ?)");
    $stmnt->bind_param('sss', $user_id, $id_type, $id_number);
    $stmnt->execute();

    $stmnt->close();
    $connection->close();

    // Mailling Part
    $name = $fname . " " . $lname;
    $subject = " Ride Along Rendezvous|  " . $subject;
    $link = $home . "/config/verify.php?user=" . $email . "";
    $message = ' 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>
            #verify {
                background-color: #0f79b7;
                padding: 10px;
                text-decoration: none;
                color: white;
            }
            #verify:hover {
                background-color: #0988d2;
            }
        </style>
    </head>
    <body>
        <b> Ride Along Rendezvous </b>
        <hr>
        <p> Hi, ' . $name . '!</p>
        <p> Almost there! You just have one more step left to complete your Carpool App registration. Please click the link below to finalize the process.
            <br><br>
            <a id="verify" href="' . $link . '"> Verify Email Address </a>
            <br><br>
           
            <b> Ride Along Rendezvous <3 </b>
        </p>
    </body>
    </html>
    ';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = 'true';
    $mail->Username = 'carpool.applicationn@gmail.com';
    $mail->Password = 't v u q b d l e b l z o g u g c';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = '465';

    $mail->setFrom('carpool.applicationn@gmail.com', 'Ride Along Rendezvous');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->send();

    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Please check your email to verify your registration.";
    header('Location: ' . $home .'/index.php');
}
