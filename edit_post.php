<?php
include 'connect.php';
include 'session.php';

$sql = "SELECT post_content, post_by
		FROM posts
		WHERE post_id='".mysqli_real_escape_string($conn, $_GET['post'])."'
		";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result))
				{
if($_SESSION['user_id'] == $row['post_by'] || $_SESSION['user_level'] == 1){
	
	echo '<form class ="myform" method="post" action="save_post_edit.php?id='.mysqli_real_escape_string($conn, $_GET['id']).'&post='.mysqli_real_escape_string($conn, $_GET['post']).'">
	<textarea id="edit2" name="post-edit">'. htmlspecialchars_decode(stripslashes($row['post_content'])) . '</textarea><br />
	<script>                		
	CKEDITOR.replace("edit2");
	</script>
		<button class="cancel_btn" type="button">Cancel</button><input class="save_btn" type="submit" value="Save" />					
	</form>';
	}
	
else{
	echo 'Wrong turn space cowboy';
}
				}
	?>
						
