<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$name = mysqli_real_escape_string($conn, $_POST['forum_name']);
$description = mysqli_real_escape_string($conn, $_POST['forum_description']);
$hidden = mysqli_real_escape_string($conn, $_POST['forum_hidden']);
$cat = mysqli_real_escape_string($conn, $_POST['cat_id']);

$sql = "UPDATE subcategories
        SET subcat_name = '$name',
            subcat_description = '$description',
            subcat_status_hidden = '$hidden',
            subcat_cat = '$cat'
        WHERE subcat_id = '$id'";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));


?>