<?php
include 'connect.php';
include 'session.php';

$subforum = mysqli_real_escape_string($conn, $_GET['subforum']); //target subforum
$id = mysqli_real_escape_string($conn, $_GET['id']); //current topic


    $update_topic = "UPDATE topics
		             SET topic_subcat = '".$subforum."'
		             WHERE topic_id = '".$id."'";

    mysqli_query($conn, $update_topic);


?>