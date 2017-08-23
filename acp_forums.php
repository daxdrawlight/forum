<?php
//acp.php
include 'connect.php';
include 'header.php';


$sql= "SELECT * FROM categories ORDER BY cat_order DESC";

$result = mysqli_query($conn, $sql);

echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';

    echo '<a href="acp.php">ACP</a> &#8594; ';
    echo 'Forums';
echo'</div>';

include 'acp_nav.php';
echo '<div class="acp_forum_wrap">';
echo '<div class="forsub">Forum administration<a href="/forum/create_cat.php"><div class="add_forum">ADD FORUM</div></a><a href="/forum/create_subcat.php"><div class="add_forum">ADD SUBFORUM</div></a></div>';

while($row = mysqli_fetch_assoc($result))
{
 echo '<div class="oneforum">';
    echo '<div class ="acp_forums_title">';
        echo '<div id="'.$row['cat_id'].'" class ="acp_forums_title_data">';
            echo '<a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a>
            <div class="acp_forum_settings">
                <button class="forum_up">&#65514;</button>
                <button class="forum_down">&#65516;</button>
                <form class="inline_form" action="forum_options.php">
                    <button name="id" type="hidden" value="'.$row['cat_id'].'" class="forum_options">&#9998;</button>
                </form>
                <button class="delete_forum">&#10005;</button>
            </div>';
        echo '</div>';
    echo '</div>';

    $subcatsql = "SELECT * FROM subcategories WHERE subcat_cat = '" . $row['cat_id'] . "' ORDER BY subcat_order DESC";
    $subcatresult = mysqli_query($conn, $subcatsql);

    while($subcatrow = mysqli_fetch_assoc($subcatresult))
    {
        echo '<div class ="acp_forums_row">';
            echo '<div id="'.$subcatrow['subcat_id'].'" class="acp_forums_row_data">';
                echo '<img src="images/subcat-default.png"></img><a href="subcategory.php?id=' . $subcatrow['subcat_id'] . '">' . $subcatrow['subcat_name'] . '</a>
                <div class="acp_forum_settings">
                <button class="subforum_up">&#65514;</button>
                <button class="subforum_down">&#65516;</button>
                <form class="inline_form" action="subforum_options.php">
                    <button name="id" type="hidden" value="'.$subcatrow['subcat_id'].'" class="forum_options">&#9998;</button>
                </form>
                <button class="delete_subforum">&#10005;</button>
                </div>';
            echo '</div>';
        echo '</div>';
        ;
    }
 echo '</div>';
}
echo '</div>';
include 'footer.php';
?>