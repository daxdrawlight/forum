<?php
include 'connect.php';
include 'session.php';

$group_title = mysqli_real_escape_string($conn, $_POST['group_title']);
$user_title = mysqli_real_escape_string($conn, $_POST['user_title']);
$moderator_priv = mysqli_real_escape_string($conn, $_POST['moderator_priv']);
$moderator_edit = mysqli_real_escape_string($conn, $_POST['moderator_edit']);
$moderator_ban = mysqli_real_escape_string($conn, $_POST['moderator_ban']);
$read_board = mysqli_real_escape_string($conn, $_POST['read_board']);
$post_replies = mysqli_real_escape_string($conn, $_POST['post_replies']);
$post_topics = mysqli_real_escape_string($conn, $_POST['post_topics']);
$edit_posts = mysqli_real_escape_string($conn, $_POST['edit_posts']);
$delete_posts = mysqli_real_escape_string($conn, $_POST['delete_posts']);
$delete_topics = mysqli_real_escape_string($conn, $_POST['delete_topics']);
$set_title = mysqli_real_escape_string($conn, $_POST['set_title']);
$use_search = mysqli_real_escape_string($conn, $_POST['use_search']);

mysqli_query($conn, "INSERT INTO groups (group_name, group_user_title, group_moderator_priv, group_moderator_edit, group_moderator_ban, group_read_board, group_post_replies, group_post_topics, group_edit_posts, group_delete_posts, group_delete_topics, group_set_title, group_use_search)
VALUES('$group_title', '$user_title', '$moderator_priv', '$moderator_edit', '$moderator_ban', '$read_board', '$post_replies', '$post_topics', '$edit_posts', '$delete_posts', '$delete_topics', '$set_title', '$use_search')")
or die(mysqli_error($conn));
$group_id = mysqli_insert_id($conn);

$fsql = "SELECT * FROM categories";
$fresult = mysqli_query($conn, $fsql);

while($row = mysqli_fetch_assoc($fresult)){
    $forum_id = $row['cat_id'];
    mysqli_query($conn, "INSERT INTO cat_perms (group_id, cat_id, read_forum, post_replies, post_topics) VALUES('$group_id', '$forum_id', '$read_board', '$post_replies', '$post_topics')") or die(mysqli_error($conn));
}

$ssql = "SELECT * FROM subcategories";
$sresult = mysqli_query($conn, $ssql);

while($srow = mysqli_fetch_assoc($sresult)){
    $subforum_id = $srow['subcat_id'];
    mysqli_query($conn, "INSERT INTO subcat_perms (group_id, subcat_id, read_forum, post_replies, post_topics) VALUES('$group_id', '$subforum_id', '$read_board', '$post_replies', '$post_topics')") or die(mysqli_error($conn));
}

?>