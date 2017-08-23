<?php
include 'connect.php';
include 'session.php';

$sql = "SELECT topic_content, topic_by
		FROM topics
		WHERE topic_id='".mysqli_real_escape_string($conn, $_GET['id'])."'
		";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result))
				{
if($_SESSION['user_level'] == 1 || $_SESSION['user_id'] == $row['topic_by']){
	echo '<form class ="topicform" method="post" action="save_topic_edit.php?id='.mysqli_real_escape_string($conn, $_GET['id']).'">
	<textarea id="edit2" name="post-edit">'. htmlspecialchars_decode(stripslashes($row['topic_content'])) . '</textarea><br />
	<script>                		
	CKEDITOR.replace("edit2");
	</script>
		<button class="cancel_topic" type="button">Cancel</button><input class="save_btn" type="submit" value="Save" />					
	</form>';
}
	
else{
	echo 'Wrong turn space cowboy';
				}}
	?>
						
