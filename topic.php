<?php
//topic.php
include 'connect.php';
include 'header.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$sample_rate = 10;
$random = mt_rand(9,11);

if(mt_rand(1,$sample_rate) == 1) {
    $query = "UPDATE topics
              SET topic_views = topic_views + ".$random."
              WHERE topic_id = '".$id."' ";
    mysqli_query($conn, $query);
}


if (isset($_GET["page"]))
{
    $page  = $_GET["page"];
}
else
{
    $page = 1;
}

$ppp = 10;
$start_from = ($page-1) * $ppp;
$sql_count = "SELECT COUNT(post_id)
              FROM posts
              WHERE post_topic = " . $id;

$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_row($result_count);
$total = $row_count[0];
$total_pages = ceil($total/$ppp);

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
		return date('d F Y, h:i A', $time);
	} 
    }
function pagination()
{
    global $id;
    global $conn;

    if (isset($_GET["page"]))
    {
        $page  = $_GET["page"];
        $pageprev  = $_GET["page"];
        $pagenext  = $_GET["page"];
    }
    else
    {
        $page = 1;
        $pageprev = 1;
        $pagenext = 1;
    }

    $ppp = 10;
    $sql_count = "SELECT COUNT(post_id)
              FROM posts
              WHERE post_topic = " . $id;

    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_row($result_count);
    $total = $row_count[0];
    $total_pages = ceil($total/$ppp);


    echo '<div class="pagination">';

    if($total_pages == 1)
    {
    }

    else
    {
        if($pageprev > 1){
            echo '<a href="topic.php?id='. $id .'&page='. --$pageprev .'">';
                echo '<div class="topic_page_num"><</div>';
            echo '</a>';
        }
        if($total_pages <= 3)
        {
            for($i = 1; $i <= $total_pages; $i++)
            {
                echo '<a href="topic.php?id='. $id .'&page='. $i .'">';
                echo '<div class="topic_page_num">'. $i .'</div>';
                echo '</a>';
            }
        }
        else
        {
            echo '<a href="topic.php?id='. $id .'&page=1">';
            echo '<div class="topic_page_num">1</div>';
            echo '</a>';

            if($page >= 5)
            {
                echo'<div class="topic_page_num_dots">...</div>';
            }
            for($i = $page - 2; $i <= $page + 2; $i++)
            {
                if($i <= 1)
                {
                }
                else if($i == $total_pages)
                {
                    break;
                }
                else
                {
                    echo '<a href="topic.php?id='. $id .'&page='. $i .'">';
                    echo '<div class="topic_page_num">'.$i.'</div>';
                    echo '</a>';
                }
            }
            if($page <= $total_pages - 4)
            {
                echo'<div class="topic_page_num_dots">...</div>';
            }
            echo '<a href="topic.php?id='. $id .'&page='. $total_pages .'">';
                echo '<div class="topic_page_num">'. $total_pages .'</div>';
            echo '</a>';

            }
        }
        if($pagenext < $total_pages)
        {
            echo '<a href="topic.php?id='. $id .'&page='. ++$pagenext .'">';
                echo '<div class="topic_page_num">></div>';
            echo '</a>';
        }

    echo '</div>';
}



$sql = "SELECT topics.*, subcategories.subcat_id, subcategories.subcat_cat, subcategories.subcat_name,
               categories.cat_id, categories.cat_name, users.user_id, users.user_name, users.user_pic, users.user_signature
		FROM topics
		LEFT JOIN subcategories
		ON topics.topic_subcat = subcategories.subcat_id
        LEFT JOIN categories
        ON subcategories.subcat_cat = categories.cat_id
		LEFT JOIN users
		ON topics.topic_by = users.user_id
		WHERE topics.topic_id = " . $id;
			
$result = mysqli_query($conn, $sql);
$rs = mysqli_query($conn, $sql);

echo '<div class="breadcrumbs">';
    echo '<a href="index.php">Home</a> &#8594; ';

    while($row = mysqli_fetch_assoc($rs))
    {
        echo '<a href="category.php?id='. $row['subcat_cat'] .'">'. $row['cat_name'] .'</a> &#8594; ';
	    echo '<a href="subcategory.php?id='. $row['topic_subcat'] .'">'. $row['subcat_name'] .'</a> &#8594; ';
	    echo ''. $row['topic_subject'] .'';
	}
echo'</div>';

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<div class="topic_title">';
                if($row['topic_status_hidden'] == 1){
                    echo'<span class="hidden">Hidden</span>';
                }
                else{
                    echo'<span class="unhidden">Hidden</span>';
                }
                if($row['topic_status_locked'] == 1){
                echo'<span class="locked">Locked</span>';
                }
                else{
                    echo'<span class="unlocked">Locked</span>';
                }
                if($row['topic_status_pinned'] == 1){
                    echo'<span class="pinned">Pinned</span>';
                }
                else{
                    echo'<span class="unpinned">Pinned</span>';
                }
			    echo '<span class="topic_subject"><a href="topic.php?id='.$id.'">' . $row['topic_subject'] .'</a></span>
			    <button class="topic_moderation_btn">TOPIC MODERATION</button>
			    <div class="topic_moderation_content">
			        <button id="mod_title">Title</button>
			        <button id="mod_edit">Edit</button>
			        <button id="mod_delete">Delete</button>
			        <button id="mod_move">Move</button>
			        <button id="mod_merge">Merge</button>';
			        if($row['topic_status_pinned'] == 1){
                        echo'<button id="mod_unpin">Unpin</button>';
                    }
                    else{
                        echo '<button id="mod_pin">Pin</button>';
                    }

                    if($row['topic_status_hidden'] == 1){
                        echo'<button id="mod_show">Unhide</button>';
                    }
                    else{
                        echo '<button id="mod_hide">Hide</button>';
                    }
                    if($row['topic_status_locked'] == 1){
                        echo'<button id="mod_unlock">Unlock</button>';
                    }
                    else{
                        echo '<button id="mod_lock">Lock</button>';
                    }
			    echo '</div>';
			echo '</div>';
            echo '<div class="topic_bar">';
            echo 'This topic has '.$total.' replies.'. pagination() .'';
            echo '</div>';



			if(isset($_GET['page']) && $_GET['page'] != 1)
            {
			}
			else
            {
			    $my_timestamp = $row['topic_date'];
                $edit_time = $row['topic_edit_date'];
			    $my_relative_time =  relative_date(strtotime($my_timestamp));
                $relative_edit_time = relative_date(strtotime($edit_time));
			
			    echo '<div id="op" class="post_container">';
				    echo '<div  class="post_userinfo">';
					    if ($row['user_pic'])
					    {
                            echo '<div class="topic_user_image" style="background-image:url('.$row['user_pic'].')"></div>';
					    }
					    else{
						    echo '<img src="images/nopic.png"></img>';
					    }
					    echo '<div class="post_username"> '. $row['user_name'] . '</div>';
					echo '</div>';

					echo '<div class="post_body">';
					    echo '<div class="post_date">'. $my_relative_time  .'</div>';
						echo '<div class= "post_num" id="post1">';
                                echo '<a href="#post1">#1</a>';
						echo '</div>';
					    echo '<div class="topic_content" id="'.$row['topic_id'].'" >
					            '. htmlspecialchars_decode(stripslashes($row['topic_content'])) .'
					          </div>';

                        if($row['topic_edit_by']){echo '<div class="edit_by"><i>Last edited by: '.$row['topic_edit_by'].' - '.$relative_edit_time.'</i></div>';}

					    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['topic_by'] || $_SESSION['user_level'] == 1)
                        {
					        echo '<button class="edit_topic">Edit</button>';
					    }
					    if($_SESSION['user_level'] == 1)
                        {
					        echo '<button class="delete_topic">Delete</button>';
					    }
                        if(isset($_SESSION['user_id']))
                        {
                            echo '<button class="reply_topic_quote">Reply with quote</button>';
                        }

                        if($row['user_signature'])
                        {
                            echo '<div class="user_signature">'.$row['user_signature'].'</div>';
                        }
				    echo '</div>';

                echo '</div>';
			}
			
			$posts_sql = "SELECT
						        posts.*,
						        users.user_id,
						        users.user_name,
						        users.user_pic,
						        users.user_signature
					      FROM posts
					      LEFT JOIN users
					      ON posts.post_by = users.user_id
					      WHERE posts.post_topic = '". $id ."'
					      ORDER BY posts.post_date ASC
					      LIMIT ". $start_from .", ". $ppp ."";
						
			$posts_result = mysqli_query($conn, $posts_sql);
			
			if(!$posts_result)
			{
				echo 'The posts could not be displayed, please try again later.';
			}
			else
			{
				$counter = 1;
				while($posts_row = mysqli_fetch_assoc($posts_result))
				{	
					$counter++;
					$postnum = $counter + $start_from;
					$my_timestamp = $posts_row['post_date'];
					$my_relative_time =  relative_date(strtotime($my_timestamp));
                    $edit_post_time = $posts_row['post_edit_date'];
                    $relative_edit_post_time = relative_date(strtotime($edit_post_time));

					echo '<div  class="post_container">';
					    echo '<div class="post_userinfo">';
					        if ($posts_row['user_pic'] != "")
					        {
                                echo '<div class="topic_user_image" style="background-image:url('.$posts_row['user_pic'].')"></div>';
					        }
					        else
                            {
						        echo '<img src="images/nopic.png"></img>';
					        }
					        echo '<div class="post_username"> '. $posts_row['user_name'] . '</div>';
					    echo '</div>';

					    echo '<div class="post_body">';
					        echo '<div class="post_date">'. $my_relative_time  .'</div>';
                            echo '<div class= "post_num" id="post'.$postnum.'">';
                                echo '<a href="#post'.$postnum.'">#'.$postnum.'</a>';
                            echo '</div>';
					        echo '<div class="post_content" id="'.$posts_row['post_id'].'" >
					                '. htmlspecialchars_decode(stripslashes($posts_row['post_content'])) . '
					              </div>';

                            if($posts_row['post_edit_by']){
                            echo '<div class="edit_by"><i>Last edited by: '.$posts_row['post_edit_by'].' - '.$relative_edit_post_time.'</i></div>';}
					        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $posts_row['post_by'] ||  $_SESSION['user_level'] == 1)
                            {
					            echo '<button class="edit_post">Edit</button>';
					        }
					        if($_SESSION['user_level'] == 1)
                            {
					            echo '<button class="delete_post">Delete</button>';
					        }
                            if(isset($_SESSION['user_id']))
                            {
                                echo '<button class="reply_post_quote">Reply with quote</button>';
                            }
                    if($posts_row['user_signature'])
                    {
                        echo '<div class="user_signature">'.$posts_row['user_signature'].'</div>';
                    }
					    echo'</div>';

					echo '</div>';

				}
			}
		
	        if(!$_SESSION['signed_in'])
			{
				echo '<div class="reply_container">';
                echo '<div class="leave_response">';
                    echo '<a href="signin.php"><div class="signed_in">SIGN IN</div></a>to reply to this topic.'.pagination().'';
                echo '</div>';
                echo '</div>';
			}
			else
			{
				echo '<div class="reply_container">';
				    echo '<div class="leave_response">';
				        echo '<button class="reply_to_topic_btn">REPLY TO TOPIC</button>'.pagination().'';
				    echo '</div>';
				    echo '<div id="reply_content" class="reply_content">';
                        echo '<div class="post_userinfo">';
                            if ($_SESSION['user_pic'] != "")
                            {
                                echo '<img src="'. $_SESSION['user_pic'] .'"></img>';
                            }
                            else
                            {
                                echo '<img src="images/nopic.png"></img>';
                            }
                            echo '<div class="post_username"> '. $_SESSION['user_name'] . '</div>';
                        echo '</div>';
                        echo '<div class="reply_form_wrap">';
					        echo '<form class="reply_form" method="post" action="reply.php?id=
					                '. mysqli_real_escape_string($conn, $row['topic_id']) .'
					              ">';
					            echo '<textarea id="edit1" name="reply-content"></textarea><br />';
					            echo '<script>CKEDITOR.replace("edit1");</script>';
					            echo '<input class="reply_btn" type="submit" value="SUBMIT REPLY" />	';
					        echo '</form>';
                        echo '</div>';
				    echo '</div>';
				echo '</div>';
					
			}
			
		}
	}
}

include 'footer.php';
?>