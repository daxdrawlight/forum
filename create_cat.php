<?php
//create_cat.php
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
		echo '<div class="sign_in_body"><div class="sign_in_container"><div class="sign_in_title">Create a category</div><form method="post" action="">
            <input class="cat_name" placeholder="name" type="text" name="cat_name" />
            <textarea class="cat_description" placeholder="description" name="cat_description"></textarea>
            <input class="submit" type="submit" value="CREATE" />
         </form></div></div>';
	}
	else
	{
		$sql = "INSERT INTO categories(cat_name, cat_description)
		        VALUES('" . mysqli_real_escape_string($conn, $_POST['cat_name']) . "',
				 '" . mysqli_real_escape_string($conn, $_POST['cat_description']) . "')";
		$result = mysqli_query($conn, $sql);
        $cat_id = mysqli_insert_id($conn);

        $gsql = "SELECT * FROM groups";
        $gresult = mysqli_query($conn, $gsql);

        while($row = mysqli_fetch_assoc($gresult)){
            $gid = $row['group_id'];
            $read_forum = $row['group_read_board'];
            $post_replies = $row['group_post_replies'];
            $post_topics = $row['group_post_topics'];
            mysqli_query($conn, "INSERT INTO cat_perms (group_id, cat_id, read_forum, post_replies, post_topics) VALUES('$gid', '$cat_id', '$read_forum', '$post_replies', '$post_topics')") or die(mysqli_error($conn));
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
