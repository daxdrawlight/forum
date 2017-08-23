<?php
//forum_options.php
include 'connect.php';
include 'header.php';

    echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';
    echo '<a href="acp.php">ACP</a> &#8594; ';
    echo '<a href="acp_groups.php">Groups</a> &#8594; ';
    echo 'Add group';
    echo '</div>';

    include 'acp_nav.php';
    echo '<div class="acp_forum_wrap">';
    echo '<div class="forsub">Add group</div>';

    echo '<div class="forum_options_body">';
    echo '<form class="add_group_form" action="add_group_commit.php">';
    echo '<div class="forum_options_container">';
    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Group title:
                </div>
                <div class="forum_td">
                    <input class="forum_options_input" type="text" name="group_title" value="" required/>
                </div>
           </div>';
    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    User title:
                </div>
                <div class="forum_td">
                    <input class="forum_options_input" type="text" name="user_title" value="" />
                </div>
           </div>';


    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Allow moderator privileges:
                </div>
                <div class="forum_td">';
                echo'<input type="radio" name="moderator_priv" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="moderator_priv" checked value="0"/> No';

                echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow moderator privileges to users in this group
                </div>
    </div>';

    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Allow moderators to edit user profiles:
                </div>
                <div class="forum_td">';
    echo'<input type="radio" name="moderator_edit" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="moderator_edit" checked value="0"/> No';

    echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow moderators to edit user profiles
                </div>
    </div>';

    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Allow moderators to ban users:
                </div>
                <div class="forum_td">';
    echo'<input type="radio" name="moderator_ban" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="moderator_ban" checked value="0"/> No';

    echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow moderators to ban users
                </div>
    </div>';

    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Read board:
                </div>
                <div class="forum_td">';
    echo'<input type="radio" name="read_board" checked value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="read_board"  value="0"/> No';

    echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to read the board
                </div>
    </div>';

    echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Post replies
                </div>
                <div class="forum_td">';
    echo'<input type="radio" name="post_replies" checked value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="post_replies"  value="0"/> No';

    echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to reply to topics
                </div>
    </div>';

echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Post topics
                </div>
                <div class="forum_td">';
echo'<input type="radio" name="post_topics" checked value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="post_topics"  value="0"/> No';

echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to post new topics
                </div>
    </div>';

echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Edit posts
                </div>
                <div class="forum_td">';
echo'<input type="radio" name="edit_posts" checked value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="edit_posts"  value="0"/> No';

echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to edit their own posts
                </div>
    </div>';

echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Delete posts
                </div>
                <div class="forum_td">';
echo'<input type="radio" name="delete_posts" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="delete_posts" checked value="0"/> No';

echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to delete their own posts
                </div>
    </div>';

echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Delete topics
                </div>
                <div class="forum_td">';
echo'<input type="radio" name="delete_topics" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="delete_topics" checked value="0"/> No';

echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to delete their own topics
                </div>
    </div>';

echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Set own user title
                </div>
                <div class="forum_td">';
echo'<input type="radio" name="set_title" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="set_title" checked value="0"/> No';

echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to set their own user titles
                </div>
    </div>';

echo '<div class="forum_tr">
                <div id="forum_options_tags" class="forum_td">
                    Use search
                </div>
                <div class="forum_td">';
echo'<input type="radio" name="use_search" checked="checked" value="1"/> Yes &nbsp&nbsp&nbsp<input type="radio" name="use_search"  value="0"/> No';

echo'</div>
                <div id="forum_options_desc" class="forum_td">
                    &nbsp&nbsp&nbsp &#8592; allow users to use the search feature
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

include 'footer.php';
?>