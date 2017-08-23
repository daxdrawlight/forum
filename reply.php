<?php
//reply.php
include 'connect.php';
include 'session.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		//a real user posted a real reply
		if(mysqli_real_escape_string($conn, $_POST['reply-content']) == ''){
			
			}
		else{
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . mysqli_real_escape_string($conn, $_POST['reply-content']) . "',
						NOW(),
						" . mysqli_real_escape_string($conn, $_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";						
		$result = mysqli_query($conn, $sql);}
			
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			$postid = mysqli_insert_id($conn);
			echo '<div class="getid" id="'.$postid.'"></div>';
		}
	}
}
?>