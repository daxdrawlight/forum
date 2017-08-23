<?php
//forum_options.php
include 'connect.php';
include 'header.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM subcategories where subcat_id = '$id'";
$result = mysqli_query($conn, $sql);

$fsql = "SELECT * FROM categories LEFT JOIN subcategories ON categories.cat_id = subcategories.subcat_cat and subcategories.subcat_id = '$id'";
$fresult = mysqli_query($conn, $fsql);



while($row = mysqli_fetch_assoc($result)){

    echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';
    echo '<a href="acp.php">ACP</a> &#8594; ';
    echo '<a href="acp_forums.php">Forums</a> &#8594; ';
    echo ''.$row['subcat_name'].' settings';
    echo '</div>';

    include 'acp_nav.php';
    echo '<div class="acp_forum_wrap">';
    echo '<div class="forsub">'.$row['subcat_name'].' - settings</div>';

    echo '<div class="forum_options_body">';
    echo '<form class="subforum_settings_form" action="subforum_settings_commit.php?id='. mysqli_real_escape_string($conn, $row['subcat_id']) .'">';
    echo '<div class="forum_options_container">';
    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Subforum name:
                </div>
                <div class="forum_td">
                    <input class="forum_options_input" type="text" name="forum_name" value="'.$row['subcat_name'].'" required/>
                </div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; change the forum name
                </div>
              </div>';
    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Description:
                </div>
                <div id="forum_td_desc" class="forum_td">
                    <textarea name="forum_description">'.$row['subcat_name'].'</textarea>
                </div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; change the forum description
                </div>
              </div>';

    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Subforum hidden:
                </div>
                <div class="forum_td">';
    if($row['subcat_status_hidden'] == 1){
        echo'<input type="radio" name="forum_hidden" checked value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="forum_hidden" value="0"/> No';
    }
    else{
        echo'<input type="radio" name="forum_hidden" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="forum_hidden" checked value="0"/> No';
    }
    echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; hide/show forum
                </div>
              </div>';
    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Subforum category:
                </div>
                <div class="forum_td">';
                    echo '<select name="cat_id">';
                    while($frow = mysqli_fetch_assoc($fresult)){
                        if($frow['subcat_id'] == $id){$selected = 'selected ="selected"';} else{$selected = '';}
                      echo '<option value="'.$frow['cat_id'].'" '.$selected.'>'.$frow['cat_name'].'</option>';
                    }

                    echo '</select>';

    echo'</div>
                <div id="forum_options_desc" class="forum_td">

                </div>
              </div>';
    echo '<div id="reset_submit" class="forum_tr">
                <div class="forum_td">
                </div>
                <div class="forum_td">

                </div>
                <div class="forum_td">
                    <button type="submit" class="submit_forum_options">SUBMIT</button>
                </div>
              </div>';


    echo '</div>';
    echo '</form>';
    echo '</div>';


    $groups_sql = "SELECT groups.group_name, groups.group_id, subcat_perms.*
                   FROM groups
                   LEFT JOIN subcat_perms
                   ON groups.group_id = subcat_perms.group_id
                   WHERE subcat_perms.subcat_id ='$id'
                   ORDER by groups.group_id ASC";

    $groups_result = mysqli_query($conn, $groups_sql) or die(mysqli_error($conn));


    echo '<div class="forsub">'.$row['subcat_name'].' - permissions</div>';

    echo '<div class="forum_options_body">';
    echo '<form class="subforum_perms_form" action="subforum_perms_commit.php?id='.$id.'">';
    echo '<div class="forum_options_container">';
    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">

                </div>
                <div id="forum_td_perm" class="forum_td">
                    Read forum
                </div>
                <div id="forum_td_perm" class="forum_td">
                    Post replies
                </div>
                <div id="forum_td_perm" class="forum_td">
                    Post topics
                </div>
            </div>';
    while($grow = mysqli_fetch_assoc($groups_result)){
        echo '<div class="forum_tr">';

        echo'<div id="forum_options_tags" class="forum_td">'.$grow['group_name'].'</div>';

        echo'<div id="forum_td_perm" class="forum_td">';
        echo'<input type="checkbox" value="1" name="read_forum['.$grow['group_id'].']"';
        if($grow['read_forum'] == 1){
            echo'checked="checked"';
        }
        echo '/>';
        echo'</div>';

        echo'<div id="forum_td_perm" class="forum_td">';
        echo'<input type="checkbox" value="1" name="reply_forum['.$grow['group_id'].']"';
        if($grow['post_replies'] == 1){
            echo'checked="checked"';
        }
        echo '/>';
        echo'</div>';

        echo'<div id="forum_td_perm" class="forum_td">';
        echo'<input type="checkbox" value="1" name="post_forum['.$grow['group_id'].']"';
        if($grow['post_topics'] == 1){
            echo'checked="checked"';
        }
        echo '/>';
        echo'</div>';

        echo'</div>';

    }

    echo '<div id="reset_submit" class="forum_tr">
            <div class="forum_td"></div>
            <div class="forum_td"></div>
            <div class="forum_td"><button class="save_forum_permissions">SAVE</button></div>
          </div>';
    echo '</form>';

    echo '</div>';
    echo '</div>';
    echo'</div>';
}

include 'footer.php';
?>