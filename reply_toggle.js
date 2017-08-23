$(document).ready(function(){
    $('.reply_content').hide();
    $('.reply_to_topic_btn').click(function() {
        $('.reply_content').slideToggle(800, function(){
            $('html, body').animate({
                scrollTop: $("#reply_content").offset().top
            });

           // window.location.hash = '#reply_content';

        });
    });
});