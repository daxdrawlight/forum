<?php
include 'connect.php';
include 'header.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM users LEFT JOIN groups ON users.user_group = groups.group_id WHERE user_id = '$id'";
$result = mysqli_query($conn, $sql);

$count_topic = "SELECT topic_id FROM topics WHERE topic_by = '$id'";
$ctr = mysqli_query($conn, $count_topic);
$topic_row_cnt = mysqli_num_rows($ctr);

$count_post = "SELECT post_id FROM posts WHERE post_by = '$id'";
$cpr = mysqli_query($conn, $count_post);
$post_row_cnt = mysqli_num_rows($cpr);

while($row = mysqli_fetch_assoc($result)){

echo '<div class="breadcrumbs"><a href="index.php">Home</a> &#8594; ';
echo '<a href="user.php">User</a> &#8594; ';
echo ''.$row['user_name'].'';
echo '</div>';

echo '<div class="user_body">';
    echo '<div class="user_container">';
        echo '<div class="profile_info">';
            echo '<div class="user_avatar">';
                if($row['user_pic']){
                    echo '<div class="user_image" style="background-image:url('.$row['user_pic'].')"></div>';
                }
                else
                {
                    echo '<img src="images/nopic.png" />';
                }

        echo '</div>';
            echo '<ul>';
                echo '<li id="profile_name">'.$row['user_name'].'</li>';
                echo '<li id="profile_group">'.$row['group_name'].'</li>';
                echo '<li id="profile_title">Guardian of Light</li>';
            echo '</ul>';
        echo '</div>';
        echo '<div class="post_info">';
            echo '<ul>';
                echo '<li>Topics: '.$topic_row_cnt.'</li>';
                echo '<li>Posts: '.$post_row_cnt.'</li>';
                echo '<li>Joined: '.date('d.m.Y',strtotime($row['user_date'])).'</li>';
            echo '</ul>';
            echo '</div>';
        echo '<div class="email_update">';
            echo '<div id="forsub_mar">Change email</div>';
                echo '<form class="email_form" action="user_commit.php?id='.$id.'">';
                echo '<input id="email" name="email" type="email" value="'.$row['user_email'].'" required/>';
                echo '<input class="submit_avatar" type="submit" value="UPDATE" />	';
        echo '</form>';
        echo '</div>';
        echo '<div class="avatar_upload">';
            echo '<form class="upload_form" enctype="multipart/form-data" method="post" action="upload.php?id='.$id.'">
                        <div class="img_up_row">
                            <label for="fileToUpload">Upload a profile picture (max 2MB, .jpg .jpeg .gif .png only)</label><br />
                            <input type="file" name="fileToUpload" id="fileToUpload"/>
                        </div>
                        <div class="img_up_row">
                            <input class="submit_avatar"type="submit" value="UPLOAD" />
                        </div>
                  </form>';
        echo '</div>';

        echo '<div class="signature_update">';
            echo '<div id="forsub_mar">Compose your signature</div>';
            echo '<form class="signature_form" action="user_commit.php?id='.$id.'">';
                echo '<textarea id="signature_txt" name="signature">'.$row['user_signature'].'</textarea>';
                echo '<script>CKEDITOR.replace("signature_txt");</script>';
                echo '<input class="submit_avatar" type="submit" value="UPDATE" />	';
            echo '</form>';
        echo '</div>';





        echo '<div>';
        echo '</div>';

    echo'</div>';
echo'</div>';
}


include 'footer.php';
?>