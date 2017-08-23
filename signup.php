<?php
//signup.php
include 'connect.php';
include 'header.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
	echo '<div class="sign_in_body">
            <div class="sign_in_container"><div class="sign_in_title">Register</div>
                <form method="post" action="">

                    <input id="username" placeholder="username" type="text" name="user_name" value="" aria-describedby="name-format" required aria-required="true" pattern="[A-Za-z-0-9]+">
                    <span id="name-format" class="help">alphanumeric</span>
                    <input id="password" placeholder="password" type="password" name="user_pass" required aria-required="true">
			        <input id="password_repeat" placeholder="repeat password" type="password" name="user_pass_check" required aria-required="true">
			        <span id="pass_match" class="pass_match">incorrect</span>
			        <input id="email" placeholder="email" type="email" name="user_email" required aria-required="true">
                    <input class="submit" type="submit" value="REGISTER" />

                </form>
            </div>
          </div>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
        1.  Check the data
        2.  Let the user refill the wrong fields (if necessary)
        3.  Save the data
    */
    $errors = array(); /* declare the array for later use */


    if(isset($_POST['user_name'])){
        //the user name exists

        if(!ctype_alnum($_POST['user_name']) && $_POST['user_name'] != "")
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
		if(strlen($_POST['user_name']) == "")
        {
            $errors[] = 'The username field must not be empty.';
        }
	}
	
	if(isset($_POST['user_email'])){
        //the email name exists
		      
		if(strlen($_POST['user_email']) == "")
        {
            $errors[] = 'The email field must not be empty.';
        }
	}
       
    if(isset($_POST['user_pass'])){
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
		if($_POST['user_pass'] == ""){
			$errors[] = 'The password field must not be empty.';
			}
    }



    

	$sql = "SELECT * FROM users WHERE user_name = '" . mysqli_real_escape_string($conn, $_POST['user_name']) . "'";
    $result = mysqli_query($conn, $sql) or die('error');
    if(mysqli_num_rows($result) == 1) {
      $errors[] = 'That username already exists';
    }
	
	$sql = "SELECT * FROM users WHERE user_email = '" . mysqli_real_escape_string($conn, $_POST['user_email']) . "'";
    $result = mysqli_query($conn, $sql) or die('error');
    if(mysqli_num_rows($result) == 1) {
      $errors[] = 'A user with that email already exists';
    }


    if(!empty($errors)){ /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
    
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
    }
    else{
        //the form has been posted without errors, so save it
        //notice the use of mysqli_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level, user_group)
                VALUES('" . mysqli_real_escape_string($conn, $_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysqli_real_escape_string($conn, $_POST['user_email']) . "',
                        NOW(),
                        0,
                        2)";
                         
        $result = mysqli_query($conn, $sql);
        if(!$result)
        {
            //something went wrong, display the error
            echo 'Something went wrong while registering. Please try again later.';
            //echo mysqli_error(); //debugging purposes, uncomment when needed
        }
        else
        {
            echo 'Successfully registered. Redirecting...';
            header( "refresh: 5; url=index.php" );
        }
    }
}
 
include 'footer.php';
?>