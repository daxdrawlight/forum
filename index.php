<?php
//index.php
include 'connect.php';
include 'header.php';

$sql = "SELECT categories.cat_id, categories.cat_name, categories.cat_description
		FROM categories
		LEFT JOIN subcategories
		ON subcategories.subcat_cat = categories.cat_id
		GROUP BY categories.cat_name, categories.cat_description, categories.cat_id
		ORDER BY cat_order DESC";

$result = mysqli_query($conn, $sql);


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
?>

<?php         
		if(!$result)
        {
			echo '<div class="cat_title">';
			echo '<div class="pad20">';
			echo 'The categories could not be displayed, please try again later.';
			echo '</div>';
			echo '<div class="last_post">';
			echo 'Last Post';
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
					echo 'Last Post';
					echo '</div>';
					echo '</div>';
				}
				
				else
                {
					while($row = mysqli_fetch_assoc($result))
                    {
						echo '<div class="cat_title">';
						echo '<div class="pad20">';
						echo '<a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a>';
						echo '</div>';
						echo '<div class="last_post">';
						echo 'Latest topic';
						echo '</div>';
						echo '</div>';		
    
					    $subcatsql = "SELECT * FROM subcategories WHERE subcat_cat = '" . $row['cat_id'] . "'";
					    $subcatresult = mysqli_query($conn, $subcatsql);
					
						if(!$subcatresult)
                        {
							echo '<div class="subcat_row">';
							echo '<div class="subcat_data">';
							echo 'Subcategories could not be displayed.';
							echo '</div>';
                            echo '</div>';
						}
						else
                        {
							if(mysqli_num_rows($subcatresult) == 0)
                            {
								echo '<div class="subcat_row">';
								echo '<div class="subcat_data">';;
								echo 'There are no subcategories';
								echo '</div>';
                                echo '</div>';
							}
							else
                            {
								while($subcatrow = mysqli_fetch_assoc($subcatresult))
                                {
									echo '<div class="subcat_row">';
									echo '<img class="category_icon" src="images/subcat-default.png"></img>';
									echo '<div class="subcat_data">';
                                    echo '<ul>';
									echo '<li><a href="subcategory.php?id=' . $subcatrow['subcat_id'] . '">' . $subcatrow['subcat_name'] . '</a></li>';
                                    echo '<li class="subcat_desc">'.$subcatrow['subcat_description'].'</li>';
                                    echo'</ul>';
									echo '</div>';


									$topicsql = "SELECT topic_id, topic_subject, topic_date, topic_by, users.user_name, users.user_pic
                                                 FROM topics
                                                 LEFT JOIN users
                                                 ON topics.topic_by = users.user_id
                                                 WHERE topic_subcat = ".$subcatrow['subcat_id']."
                                                 ORDER BY topic_date DESC
                                                 LIMIT 1
												 ";

									$topicsresult = mysqli_query($conn, $topicsql);

                                    echo '<div class="last_topic">';
									if(!$topicsresult)
                                    {
										echo 'Last post could not be displayed.';
									}
									else
                                    {
										if(mysqli_num_rows($topicsresult) == 0)
                                        {
											echo 'There are no topics';

										}
										else
                                        {
											while($topicrow = mysqli_fetch_assoc($topicsresult))
                                            {
                                               	$my_timestamp = $topicrow['topic_date'];
												$my_relative_time =  relative_date(strtotime($my_timestamp));

                                                if ($topicrow['user_pic'] != "")
                                                {
                                                    echo '<div class="latest_user_image" style="background-image:url('.$topicrow['user_pic'].')"></div>';
                                                }
                                                else{
                                                    echo '<img src="images/nopic.png"></img>';
                                                }
												echo '<ul>';
												echo '<li><a title ="'. $topicrow['topic_subject'] . '" href="topic.php?id=' . $topicrow['topic_id'] . '">
												            ' . $topicrow['topic_subject'] . '</a></li>
													  <li><span class="dat">' . $my_relative_time . ' 
													   by  <a title ="'. $topicrow['user_name'] . '" href="user.php?id=' . $topicrow['topic_by']  . '">' . $topicrow['user_name'] . '</a></span></li>';
	
												echo '</ul>';


												
											}
										}
									}
                                    echo '</div>';
                                    $sql_topic_count = "SELECT COUNT(topic_id)
                                                        FROM topics
                                                        WHERE topic_subcat = " . $subcatrow['subcat_id'];

                                    $result_topic_count = mysqli_query($conn, $sql_topic_count);
                                    $row_topic_count = mysqli_fetch_row($result_topic_count);
                                    $total_topics = $row_topic_count[0];

                                    $sql_post_count = "SELECT COUNT(post_id)
                                                        FROM posts
                                                        LEFT JOIN topics
                                                        ON posts.post_topic = topics.topic_id
                                                        WHERE topic_subcat = " . $subcatrow['subcat_id'];

                                    $result_post_count = mysqli_query($conn, $sql_post_count);
                                    $row_post_count = mysqli_fetch_row($result_post_count);
                                    $total_posts = $row_post_count[0];

                                    echo '<div class="subcat_count">';
                                        echo '<li>'.$total_topics.' topics</li>';
                                        echo '<li>'.$total_posts.' posts</li>';
                                    echo '</div>';
                                    echo '</div>';

								}
							}
						}
					}
				}
			}


include 'footer.php';
?>
