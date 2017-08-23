<?php
include 'connect.php';
include 'session.php';

$sql1 = "SELECT topic_by
		FROM topics
		WHERE topic_id='".mysqli_real_escape_string($conn, $_GET['id'])."'";
$result1 = mysqli_query($conn, $sql1);

while($row = mysqli_fetch_assoc($result1)){
if($_SESSION['user_level'] == 1 || $_SESSION['user_id'] == $row['topic_by']){
	$sql = "UPDATE topics
		    SET topic_content = '".mysqli_real_escape_string($conn, $_POST['post-edit'])."',
		    topic_edit_date = NOW(),
		    topic_edit_by = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'
		    WHERE topic_id = ".mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	}
	
else{
	echo 'Wrong turn space cowboy';
}
}
 ?>