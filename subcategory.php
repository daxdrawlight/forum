<?php
//subcategory.php
include 'connect.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$id = mysqli_real_escape_string($conn, $_GET['id']);

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
    $sql_count = "SELECT COUNT(topic_id)
              FROM topics
              WHERE topic_subcat = " . $id;

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
            echo '<a href="subcategory.php?id='. $id .'&page='. --$pageprev .'">';
            echo '<div class="topic_page_num"><</div>';
            echo '</a>';
        }
        if($total_pages <= 3)
        {
            for($i = 1; $i <= $total_pages; $i++)
            {
                echo '<a href="subcategory.php?id='. $id .'&page='. $i .'">';
                echo '<div class="topic_page_num">'. $i .'</div>';
                echo '</a>';
            }
        }
        else
        {
            echo '<a href="subcategory.php?id='. $id .'&page=1">';
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
                    echo '<a href="subcategory.php?id='. $id .'&page='. $i .'">';
                    echo '<div class="topic_page_num">'.$i.'</div>';
                    echo '</a>';
                }
            }
            if($page <= $total_pages - 4)
            {
                echo'<div class="topic_page_num_dots">...</div>';
            }
            echo '<a href="subcategory.php?id='. $id .'&page='. $total_pages .'">';
            echo '<div class="topic_page_num">'. $total_pages .'</div>';
            echo '</a>';

        }
    }
    if($pagenext < $total_pages)
    {
        echo '<a href="subcategory.php?id='. $id .'&page='. ++$pagenext .'">';
        echo '<div class="topic_page_num">></div>';
        echo '</a>';
    }

    echo '</div>';
}

if (isset($_GET["page"])){
	$page  = $_GET["page"];
}
else{
	$page = 1;
}

$ppp = 10;
$start_from = ($page-1) * $ppp;
$sql_count = "SELECT COUNT(topic_id)
              FROM topics
              WHERE topic_subcat = " . $id;

$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_row($result_count);
$total = $row_count[0];
$total_pages = ceil($total/$ppp);



$sql = "SELECT
			subcategories.subcat_id,
			subcategories.subcat_name,
			subcategories.subcat_description,
			subcategories.subcat_cat,
			categories.cat_name
		FROM
			subcategories
		LEFT JOIN
			categories
		ON subcategories.subcat_cat = categories.cat_id
		WHERE
			subcat_id = " . $id;

$result = mysqli_query($conn, $sql);
$rs = mysqli_query($conn, $sql);

echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';
 	while($row = mysqli_fetch_assoc($rs)){ 
		echo '<a href="category.php?id='.$row['subcat_cat'].'">'.$row['cat_name'].'</a> &#8594; ';
		echo ''.$row['subcat_name'].'';
		
	}
echo'</div>';

echo '<a href="create_topic.php?id='.$id.'"><div id="create_topic" class="create_topic">START A TOPIC</div></a>'.pagination().'';

echo '<div class="cat_wrap">';

	if(!$result)
    {
			echo '<div class="cat_title">';
			echo '<div class="pad20">';
			echo 'The categories could not be displayed, please try again later.';
			echo '</div>';
			echo '<div class="last_post">';
			echo 'Last post by';
			echo '</div>';
			echo '</div>';
	}
	else
    {
		if(mysqli_num_rows($result) == 0)
        {
			echo '<div class="cat_title">';
			echo '<div class="pad20">';
			echo 'No categories defined yet.';
			echo '</div>';
			echo '<div class="last_post">';
			echo 'Last post by';
			echo '</div>';
			echo '</div>';
		}
				
		else
        {
			while($row = mysqli_fetch_assoc($result))
            {
				echo '<div class="cat_title">';
				echo '<div class="pad20">';
				echo '<a href="subcategory.php?id=' . $row['subcat_id'] . '">' . $row['subcat_name'] . '</a>';
				echo '</div>';
				echo '<div class="last_post">';
				echo 'Last post by';
				echo '</div>';
				echo '</div>';
    
				$subcatsql = "SELECT topics.*, users.user_name, users.user_pic
				              FROM topics
				              LEFT JOIN users
                              ON topics.topic_by = users.user_id
				              WHERE topic_subcat = '" . $row['subcat_id'] . "'
							  ORDER BY topic_status_pinned  DESC, topic_date DESC
							  LIMIT ". $start_from .", ". $ppp ."";
				$subcatresult = mysqli_query($conn, $subcatsql);
					
				if(!$subcatresult)
                {
				    echo '<div class="subcat_row">';
							
				    echo '<div class="subcat_data">';
				    echo 'Topics could not be displayed.';
				    echo '</div>';
				}

				else
                {
					if(mysqli_num_rows($subcatresult) == 0)
                    {
						echo '<div class="subcat_row">';
						echo '<div class="subcat_data">';;
						echo 'There are no topics';
						echo '</div>';
					}

                    else
                    {
						while($subcatrow = mysqli_fetch_assoc($subcatresult))
                        {
                            $posts_per_page = 10;
                            $sql_count_posts = "SELECT COUNT(post_id)
                                                            FROM posts
                                                            WHERE post_topic = " . $subcatrow['topic_id'];

                            $result_count_posts = mysqli_query($conn, $sql_count_posts);
                            $row_count_posts = mysqli_fetch_row($result_count_posts);
                            $total_posts = $row_count_posts[0];
                            $total_post_pages = ceil($total_posts/$posts_per_page);

                            $topic_timestamp = $subcatrow['topic_date'];
                            $topic_relative_time =  relative_date(strtotime($topic_timestamp));

							echo '<div class="topic_row">';
							    echo '<img class="category_icon" src="images/topic-default.png"></img>';
							    echo '<div class="topic_data">';
                            if($subcatrow['topic_status_hidden'] == 1){
                                echo'<span class="hidden">Hidden</span>';
                            }
                            else{
                                echo'<span class="unhidden">Hidden</span>';
                            }
                            if($subcatrow['topic_status_locked'] == 1){
                                echo'<span class="locked">Locked</span>';
                            }
                            else{
                                echo'<span class="unlocked">Locked</span>';
                            }
                            if($subcatrow['topic_status_pinned'] == 1){
                                echo'<span class="pinned">Pinned</span>';
                            }
                            else{
                                echo'<span class="unpinned">Pinned</span>';
                            }
							        echo '<a href="topic.php?id=' . $subcatrow['topic_id'] . '">' . $subcatrow['topic_subject'] . '</a>';
                                echo '</div>';
                                echo '<div class="topic_data">';
                                    if($total_post_pages == 1)
                                    {
                                    }
                                    else
                                    {
                                        if($total_post_pages <= 3){
                                            for($i = 1; $i <= $total_post_pages; $i++)
                                            {
                                                echo '<a href="topic.php?id=' .$subcatrow['topic_id']. '&page='. $i .'">
	                                                  <div class="page_num">'.$i.'</div></a>';
                                            }
                                        }
                                        else
                                        {
                                            for($i = 1; $i <= 3; $i++)
                                            {
                                                echo '<a href="topic.php?id=' .$subcatrow['topic_id']. '&page='. $i .'">
	                                                  <div class="page_num">'.$i.'</div></a>';
                                            }
                                            echo '<div class="page_num">...</div>';
                                            echo '<a href="topic.php?id=' .$subcatrow['topic_id']. '&page='. $total_post_pages .'">
	                                                  <div class="page_num">'.$total_post_pages.'</div></a>';
                                        }
                                    }
							    echo '</div>';


                            $postsql = "SELECT post_id, post_date, post_by, topics.topic_id, topics.topic_subject, users.user_name, users.user_pic
                                        FROM posts
                                        LEFT JOIN topics
                                        ON posts.post_topic = topics.topic_id
                                        LEFT JOIN users
                                        ON posts.post_by = users.user_id
                                        WHERE topic_id = ".$subcatrow['topic_id']."
                                        ORDER BY post_date DESC
                                        LIMIT 1
										";

                            $postresult = mysqli_query($conn, $postsql);

                            if(!$postresult)
                            {
                                echo '<div class="last_topic">';
                                echo 'Last post could not be displayed.';
                                echo '</div>';

                            }
                            else
                            {
                                if(mysqli_num_rows($postresult) == 0)
                                {
                                    echo '<div class="last_topic">';
                                        if ($subcatrow['user_pic'] != "")
                                        {
                                            echo '<div class="latest_user_image" style="background-image:url('.$subcatrow['user_pic'].')"></div>';
                                        }
                                        else{
                                            echo '<img src="images/nopic.png"></img>';
                                        }
                                    echo '<ul>';
                                        echo '<li>
                                            <a title ="'. $subcatrow['user_name'] . '" href="user.php?id=' . $subcatrow['topic_by']  . '">'. $subcatrow['user_name'] .'</a>
                                          </li>
                                          <li>
                                            <span class="dat">' . $topic_relative_time . '<span>
                                            <a href="topic.php?id=' . $subcatrow['topic_id'] . '">&#10140;</a>
										  </li>';
                                    echo '</ul>';
                                    echo '</div>';


                                }
                                else
                                {
                                    while($postrow = mysqli_fetch_assoc($postresult))
                                    {

                                        $my_timestamp = $postrow['post_date'];
                                        $my_relative_time =  relative_date(strtotime($my_timestamp));
                                        echo '<div class="last_topic">';
                                        if ($postrow['user_pic'] != "")
                                        {
                                            echo '<img src="'. $postrow['user_pic'] .'"></img>';
                                        }
                                        else{
                                            echo '<img src="images/nopic.png"></img>';
                                        }
                                        echo '<ul>';
                                        echo '<li>
                                                <a title ="'. $postrow['user_name'] . '" href="user.php?id=' . $postrow['post_by']  . '">'. $postrow['user_name'] .'</a>
                                              </li>
                                              <li>
                                                <span class="dat">' . $my_relative_time . '<span>
                                                <a href="topic.php?id=' . $postrow['topic_id'] . '&page='.$total_post_pages.'#'.$postrow['post_id'].'">&#10140;</a>
											  </li>';
                                        echo '</ul>';
                                        echo '</div>';


                                    }
                                }
                            }

                            echo '<div class="subcat_count">';
                            echo '<li>'.$subcatrow['topic_views'].' views</li>';
                            echo '<li>'.$total_posts.' posts</li>';
                            echo '</div>';
                            echo '</div>';
						}
					}
				}
			}
        }
    }



echo '</div>';
pagination();
include 'footer.php';
?>