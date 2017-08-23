$(document).on('click', '.forum_up', function(){
    var forumID = $(this).closest('.acp_forums_title_data').attr('id');
    $.ajax({
        type: "POST",
        url: 'forum_order.php?fupid='+forumID,
        success: function(){
            location.reload();
        }

    });
});

$(document).on('click', '.forum_down', function(){
    var forumID = $(this).closest('.acp_forums_title_data').attr('id');
    $.ajax({
        type: "POST",
        url: 'forum_order.php?fdoid='+forumID,
        success: function(){
            location.reload();
        }

    });
});

$(document).on('click', '.subforum_up', function(){
    var forumID = $(this).closest('.acp_forums_row_data').attr('id');
    $.ajax({
        type: "POST",
        url: 'forum_order.php?supid='+forumID,
        success: function(){
            location.reload();
        }

    });
});

$(document).on('click', '.subforum_down', function(){
    var forumID = $(this).closest('.acp_forums_row_data').attr('id');
    $.ajax({
        type: "POST",
        url: 'forum_order.php?sdoid='+forumID,
        success: function(){
            location.reload();
        }

    });
});