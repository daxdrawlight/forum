<?php
//create_subcat.php
include 'connect.php';
include 'header.php';

if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		$sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					categories";
		
		$result = mysqli_query($conn, $sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				//there are no categories, so a subcategory can't be created
				if($_SESSION['user_level'] == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can create a subcategory, you must wait for an admin to create some categories.';
				}
			}
		}
		//the form hasn't been posted yet, display it
		echo '<div class="sign_in_body"><div class="sign_in_container"><div class="sign_in_title">Create a subcategory</div><form method="post" action="">
            <input class="cat_name" placeholder="name" type="text" name="subcat_name" />
            <textarea class="cat_description" placeholder="description" name="subcat_description"></textarea>
            
			<select class="cat_name" name="subcat_cat">';
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select><input class="submit" type="submit" value="CREATE" />
         	</form></div></div>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO subcategories(subcat_name, subcat_description, subcat_cat)
		   VALUES('" . mysqli_real_escape_string($conn, $_POST['subcat_name']) . "',
				 '" . mysqli_real_escape_string($conn, $_POST['subcat_description']) . "',
				 '" . mysqli_real_escape_string($conn, $_POST['subcat_cat']) . "')";

		$result = mysqli_query($conn, $sql);
        $subcat_id = mysqli_insert_id($conn);

        $gsql = "SELECT * FROM groups";
        $gresult = mysqli_query($conn, $gsql);

        while($row = mysqli_fetch_assoc($gresult)){
            $gid = $row['group_id'];
            $read_forum = $row['group_read_board'];
            $post_replies = $row['group_post_replies'];
            $post_topics = $row['group_post_topics'];
            mysqli_query($conn, "INSERT INTO subcat_perms (group_id, subcat_id, read_forum, post_replies, post_topics) VALUES('$gid', '$subcat_id', '$read_forum', '$post_replies', '$post_topics')") or die(mysqli_error($conn));
        }

        if(!$result || !$gresult)
        {

            echo 'Error' . mysqli_error($conn);
        }
        else
        {
            header("Location: acp_forums.php");
            die();
        }
	}
}

include 'footer.php';
?>