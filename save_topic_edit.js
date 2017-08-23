$(document).on('submit', '.topicform', function(e){
    e.preventDefault();
	var url = window.location.href;
	var hash = url.substring(url.indexOf('id'));
    var splitHash = hash.split('#');
    var getID = splitHash[0];
	$.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
		success  : function(){
            $('.alert').text('Topic edit saved').fadeIn().delay(3000).fadeOut();
		$('.topicform').closest('.topic_content').load('topic_content.php?'+getID, function(){
		$(this).closest('.topic_content').hide().fadeIn(800);
		});
		$('.edit_post').fadeIn('slow');
		$('.edit_topic').fadeIn('slow');
		$('.delete_post').fadeIn('slow');
		$('.delete_topic').fadeIn('slow');
			}
        
    });

});
