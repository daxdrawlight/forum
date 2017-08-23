<?php
include 'connect.php';
include 'session.php';
require_once('ImageManipulator.php');

$id = mysqli_real_escape_string($conn, $_GET['id']);

$valid_extensions = array('.jpg', '.jpeg', '.gif', '.png');
$file_extension = strrchr($_FILES['fileToUpload']['name'], ".");
$maxsize = 2097152;

    if (in_array($file_extension, $valid_extensions)) {

        if(($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES['fileToUpload']['size'] == 0))
        {
            echo 'File too large. File must be less than 2 megabytes.';
        }

        else
        {
            $newNamePrefix = time() . '_';
            $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
            $newImage = $manipulator->resample(150, 150, true);
            $manipulator->save('uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name']);
            mysqli_query($conn, "UPDATE users SET user_pic = 'uploads/". $newNamePrefix . $_FILES['fileToUpload']['name']."' WHERE user_id = $id");
            $_SESSION['user_pic'] = 'uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name'];
            header("Location: user.php?id=$id");

        }

    }
    else
    {
        echo 'You must upload an image...';
    }

?>