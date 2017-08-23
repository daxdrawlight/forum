<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT topic_subject
        FROM topics
        WHERE topic_id = ".$id;

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
echo 'Merge '.$row['topic_subject'].' with:';
echo '<form class="merge_form" method="post" action="">
        <input id="merge_url" placeholder="topic URL" type="text" name="merge_url" required>
        <input id="merge_btn" class="merge_btn" type="submit" value="MERGE" />
      </form>
 ';
}

?>