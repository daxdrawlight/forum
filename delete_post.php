<?php
include 'connect.php';
include 'session.php';
if($_SESSION['user_level'] != 1 ){
	echo 'Wrong turn space cowboy';
}

else{
	$sql = "DELETE FROM posts
		WHERE post_id = '".mysqli_real_escape_string($conn, $_GET['id'])."'";
		
	$result = mysqli_query($conn, $sql);
	}


?>