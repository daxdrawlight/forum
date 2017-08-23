<?php
//acp.php
include 'connect.php';
include 'header.php';


$sql= "SELECT * FROM groups";

$result = mysqli_query($conn, $sql);

echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';

echo '<a href="acp.php">ACP</a> &#8594; ';
echo 'Groups';
echo'</div>';

include 'acp_nav.php';
echo '<div class="acp_forum_wrap">';
echo '<div id="forsub_mar" class="forsub">Group administration<a href="/forum/add_group.php"><div class="add_forum">ADD GROUP</div></a></div>';

while($row = mysqli_fetch_assoc($result))
{
    echo '<div class ="acp_forums_row">';
    echo '<div id="'.$row['group_id'].'" class ="acp_forums_row_data">';
    echo ''. $row['group_name'] . '
            <div class="acp_forum_settings">
                <form class="inline_form" action="edit_group.php">
                    <button name="id" type="hidden" value="'.$row['group_id'].'" class="group_options">&#9998;</button>
                </form>
                <button class="delete_group">&#10005;</button>
            </div>';
    echo '</div>';
    echo '</div>';

}
echo '</div>';
include 'footer.php';
?>