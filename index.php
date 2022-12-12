<?php

require_once 'conn.php';

// define variables
$fname = $lname = $email = $phone = $password = $cpassword = $gender = $created_date = $modified_date = "";
$fnameErr = $lnameErr = $emailErr = $phoneErr = $passwordErr = $cpasswordErr = $genderErr = "";
$errorcheck = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errorcheck = 0;

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $gender = trim($_POST['gender']);
    $created_date = date("l jS \of F Y h:i:s A");

    // file validation
    $target_dir = "assets/images/";
    $file = $_FILES['file']['name'];
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    $allowed_image_extension = array("png", "jpg", "jpeg");

    // file validation
    if (empty($_FILES["file"]["name"])) {
        $fileErr = 'Please select image';
        $errorcheck = 1;
    }
    // Check file size
    elseif ($_FILES["file"]["size"] > 50000) {
        $fileErr = 'Sorry, your file is greater than 50kb.';
        $errorcheck = 1;
    } elseif (!in_array($imageFileType, $allowed_image_extension)) {
        $fileErr = 'Sorry, only JPG, JPEG & PNG files are allowed.';
        $errorcheck = 1;
    }

    // first name validation
    if (empty($fname)) {
        $fnameErr = "Please enter your first name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
        $fnameErr = "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($fname) < 3) {
        $fnameErr = "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // last name validation
    if (empty($lname)) {
        $lnameErr = "Please enter your last name";
        $errorcheck = 1;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
        $lnameErr = "Please enter characters only";
        $errorcheck = 1;
    } else if (strlen($lname) < 3) {
        $lnameErr = "Please enter at least 3 characters";
        $errorcheck = 1;
    }

    // email validation
    $sql = " SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if (empty($email)) {
        $emailErr = "Please enter your email";
        $errorcheck = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email";
        $errorcheck = 1;
    } elseif ($num == 1) {
        $emailErr = "Email already exist";
        $errorcheck = 1;
    }

    // phone number validation
    if (empty($phone)) {
        $phoneErr = "Please enter your phone number";
        $errorcheck = 1;
    } elseif (!is_numeric($phone)) {
        $phoneErr = "Please enter numeric only";
        $errorcheck = 1;
    } elseif (strlen($phone) != 10) {
        $phoneErr = "Enter 10 digit only";
        $errorcheck = 1;
    }

    // password validation
    if (empty($password)) {
        $passwordErr = "Please enter your password";
        $errorcheck = 1;
    }

    // confirm password validation
    if (empty($cpassword)) {
        $cpasswordErr = "Please enter your confirm password";
        $errorcheck = 1;
    } elseif ($password != $cpassword) {
        $cpasswordErr = "confirm password not matched with password";
        $errorcheck = 1;
    }

    // gender validation
    if (empty($gender)) {
        $genderErr = "Please select your gender";
        $errorcheck = 1;
    }

    if ($errorcheck == 0) {

        // insertion data in database 
        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password, gender, file, created_date, modified_date) 
        VALUES ('$fname','$lname','$email','$phone','$password','$gender', '$file', '$created_date', '$modified_date') ";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            header("location: login.php");
        } else {
            echo mysqli_error($conn);
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!----------------------------------- navbar -------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <?php
                    if (isset($_SESSION['id'])) {
                    ?>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                        </li>

                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <!----------------------------------- Registeration form -------------------------------------->
    <div class="container mt-5">
        <h1>Please Register Here</h1>
        <hr><br>
        <form class="row g-3" action="" method="post" id="form" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="file" class="form-label">Upload file</label>
                <span class="error" id="fileErr">*<?php echo $fileErr; ?></span>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <div class="col-md-6">
                <label for="fname" class="form-label">First Name</label>
                <span class="error" id="fnameErr" name="fnameErr">*<?php echo $fnameErr; ?></span>
                <input type="text" class="form-control" placeholder="Enter your first name" value="<?php echo $fname; ?>" id="fname" name="fname">
            </div>
            <div class="col-md-6">
                <label for="lname" class="form-label">Last Name</label>
                <span class="error" id="lnameErr" name="lnameErr">*<?php echo $lnameErr; ?></span>
                <input type="text" class="form-control" placeholder="Enter your last name" value="<?php echo $lname; ?>" id="lname" name="lname">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">E-Mail</label>
                <span class="error" id="emailErr" name="emailErr">*<?php echo $emailErr; ?></span>
                <input type="text" class="form-control" placeholder="Enter your email" value="<?php echo $email; ?>" id="email" name="email">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <span class="error" id="phoneErr" name="phoneErr">*<?php echo $phoneErr; ?></span>
                <input type="number" class="form-control" placeholder="Enter your phone number" value="<?php echo $phone; ?>" id="phone" name="phone">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <a href="" id="showpassword" class="showhidefont"><i class="fa-solid fa-eye-slash"></i></a>
                <span class="error" id="passwordErr" name="passwordErr">*<?php echo $passwordErr; ?></span>
                <input type="password" class="form-control" placeholder="Enter your password" value="<?php echo $password; ?>" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <a href="" id="showcpassword" class="showhidefont"><i class="fa-solid fa-eye-slash"></i></a>
                <span class="error" id="cpasswordErr" name="cpasswordErr">*<?php echo $cpasswordErr; ?></span>
                <input type="password" class="form-control" placeholder="Enter your confirm password" value="<?php echo $cpassword; ?>" id="cpassword" name="cpassword">
            </div>
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender1" <?php echo ($gender == 'Male') ? 'checked' : '' ?> name="gender" value="Male">
                    <label class="form-check-label" for="gender">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="gender2" <?php echo ($gender == 'Female') ? 'checked' : '' ?> name="gender" value="Female">
                    <label class="form-check-label" for="gender">Female</label>
                </div>
                <span class="error" id="genderErr" name="genderErr"> *<?php echo $genderErr; ?> </span>
            </div>
            <div class="col-12">
                <input type="text" class="mysubmit" name="mysubmit" id="mysubmit" value="mysubmit" style="display: none;">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>