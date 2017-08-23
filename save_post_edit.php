<?php
include 'connect.php';
include 'session.php';

$sql1 = "SELECT post_by
		FROM posts
		WHERE post_id='".mysqli_real_escape_string($conn, $_GET['post'])."'
		";
$result1 = mysqli_query($conn, $sql1);

while($row = mysqli_fetch_assoc($result1)){
if($_SESSION['user_level'] == 1 || $_SESSION['user_id'] == $row['post_by']){
	$sql = "UPDATE posts
		SET post_content = '".mysqli_real_escape_string($conn, $_POST['post-edit'])."',
		post_edit_date = NOW(),
		post_edit_by = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'
		WHERE post_id = '".mysqli_real_escape_string($conn, $_GET['post'])."'";
$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	}
	
else{
	echo 'Wrong turn space cowboy';
}
}
 ?>