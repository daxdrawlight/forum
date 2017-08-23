<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT topic_content, topic_id, users.user_name
		FROM topics
		LEFT JOIN users
		ON topics.topic_by = users.user_id
		WHERE topic_id='".$id."'
		";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result))
{
    echo '<form class="reply_form" method="post" action="reply.php?id='. mysqli_real_escape_string($conn, $row['topic_id']) .'">';
    echo '<textarea id="edit1" name="reply-content"><blockquote><div class="quote_by">Originally posted by '.$row['user_name'].'<a href="topic.php?id='.$id.'"> &#10140;</a>
    </div>'. htmlspecialchars_decode(stripslashes($row['topic_content'])) . '</blockquote></textarea><br />';
    echo '<script>CKEDITOR.replace("edit1");</script>';
    echo '<input class="reply_btn" type="submit" value="SUBMIT REPLY" />	';

}
?>