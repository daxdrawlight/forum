$(document).on('click', '.reply_topic_quote', function(){
    var url = window.location.href;
    var hash = url.substring(url.indexOf('id'));
    var splitHash = hash.split('#');
    var getID = splitHash[0];
            $('.reply_content').slideDown(800, function(){
            $('html, body').animate({
                scrollTop: $("#reply_content").offset().top
            });
            $('.reply_form_wrap').load('reply_topic_quote_content.php?'+getID);

            // window.location.hash = '#reply_content';

        });
    });

$(document).on('click', '.reply_post_quote', function(){
    var url = window.location.href;
    var hash = url.substring(url.indexOf('id'));
    var splitHash = hash.split('#');
    var getID = splitHash[0];
    var post = $(this).siblings('.post_content').attr('id');
    $('.reply_content').slideDown(800, function(){
        $('html, body').animate({
            scrollTop: $("#reply_content").offset().top
        });
        $('.reply_form_wrap').load('reply_post_quote_content.php?'+getID+'&post='+post);

        // window.location.hash = '#reply_content';

    });
});
