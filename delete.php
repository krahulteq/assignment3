<?php

require_once 'conn.php';
if (isset($_SESSION['id']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `users` SET `soft_delete` = '0' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location: users.php?deleted successfully");
    }
} else {
    header("location: login.php");
}
