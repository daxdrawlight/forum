$(document).on('submit', '.forum_settings_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('Forum settings updated').fadeIn().delay(3000).fadeOut(function(){
             //   window.location.reload();
            });
        }
});
});

$(document).on('submit', '.forum_perms_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('Forum permissions updated').fadeIn().delay(3000).fadeOut(function(){
                //   window.location.reload();
            });
        }
    });
});

$(document).on('submit', '.add_group_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('Group added').fadeIn().delay(3000).fadeOut(function(){
                window.location.replace('acp_groups.php');
            });
        }
    });
});

$(document).on('submit', '.edit_group_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('Group settings updated').fadeIn().delay(3000).fadeOut(function(){
              window.location.replace('acp_groups.php');
            });
        }
    });
});

$(document).on('submit', '.email_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('User email updated').fadeIn().delay(3000).fadeOut();
        }
    });
});

$(document).on('submit', '.signature_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('User signature updated').fadeIn().delay(3000).fadeOut();
        }
    });
});


$(document).on('submit', '.subforum_settings_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('Subforum settings updated').fadeIn().delay(3000).fadeOut(function(){
                //   window.location.reload();
            });
        }
    });
});

$(document).on('submit', '.subforum_perms_form', function(e){
    e.preventDefault();
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success: function(){
            $('.alert').text('Subforum permissions updated').fadeIn().delay(3000).fadeOut(function(){
                //   window.location.reload();
            });
        }
    });
});

$(document).on('click', '.delete_forum', function(e){
    e.preventDefault();
    var forum = $(this).closest('.acp_forums_title_data')
    var forumID = forum.attr('id');
    var firm = confirm("Are you sure you want to DELETE this FORUM?");
    if (firm == true){
        $.ajax({
            type     : "POST",
            url      : 'delete_cat.php?id='+forumID,
            success: function(){
                $('.alert').text('Forum deleted').fadeIn().delay(3000).fadeOut();
                $(forum).closest('.oneforum').hide();
            }
        });
    }
});

$(document).on('click', '.delete_subforum', function(e){
    e.preventDefault();
    var forum = $(this).closest('.acp_forums_row_data');
    var forumID = forum.attr('id');
    var firm = confirm("Are you sure you want to DELETE this SUBFORUM?");
    if (firm == true){
        $.ajax({
            type     : "POST",
            url      : 'delete_subcat.php?id='+forumID,
            success: function(){
                $('.alert').text('Subforum deleted').fadeIn().delay(3000).fadeOut();
                $(forum).closest('.acp_forums_row').hide();
            }
        });
    }
});

function searchq(){
    var searchTxt = $("input[name='search']").val();
    $.post("user_search.php", {searchVal: searchTxt}, function(output){
        $('#output').html(output);
    });
}


<rect x="18.5" y="219.7" class="st4" width="10" height="8.7" onmouseover="" style="cursor: pointer; fill: rgb(0, 255, 204)"/>
<text transform="matrix(1 0 0 1 23.096 222.5183)">
	<tspan x="0" y="0" class="st6 st7">236.53 V</tspan>
	<tspan x="0" y="1.2" class="st6 st7">0.1571 A</tspan>
	<tspan x="-0.4" y="2.4" class="st6 st7">0.0326 kW</tspan>
	<tspan x="0.9" y="3.6" class="st6 st7">42 h</tspan>
</text>
