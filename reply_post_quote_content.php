<?php
include 'connect.php';
include 'session.php';

if(isset($_GET['page'])){
$page = mysqli_real_escape_string($conn, $_GET['page']);
}
else{
$page = 1;
}
$id = mysqli_real_escape_string($conn, $_GET['id']);
$post = mysqli_real_escape_string($conn, $_GET['post']);

$sql = "SELECT post_content, post_id, users.user_name
		FROM posts
		LEFT JOIN users
		ON posts.post_by = users.user_id
		WHERE post_id='".$post."'
		";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result))
{
    echo '<form class="reply_form" method="post" action="reply.php?id='. $id .'">';
    echo '<textarea id="edit1" name="reply-content"><blockquote><div class="quote_by">Originally posted by '.$row['user_name'].'<a href="topic.php?id='.$id.'&page='.$page.'#'.$post.'"> &#10140;</a>
            </div>'. htmlspecialchars_decode(stripslashes($row['post_content'])) . '</blockquote></textarea><br />';
    echo '<script>CKEDITOR.replace("edit1");</script>';
    echo '<input class="reply_btn" type="submit" value="SUBMIT REPLY" />	';

}
?>