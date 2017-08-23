<?php
//create_topic.php
include 'connect.php';
include 'header.php';


if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		$sql = "SELECT
					subcategories.subcat_id,
					subcategories.subcat_name,
					subcategories.subcat_cat,
					categories.cat_id,
					categories.cat_name
				FROM
					subcategories
				LEFT JOIN categories
				ON subcategories.subcat_cat = categories.cat_id
				WHERE subcat_id = '".mysqli_real_escape_string($conn, $_GET['id'])."'
					";
		
		$result = mysqli_query($conn, $sql);
        $rs = mysqli_query($conn, $sql);
		
	while($row = mysqli_fetch_assoc($result)){
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				//there are no subcategories, so a topic can't be posted
				if($_SESSION['user_level'] == 1)
				{
					echo 'Create a subforum first, silly!';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some subforums, silly!.';
				}
			}
			else
			{
                echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';
                while($row2 = mysqli_fetch_assoc($rs)){
                    echo '<a href="category.php?id='.$row2['subcat_cat'].'">'.$row2['cat_name'].'</a> &#8594; ';
                    echo '<a href="subcategory.php?id='.$row2['subcat_id'].'">'.$row2['subcat_name'].'</a> &#8594; Post a topic';

                }
                echo'</div>';
				echo '<div class="create_topic_body"><div class="create_topic_container">
				<div class="create_topic_title">Post a <a href="subcategory.php?id='.$row['subcat_id'].'">'.$row['subcat_name'].'</a> topic in <a href="category.php?id='.$row['subcat_id'].'">'.$row['cat_name'].'</a></div>
				<form method="post" action="">
            		<input class="topic_name" placeholder="subject" type="text" name="topic_subject" required>
				
				<textarea class="topic_content" placeholder="Topic content" name="post_content"></textarea>
				<script>                		
                	CKEDITOR.replace("post_content");
            	</script>
				<input class="submit_topic" type="submit" value="CREATE" />         		
				</form></div></div>';
					
			}
		}
	}
	}
	
	
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysqli_query($conn, $query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_content,
							   topic_date,
							   topic_subcat,
							   topic_by)
				   VALUES('" . mysqli_real_escape_string($conn, $_POST['topic_subject']) . "',
				   			'" . mysqli_real_escape_string($conn, $_POST['post_content']) . "',
							   NOW(),
							   " . mysqli_real_escape_string($conn, $_GET['id']) . ",
							   " . mysqli_real_escape_string($conn, $_SESSION['user_id']) . "
							   )";
					 
			$result = mysqli_query($conn, $sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.<br /><br />' . mysqli_error($conn);
				$sql = "ROLLBACK;";
				$result = mysqli_query($conn, $sql);
			}
			else
				{
					$topicid = mysqli_insert_id($conn);
					$sql = "COMMIT;";
					$result = mysqli_query($conn, $sql);
					
					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
				}
				
			
		}
	}
}

include 'footer.php';
?>
