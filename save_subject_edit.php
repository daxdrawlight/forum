<?php
include 'connect.php';
include 'session.php';

$subject = mysqli_real_escape_string($conn, $_GET['subject']);
$id = mysqli_real_escape_string($conn, $_GET['id']);


$update_topic = "UPDATE topics
		         SET topic_subject = '".$subject."'
		         WHERE topic_id = '".$id."'";

mysqli_query($conn, $update_topic);


?>