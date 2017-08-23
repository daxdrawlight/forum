<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>PHP-MySQL forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="post_edit.js"></script>
    <script src="save_post_edit.js"></script>
    <script src="cancel_post_edit.js"></script>
    <script src="post_delete.js"></script>
    <script src="topic_edit.js"></script>
    <script src="save_topic_edit.js"></script>
    <script src="cancel_topic_edit.js"></script>
    <script src="topic_delete.js"></script>
    <script src="submit_post.js"></script>
    <script src="active_page.js"></script>
    <script src="reply_toggle.js"></script>
    <script src="password.js"></script>
    <script src="signin.js"></script>
    <script src="topic_moderation.js"></script>
    <script src="reply_with_quote.js"></script>
    <script src="forum_order.js"></script>
    <script src="acp.js"></script>
    <script>
    $(document).click(function(e) {
    	var target = e.target;
    	if ($(target).is('.userbar_image') || $(target).is('.userbar_img')) {
        	$('.tooltip').fadeToggle();
		}
		else if($(target).parents().is('.tip')){			
		}
		else{
			$('.tooltip').fadeOut();			
		}
    	
	});
    </script>

</head>
<?php

include 'session.php';

echo '<body>

    <div id="wrapper">
    <div class="alert"></div>
    <div class="menu">
    	<a class="logo" href="index.php">SWORDINARY</a>
        <a class="item" href="index.php">HOME</a>';
       if($_SESSION['user_level'] == 1){
       echo '<a class="item" href="acp.php">Control Panel</a>';
         }
    

 echo '<div class="userbar">';
    	
		if($_SESSION['signed_in'])
		{
			echo '<div class="user_name">'. htmlentities($_SESSION['user_name']) .'</div>
				<div class="tip">';
				
				if(!$_SESSION['user_pic']){
					echo '<img class="userbar_img" src="images/nopic.png"></img>';
					}
				else{
                    echo '<div class="userbar_image" style="background-image:url('.$_SESSION['user_pic'].')"></div>';
				}
					echo '<div class="tooltip">
						<div class="tooltip_signout"><a id="sign_out" href="signout.php">Sign out</a></div>
						<div class="my_profile"><a href ="user.php?id='.$_SESSION['user_id'].'">Profile</a></div>
						
					</div>
				</div>';
		}
		else
		{
			echo '<a href="signin.php">Sign in</a> | <a href="signup.php">Register</a>';
		}
		?>
	</div>
    </div>
    
	<div id="content">
    	<div id="pad">