<?php
include 'connect.php';
include 'session.php';

function relative_date($time){
	$today = strtotime(date('M j, Y'));
	$reldays = ($time - $today)/86400;
	if ($reldays >= 0 && $reldays < 1) {
		return 'Today, ' . date('h:i A', $time);
	} 
	else if ($reldays >= 1 && $reldays < 2) {
		return 'Tomorrow, '. date('h:i A', $time);
	} 
	else if ($reldays >= -1 && $reldays < 0) {
		return 'Yesterday, '. date('h:i A', $time);
	}
	if (abs($reldays) < 182) {
		return date('d-m-Y, h:i A', $time);
	} 
}

$sql = "SELECT
						posts.post_id,
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name,
						users.user_pic,
						users.user_signature
					FROM posts
					LEFT JOIN users
					ON posts.post_by = users.user_id
					WHERE posts.post_id = '" . mysqli_real_escape_string($conn, $_GET['id']) . "'";
					
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
	{
			$my_timestamp = $row['post_date'];
			$my_relative_time =  relative_date(strtotime($my_timestamp));
					echo '<div  class="post_container">';
					echo '<div class="post_userinfo">';
					if ($row['user_pic'] != "")
					{
						echo '<img src="' . $row['user_pic'] . '"></img>';
					}
					else{
						echo '<img src="images/nopic.png"></img>';
					}
					echo '<div class="post_username"> '. $row['user_name'] . '</div>';
					echo '</div>';
					echo '<div class="post_body">
					<div class="post_date">'. $my_relative_time  .'</div><div class="post_num">#</div>
					<div id="'.$row['post_id'].'" class="post_content">'. htmlspecialchars_decode(stripslashes($row['post_content'])) . '</div>';

        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['post_by'] ||  $_SESSION['user_level'] == 1)
        {
            echo '<button class="edit_post">Edit</button>';
        }
        if($_SESSION['user_level'] == 1)
        {
            echo '<button class="delete_post">Delete</button>';
        }
                    if($row['user_signature'])
                    {
                        echo '<div class="user_signature">'.$row['user_signature'].'</div>';
                    }
					echo'</div><div></div></div>';
	}
?>