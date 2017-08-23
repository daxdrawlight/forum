<?php

include 'connect.php';
include 'session.php';

$sql = "UPDATE topics
		SET topic_status_pinned = '".mysqli_real_escape_string($conn, $_GET['pin'])."'
		WHERE topic_id = '".mysqli_real_escape_string($conn, $_GET['id'])."'";
$result = mysqli_query($conn, $sql);

?>