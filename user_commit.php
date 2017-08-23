<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

if(isset($_POST['email'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "UPDATE users SET user_email = '$email' WHERE user_id = '$id'") or die(mysqli_error($conn));
}

if(isset($_POST['signature'])){
    $signature = mysqli_real_escape_string($conn, $_POST['signature']);
    mysqli_query($conn, "UPDATE users SET user_signature = '$signature' WHERE user_id = '$id'") or die(mysqli_error($conn));
}


?>