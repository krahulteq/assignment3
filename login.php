<?php

require_once 'conn.php';

// define variables
$email = $password = "";
$emailErr = $passwordErr = $validErr = "";
$num = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // email validation
  if (empty($email)) {
    $emailErr = "Please enter your email";
    $errorcheck = 1;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Please enter valid email";
    $errorcheck = 1;
  }

  // password validation
  if (empty($password)) {
    $passwordErr = "Please enter your password";
    $errorcheck = 1;
  }

  if (empty($emailErr) && empty($passwordErr)) {
    $sql = " SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' ";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $num = mysqli_num_rows($result);

    // Check for login successfully!
    if ($num == 1) {
      $_SESSION['id'] = $data['id'];
      header("location: users.php");
    } else {
      echo mysqli_error($conn);
      $num = 2;
      $validErr = "Please enter correct details for login...";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <style>
    .error {
      color: red;
    }
  </style>
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
              <a class="nav-link active" aria-current="page" href="index.php">Register</a>
            </li>

          <?php
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>
  <?php
  if ($num == 2) {
  ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <span><?php echo $validErr ?></span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  ?>
  <div class="container mt-5">
    <h1>Please Login Here</h1>
    <hr><br>
    <form class="row g-3" method="post">
      <div class="col-md-6">
        <label for="email" class="form-label">E-Mail</label>
        <span class="error" id="emailErr" name="emailErr">*<?php echo $emailErr; ?></span>
        <input type="text" class="form-control" placeholder="Enter your email" value="<?php echo $email; ?>" id="email" name="email">
      </div>
      <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <span class="error" id="passwordErr" name="passwordErr">*<?php echo $passwordErr; ?></span>
        <input type="password" class="form-control" placeholder="Enter your password" value="<?php echo $password; ?>" id="password" name="password">
      </div>
      <div class="col-12">
        <button type="submit" name="login" id="login" class="btn btn-primary">Login</button>
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