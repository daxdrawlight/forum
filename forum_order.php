<?php
include 'connect.php';

if(isset($_GET['fupid'])){

$forumID = mysqli_real_escape_string($conn, $_GET['fupid']);

 $sql = "SELECT cat_order FROM categories WHERE cat_id='$forumID'";
 $result = mysqli_query($conn, $sql);

 while($row = mysqli_fetch_assoc($result)){

    $item = $row['cat_order']+1;

    mysqli_query ($conn, "UPDATE categories SET cat_order = cat_order +1 WHERE cat_id = '$forumID'");
    mysqli_query ($conn, "UPDATE categories SET cat_order = cat_order -1 WHERE cat_order = '$item' AND cat_id != '$forumID'");

 }
}

if(isset($_GET['fdoid'])){

    $forumID = mysqli_real_escape_string($conn, $_GET['fdoid']);

    $sql = "SELECT cat_order FROM categories WHERE cat_id='$forumID'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){

        $item = $row['cat_order']-1;

        mysqli_query ($conn, "UPDATE categories SET cat_order = cat_order -1 WHERE cat_id = '$forumID'");
        mysqli_query ($conn, "UPDATE categories SET cat_order = cat_order +1 WHERE cat_order = '$item' AND cat_id != '$forumID'");

    }
}

if(isset($_GET['supid'])){

    $forumID = mysqli_real_escape_string($conn, $_GET['supid']);

    $sql = "SELECT subcat_order FROM subcategories WHERE subcat_id='$forumID'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){

        $item = $row['subcat_order']+1;

        mysqli_query ($conn, "UPDATE subcategories SET subcat_order = subcat_order +1 WHERE subcat_id = '$forumID'");
        mysqli_query ($conn, "UPDATE subcategories SET subcat_order = subcat_order -1 WHERE subcat_order = '$item' AND subcat_id != '$forumID'");

    }
}

if(isset($_GET['sdoid'])){

    $forumID = mysqli_real_escape_string($conn, $_GET['sdoid']);

    $sql = "SELECT subcat_order FROM subcategories WHERE subcat_id='$forumID'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){

        $item = $row['subcat_order']-1;

        mysqli_query ($conn, "UPDATE subcategories SET subcat_order = subcat_order -1 WHERE subcat_id = '$forumID'");
        mysqli_query ($conn, "UPDATE subcategories SET subcat_order = subcat_order +1 WHERE subcat_order = '$item' AND subcat_id != '$forumID'");

    }
}

?>