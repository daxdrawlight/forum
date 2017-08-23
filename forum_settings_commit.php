<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$name = mysqli_real_escape_string($conn, $_POST['forum_name']);
$description = mysqli_real_escape_string($conn, $_POST['forum_description']);
$hidden = mysqli_real_escape_string($conn, $_POST['forum_hidden']);
$subforums = mysqli_real_escape_string($conn, $_POST['list_subforums']);

$sql = "UPDATE categories
        SET cat_name = '$name',
            cat_description = '$description',
            cat_status_hidden = '$hidden',
            cat_status_subcat = '$subforums'
        WHERE cat_id = '$id'";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));


?>