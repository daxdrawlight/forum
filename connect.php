<?php
//connect.php
$server = 'localhost';
$username   = 'deni';
$password   = '1234';
$database   = 'forum';
 
$conn = mysqli_connect($server, $username,  $password, $database) or die('There was an error');

if (mysqli_connect_errno()) {
  trigger_error('Database connection failed: '  . mysqli_connect_error(), E_USER_ERROR);
}
?>