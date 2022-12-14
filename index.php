<?php
require_once 'conn.php';
require_once 'registerprocess.php';
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
    <?php
    require_once 'navbar.php';
    ?>
    <!----------------------------------- Registeration form -------------------------------------->
    <div class="container mt-5">
        <h1>Please Register Here</h1>
        <hr><br>
        <form class="row g-3" action="" method="post" id="form" enctype="multipart/form-data">
            <div class="col-md-6">
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