<?php

include 'connect.php';
include 'session.php';


    $sql = "SELECT
                    user_id,
                    user_name,
                    user_level,
                    user_pic
            FROM
                    users
            WHERE
                    user_name = '" . mysqli_real_escape_string($conn, $_POST['username']) . "'
            AND
                    user_pass = '" . sha1($_POST['password']) . "'";

    $result = mysqli_query($conn, $sql);

    if(!$result)
    {

        echo 'Error';

    }
    else
    {

        if(mysqli_num_rows($result) == 0)
        {
            echo 'Fail';
        }
        else
        {
            echo 'Success';
        $_SESSION['signed_in'] = true;

        while($row = mysqli_fetch_assoc($result))
            {
            $_SESSION['user_id']    = $row['user_id'];
            $_SESSION['user_name']  = $row['user_name'];
            $_SESSION['user_level'] = $row['user_level'];
            $_SESSION['user_pic'] = $row['user_pic'];
            }
        }}


?>

