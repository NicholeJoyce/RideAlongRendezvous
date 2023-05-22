<?php

include '../includes/connection.php';

$user_id = $_SESSION['auth_id'];

// Checks the Email & Password
$sql = "SELECT * FROM userinfo INNER JOIN passengerinfo ON userinfo.UserID = passengerinfo.UserID WHERE userinfo.UserID='$user_id'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (is_null($row['TimeConfirmed'])) {
    $pass_id_confirmed = 'false';
} else {
    $pass_id_confirmed = 'true';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dancing+Script:wght@700&family=Oswald&family=Pacifico&family=Shalimar&family=Sigmar&family=Varela+Round&family=Xanh+Mono:ital@1&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        /* Remove Arrows on Number Textfield */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        body , html{
            font-family: 'Bruno Ace Sc';
        }
    </style>
</head>

<body style="background: linear-gradient(to bottom left, #B0E0E6 10%, #BD1088 100%)">


    <div class="container my-3 col-lg-5">
    <img src="carpoollogo.png" class="centerpic">

        <form action="update_process.php" method="post">

            <h1 class="mb-3"> Update Profile </h1>
            <hr>

            <div class="row">
                <h3> Personal Details </h3>
                <div class="mb-3 col-4">
                    <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="fname" id="fname" class="form-control" required readonly value="<?= $row['FirstName'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
               
                <div class="mb-3 col-4">
                    <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="lname" id="lname" class="form-control" required readonly value="<?= $row['LastName'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="contact_no" class="form-label">Contact Number</label>
                    <input type="number" name="contact_no" id="contact_no" class="form-control">
                </div>
                <div class="mb-3 col-8">
                    <label for="st" class="form-label">Street <span class="text-danger">*</span></label>
                    <input type="text" name="st" id="st" class="form-control" required readonly value="<?= $row['Street'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
                <div class="mb-3 col-8">
                    <label for="unitnum" class="form-label">Unit/House Number <span class="text-danger">*</span></label>
                    <input type="text" name="unitnum" id="unitnum" class="form-control" readonly required value="<?= $row['UnitNum'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
                <div class="mb-3 col-8">
                    <label for="barangay" class="form-label">Barangay <span class="text-danger">*</span></label>
                    <input type="text" name="barangay" id="barangay" class="form-control" required readonly value="<?= $row['Baranggay'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="municipality" class="form-label">Municipality <span class="text-danger">*</span></label>
                    <input type="text" name="municipality" id="municipality" class="form-control" required readonly value="<?= $row['Municipality'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
                <div class="mb-3 col-6">
                    <label for="zipcode" class="form-label">ZipCode <span class="text-danger">*</span></label>
                    <input type="text" name="zipcode" id="zipcode" class="form-control" required readonly value="<?= $row['ZipCode'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>

                <div class="mb-3 col-6">
                    <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                    <input type="text" name="province" id="province" class="form-control" required readonly value="<?= $row['Province'] ?>" <?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
            </div>

            <hr>

            <!-- <div class="row">
                <h3> Identification </h3>
                <div class="mb-3 col-6">
                    <label for="idtype" class="form-label">ID Type</label>
                    <select class="form-select" name="idtype" id="idtype" aria-label="Default select example">
                        <option value=""<?//= $row['IDtype'] == '' ? 'selected' : '' ?> <?//= $pass_id_confirmed == 'true' ? 'disabled' : '' ?>>-- Select -- </option>
                        <option value="driver" <?//= $row['IDtype'] == 'driver' ? 'selected' : '' ?> <?//= $pass_id_confirmed == 'true' ? 'disabled' : '' ?>>Driver's License</option>
                        <option value="umid" <?//= $row['IDtype'] == 'umid' ? 'selected' : '' ?> <?//= $pass_id_confirmed == 'true' ? 'disabled' : '' ?>>UMID</option>
                        <option value="National ID" <?//= $row['IDtype'] == 'student' ? 'selected' : '' ?> <?//= $pass_id_confirmed == 'true' ? 'disabled' : '' ?>>Student ID</option>
                        <option value="student" <?//= $row['IDtype'] == 'student' ? 'selected' : '' ?> <?//= $pass_id_confirmed == 'true' ? 'disabled' : '' ?>>Student ID</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="idnumber" class="form-label">ID Number</label>
                    <input type="text" name="idnumber" id="idnumber" class="form-control" value="<?//= $row['ValidIDNum'] ?>" <//?= $pass_id_confirmed == 'true' ? 'readonly' : '' ?>>
                </div>
            </div> -->

            <div class="row">
                <div class="col">
                    <input type="submit" name="register" value="Update" class="btn btn-primary">
                    <a href="profile.php" class="btn btn-secondary" style="background-color:#161B30"> Back </a>
                </div>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>