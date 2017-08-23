<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT topic_subject
        FROM topics
        WHERE topic_id = ".$id;

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo 'Move '.$row['topic_subject'].' to:';
    echo '<form class="move_form" method="post" action="">
        <input id="move_url" placeholder="subforum URL" type="text" name="move_url" required>
        <input id="move_btn" class="move_btn" type="submit" value="MOVE" />
      </form>
 ';
}

?>