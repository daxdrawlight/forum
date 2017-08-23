<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT topic_subject
        FROM topics
        WHERE topic_id = ".$id;

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo '<form class="change_topic_subject" method="post" action="">
        <input id="change_topic_subject" placeholder="'.$row['topic_subject'].'" value="'.$row['topic_subject'].'" type="text" name="merge_url" required>
        <input id="save_subject_btn" class="save_subject_btn" type="submit" value="SAVE" />
      </form>
 ';
}

?>