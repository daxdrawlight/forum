<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

function array_map_callback($a)
{
    global $conn;
    return mysqli_real_escape_string($conn, $a);
}
$read = 0;
$reply = 0;
$post = 0;


if(isset($_POST['read_forum'])){
    $read = array_map('array_map_callback', $_POST['read_forum']);
}

if(isset($_POST['reply_forum'])){
    $reply = array_map('array_map_callback', $_POST['reply_forum']);
}

if(isset($_POST['post_forum'])){
    $post = array_map('array_map_callback', $_POST['post_forum']);
}

$sql = "SELECT * FROM groups";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){

    $group_id = $row['group_id'];
    $a = get_defined_vars();

    if($read && array_key_exists(''.$group_id.'', $_POST['read_forum'])){
        $read_forum = 1;
    }
    else{
        $read_forum = 0;
    }
    if($reply && array_key_exists(''.$group_id.'', $_POST['reply_forum'])){
        $post_replies = 1;
    }
    else{
        $post_replies = 0;
    }
    if($post && array_key_exists(''.$group_id.'', $_POST['post_forum'])){
        $post_topics = 1;
    }
    else{
        $post_topics = 0;
    }
   // echo ''.$row['group_name'].' read forum is '.$read_forum.'<br>';
   // echo ''.$row['group_name'].' post replies is '.$post_replies.'<br>';
   // echo ''.$row['group_name'].' post topics is '.$post_topics.'<br>';


    mysqli_query($conn, "UPDATE cat_perms SET read_forum = '$read_forum', post_replies = '$post_replies', post_topics = '$post_topics' WHERE group_id = '$group_id' AND cat_id = '$id'") or die(mysqli_error($conn));
 //   if(!mysqli_affected_rows($conn)){
  //      mysqli_query($conn, "INSERT INTO cat_perms (group_id, cat_id, read_forum, post_replies, post_topics) VALUES ('$group_id', '$id', '$read_forum', '$post_replies', '$post_topics')") or die(mysqli_error($conn));
   // }

}





?>