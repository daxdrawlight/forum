//topic_moderation.js

//------------------------------------------------------------------------   topic moderation button
$(document).on('click', '.topic_moderation_btn', function() {
   $('.topic_moderation_content').animate({width: 'toggle'});
});


$(document).ready(function(){

//------------------------------------------------------------------------   indexes

    var url = window.location.href;
    var hash = url.substring(url.indexOf('id'));
    var splitHash = hash.split('#');
    var getID = splitHash[0];
    var splitID = getID.split('&');
    var justID = splitID[0];

//------------------------------------------------------------------------   topic moderation - edit button

    $('#mod_edit').click(function(){
        $('.topic_content').load('edit_topic.php?'+getID, function(){
            $('.topic_content').hide().fadeIn(800);
        });
        $('.edit_post').fadeOut('slow');
        $('.edit_topic').fadeOut('slow');
        $('.delete_post').fadeOut('slow');
        $('.delete_topic').fadeOut('slow');
    });

//------------------------------------------------------------------------   topic moderation - delete button

    $('#mod_delete').click(function(){
        var firm = confirm("Are you sure you want to DELETE this TOPIC?");
        if (firm == true){
            $.ajax({
                type: "POST",
                url: 'delete_topic.php?'+getID,
                success: function(){
                    $('.post_container').hide();
                    $('.reply_container').hide();
                    $('.pagination').hide();
                    $('.alert').text('Topic deleted').fadeIn().delay(3000).fadeOut();
                }

            });
        }

    });

//------------------------------------------------------------------------   topic moderation - pin button

    $(document).on('click','#mod_pin', function(){
        $.ajax({
            type: "POST",
            url: 'pin_topic.php?'+getID+'&pin=1',
            success: function(){
                $('.alert').text('Topic pinned').fadeIn().delay(3000).fadeOut();
                $('.unpinned').addClass('pinned').fadeIn();
                $('#mod_pin').attr('id', 'mod_unpin').html('Unpin');
                $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
            }
        });
    });

//------------------------------------------------------------------------   topic moderation - unpin button

    $(document).on('click','#mod_unpin', function(){
        $.ajax({
            type: "POST",
            url: 'pin_topic.php?'+getID+'&pin=0',
            success: function(){
                $('.alert').text('Topic unpinned').fadeIn().delay(3000).fadeOut();
                $('.pinned').addClass('unpinned').fadeOut();
                $('#mod_unpin').attr('id', 'mod_pin').html('Pin');
                $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
            }
        });
    });

//------------------------------------------------------------------------   topic moderation - hide button

    $(document).on('click','#mod_hide', function(){
        $.ajax({
            type: "POST",
            url: 'hide_topic.php?'+getID+'&hide=1',
            success: function(){
                $('.alert').text('Topic hidden').fadeIn().delay(3000).fadeOut();
                $('.unhidden').addClass('hidden').fadeIn();
                $('#mod_hide').attr('id', 'mod_show').html('Unhide');
                $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
            }
        });
    });

//------------------------------------------------------------------------   topic moderation - unhide button

    $(document).on('click','#mod_show', function(){
        $.ajax({
            type: "POST",
            url: 'hide_topic.php?'+getID+'&hide=0',
            success: function(){
                $('.alert').text('Topic unhidden').fadeIn().delay(3000).fadeOut();
                $('.hidden').addClass('unhidden').fadeOut();
                $('#mod_show').attr('id', 'mod_hide').html('Hide');
                $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
            }
        });
    });

//------------------------------------------------------------------------   topic moderation - lock button

    $(document).on('click','#mod_lock', function(){
        $.ajax({
            type: "POST",
            url: 'lock_topic.php?'+getID+'&lock=1',
            success: function(){
                $('.alert').text('Topic locked').fadeIn().delay(3000).fadeOut();
                $('.unlocked').addClass('locked').fadeIn();
                $('#mod_lock').attr('id', 'mod_unlock').html('Unlock');
                $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
            }
        });
    });

//------------------------------------------------------------------------   topic moderation - unlock button

    $(document).on('click','#mod_unlock', function(){
        $.ajax({
            type: "POST",
            url: 'lock_topic.php?'+getID+'&hide=0',
            success: function(){
                $('.alert').text('Topic unlocked').fadeIn().delay(3000).fadeOut();
                $('.locked').addClass('unlocked').fadeOut();
                $('#mod_unlock').attr('id', 'mod_lock').html('Lock');
                $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
            }
        });
    });

//------------------------------------------------------------------------   topic moderation - merge button

    $(document).on('click', '#mod_merge', function(){
        $('.alert').fadeIn().load('merge_topic.php?'+justID);
        $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
    });

//------------------------------------------------------------------------   topic moderation - merge form

    $(document).on('click', '.merge_btn', function(e){
        e.preventDefault();
        var mergeURL = $('#merge_url').val();
        var removeLocation = mergeURL.split('id=');
        var removePage = removeLocation[1].split('&');
        var removeHash = removePage[0].split('#');
        var mergeID = removeHash[0];
        $.ajax({
            type: "POST",
            url: 'merge_commit.php?'+justID+'&topic='+mergeID,
            success: function(){
            window.location.replace('topic.php?id='+mergeID);

            }
        });
    });

//------------------------------------------------------------------------   topic moderation - move button

    $(document).on('click', '#mod_move', function(){
        $('.alert').fadeIn().load('move_topic.php?'+justID);
        $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
    });

//------------------------------------------------------------------------   topic moderation - move form

    $(document).on('click', '.move_btn', function(e){
        e.preventDefault();
        var moveURL = $('#move_url').val();
        var removeLocation = moveURL.split('id=');
        var removePage = removeLocation[1].split('&');
        var removeHash = removePage[0].split('#');
        var moveID = removeHash[0];
        $.ajax({
            type: "POST",
            url: 'move_commit.php?'+justID+'&subforum='+moveID,
            success: function(){
                $('.alert').text('Topic moved').delay(1500).fadeOut(function(){
                    location.reload();
                });


            }
        });
    });

//------------------------------------------------------------------------   topic moderation - edit title

    $(document).on('click', '#mod_title', function(){
        $('.topic_subject').load('topic_title.php?'+justID);
        $('.topic_moderation_content').delay(500).animate({width: 'toggle'});
    });

    $(document).on('click', '.save_subject_btn', function(e){
        e.preventDefault();
        var subject = $('#change_topic_subject').val()
        $.ajax({
            type: "POST",
            url: 'save_subject_edit.php?'+justID+'&subject='+subject,
            success: function(){
                $('.alert').text('Title changed').fadeIn().delay(3000).fadeOut();
                $('.topic_subject').html('<a href="'+url+'">'+subject+'</a>');

            }
        });
    });

});