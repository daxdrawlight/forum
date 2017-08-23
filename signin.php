<?php
//signin.php

include 'connect.php';
include 'header.php';
 

 
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{

		echo '<div class="sign_in_body"><div class="sign_in_container"><div class="sign_in_title">Sign in</div>
              <form class="signin_form" method="post">
                <input id="username" placeholder="username" type="text" name="user_name" required>
                <input id="password" placeholder="password" type="password" name="user_pass" required>
                <div class="incorrect">The email or password you entered is incorrect.</div>
                <input id="sign_in" class="submit" type="submit" value="SIGN IN" />
              </form>
              </div>
              </div>';






}
 
include 'footer.php';
?>