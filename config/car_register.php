<?php

include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['auth_id'];

    $plate_no = $_POST['LicensePlate'];
    // $field_office = $_POST['FieldOffice'];
    // $office_code = $_POST['OfficeCode'];
    // $receipt_no = $_POST['ReceiptNum'];
    // $tin_no = $_POST['TinNum'];

    $model = $_POST['CarModel'];
    $color = $_POST['CarColor'];
    
    $brand = $_POST['CarBrand'];
    $classification = $_POST['CarClassification'];
    $engine = $_POST['EngineNum'];

    $chassis = $_POST['ChassisNum'];
    $car_year = $_POST['YearReleased'];
    $car_type = $_POST['CarType'];

    $car_category = $_POST['CarCategory'];
    $car_fuel = $_POST['Fuel'];
    $car_renewal = $_POST['RenewalDate'];

    // Checks the Plate
    $sql = "SELECT * FROM car WHERE LicensePlate='$plate_no'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Car Plate Number already exist!";
        header('Location: ' . $home .'/user/car_register.php');
        return;
    }

    // Checks the Receipt No. 
    // $sql = "SELECT * FROM car WHERE ReceiptNum='$receipt_no'";
    // $result = $connection->query($sql);

    // if ($result->num_rows > 0) {
    //     $_SESSION['bg'] =  "danger";
    //     $_SESSION['message'] = "Car Receipt Number already exist!";
    //     header('Location: ' . $home .'/user/car_register.php');
    //     return;
    // }

    // Checks the Engine No. 
    $sql = "SELECT * FROM car WHERE EngineNum='$engine'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Car Engine Number already exist!";
        header('Location: ' . $home .'/user/car_register.php');
        return;
    }

    // Checks the Chassis
    $sql = "SELECT * FROM car WHERE ChassisNum='$chassis'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['bg'] =  "danger";
        $_SESSION['message'] = "Car Chassis already exist!";
        header('Location: ' . $home .'/user/car_register.php');
        return;
    }

    // Prepared Statement & Binding (Avoid SQL Injections)
    $stmnt = $connection->prepare("INSERT INTO car (DriverID, 
     LicensePlate, CarModel, CarColor, CarBrand,
    CarClassification, EngineNum, ChassisNum, YearReleased,
    CarType, CarCategory, Fuel, RenewalDate)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt->bind_param('sssssssssssss', $id, $plate_no, $model, $color, $brand,
    $classification, $engine, $chassis, $car_year, $car_type,
    $car_category, $car_fuel, $car_renewal);
    $stmnt->execute();
    $stmnt->close();
    $connection->close();

    $_SESSION['bg'] =  "warning";
    $_SESSION['message'] = "Your car is now pending for approval.";
    header('Location: ' . $home .'/user/view_cars.php');
}