<?php
include 'connect.php';

$sql2 = "SELECT post_content
		FROM posts
		WHERE post_id='".mysqli_real_escape_string($conn, $_GET['post'])."'
		";
$result2 = mysqli_query($conn, $sql2);

while($row2 = mysqli_fetch_assoc($result2))
				{
echo ''. htmlspecialchars_decode(stripslashes($row2['post_content'])) . '';
}
?>