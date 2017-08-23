<?php
include 'connect.php';

$sql2 = "SELECT topic_content
		FROM topics
		WHERE topic_id='".mysqli_real_escape_string($conn, $_GET['id'])."'
		";
$result2 = mysqli_query($conn, $sql2);

while($row2 = mysqli_fetch_assoc($result2))
				{
echo ''. htmlspecialchars_decode(stripslashes($row2['topic_content'])) . '';

}
?>