<?php

include 'connect.php';
include 'session.php';

$sql = "UPDATE topics
		SET topic_status_hidden = '".mysqli_real_escape_string($conn, $_GET['hide'])."'
		WHERE topic_id = '".mysqli_real_escape_string($conn, $_GET['id'])."'";
$result = mysqli_query($conn, $sql);

?>