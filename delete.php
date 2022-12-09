<?php

require_once 'conn.php';
if (isset($_SESSION['id']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("location: users.php?deleted successfully");
    }    
} else {
    header("location: login.php");
}
