<?php
require_once 'conn.php';
if (isset($_SESSION['id'])) {

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
    </head>

    <body>
        <?php
        require_once 'navbar.php';
        
        $success = 0;
        $success = $_GET['success'];
        if ($success == 1) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>Data updated successfully</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        $loginsuccess = 0;
        $loginsuccess = $_GET['loginsuccess'];
        if ($loginsuccess == 1) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>Logged in successfully</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        $deletesuccess = 0;
        $deletesuccess = $_GET['deletesuccess'];
        if ($deletesuccess == 1) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>Data deleted successfully</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Image</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `users` WHERE `soft_delete` = '1'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    if ($num > 0) {
                        $sr = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $fname = strtoupper($row['first_name']);
                            $lname = strtoupper($row['last_name']);
                            $email = $row['email'];
                            $phone = $row['phone_number'];
                            $gender = strtoupper($row['gender']);
                            $file = $row['file'];

                            echo '
                                <tr>
                                <td>' . $sr . '</td>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $email . '</td>
                                <td>' . $phone . '</td>
                                <td>' . $gender . '</td>
                                <td><img src="assets/images/' . $file . '" alt="" style="height:30px; width:50px"></td>
                                <td><a href="view.php?id=' . $id . '">View</a></td>
                                <td><a href="update.php?id=' . $id . '">Edit</a></td>
                                <td><a onclick="return confirmation()" href="delete.php?id=' . $id . '">Delete</a></td>
                                <td>
                                </tr>
                                ';
                            $sr += 1;
                        }
                    }
                    ?>
                </tbody>
            </table>
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
<?php
} else {
    header("location: login.php");
}
?>