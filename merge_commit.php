<?php
include 'connect.php';
include 'session.php';

$topic = mysqli_real_escape_string($conn, $_GET['topic']); //target topic
$id = mysqli_real_escape_string($conn, $_GET['id']); //current topic

$sql_topic = "SELECT *
              FROM topics
              WHERE topic_id = ".$id;

$result_topic = mysqli_query($conn, $sql_topic);

while($topic_row = mysqli_fetch_assoc($result_topic)){

    $insert_topic = "INSERT INTO
                        posts(post_content,
                        post_date,
                        post_topic,
                        post_by)
                    VALUES ('".$topic_row['topic_content']."',
                        '".$topic_row['topic_date']."',
                        '".$topic."',
                        '".$topic_row['topic_by']."')";

mysqli_query($conn, $insert_topic);
}

$sql_posts = "SELECT *
              FROM posts
              WHERE post_topic = ".$id;

$result_posts = mysqli_query($conn, $sql_posts);

while($posts_row = mysqli_fetch_assoc($result_posts)){


    $insert_posts = "INSERT INTO
                        posts(post_content,
                        post_date,
                        post_topic,
                        post_by,
                        post_edit_date,
                        post_edit_by)
                    VALUES ('".$posts_row['post_content']."',
                        '".$posts_row['post_date']."',
                        '".$topic."',
                        '".$posts_row['post_by']."',
                        '".$posts_row['post_edit_date']."',
                        '".$posts_row['post_edit_by']."')";

    mysqli_query($conn, $insert_posts);
}

$sql_delete_topic = "DELETE FROM topics
                     WHERE topic_id = ".$id;

mysqli_query($conn, $sql_delete_topic);


?>