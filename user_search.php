<?php
//user_search.php
include 'connect.php';
include 'session.php';

$output = '';

if(isset($_POST['searchVal'])){
    $searchq = $_POST['searchVal'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    $sql = mysqli_query($conn, "SELECT users.*, groups.group_name FROM users LEFT JOIN groups ON users.user_group = groups.group_id WHERE user_name LIKE '%$searchq%'") or die("Error while searching");
    $count = mysqli_num_rows($sql);
    if($count == 0){
        $output = 'There are no search results';
    }
    else{
        while($row = mysqli_fetch_array($sql)){
            $name = $row['user_name'];
            $id = $row['user_id'];
            $group = $row['group_name'];

            $psql = mysqli_query($conn, "SELECT * FROM posts WHERE post_by = '$id'");
            $pcount = mysqli_num_rows($psql);

            $tsql = mysqli_query($conn, "SELECT * FROM topics WHERE topic_by = '$id'");
            $tcount = mysqli_num_rows($tsql);

            echo'<div class="acp_forums_row">
                <div class="acp_forums_row_data">
                    <span class="user_search_row">'.$name.'</span>
                    <span id="grey" class="user_search_row"> Posts: '.$pcount.'</span>
                    <span id="grey" class="user_search_row"> Topics: '.$tcount.'</span>
                    <span id="grey" class="user_search_row"> Group: '.$group.'</span>
                <div class="inline_row">
                    <span></span>
                    <button class="forum_options">&#9998;</button>
                    <button class="delete_subforum">&#10005;</button>
                </div>
                </div>
            </div>';
        }

    }
}

?>