<?php
//acp_users.php
include 'connect.php';
include 'header.php';

$sql = mysqli_query($conn, "SELECT user_id FROM users") or die("There was an error");
$count = mysqli_num_rows($sql);

echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';
echo '<a href="acp.php">ACP</a> &#8594; ';
echo 'Users';
echo'</div>';

include 'acp_nav.php';

echo '<div class="acp_forum_wrap">';
echo '<div id="forsub_mar" class="forsub">Users
        <form class="user_search_form" action="acp_users.php" method="post">
            <input class="forum_options_input" type="text" name="search" placeholder="Search for users..." onkeydown="searchq();"/>
            <button class="search_button" type="submit">SEARCH</button></div>';


echo '<div id="output">';

echo '</div>';


echo '</div>';


?>