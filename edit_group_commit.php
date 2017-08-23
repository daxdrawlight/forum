<?php
include 'connect.php';
include 'session.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

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

mysqli_query($conn, "UPDATE groups SET group_name = '$group_title', group_user_title = '$user_title', group_moderator_priv = '$moderator_priv', group_moderator_edit = '$moderator_edit', group_moderator_ban = '$moderator_ban',
group_read_board = '$read_board', group_post_replies = '$post_replies', group_post_topics = '$post_topics', group_edit_posts = '$edit_posts', group_delete_posts = '$delete_posts', group_delete_topics = '$delete_topics',
group_set_title = '$set_title', group_use_search = '$use_search' WHERE group_id = '$id'")

or die(mysqli_error($conn));

?>