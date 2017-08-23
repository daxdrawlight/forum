$(document).on('click', '.cancel_topic', function(){
	var url = window.location.href;
	var hash = url.substring(url.indexOf('id'));
    var splitHash = hash.split('#');
    var getID = splitHash[0];
	var post = $(this).closest('.topic_content').attr('id');
	$(this).parents('.topic_content').load('topic_content.php?'+getID+'&post='+post, function(){
		$(this).closest('.topic_content').hide().fadeIn(800);
		});
	$('.edit_post').fadeIn('slow');
	$('.edit_topic').fadeIn('slow');
	$('.delete_post').fadeIn('slow');
	$('.delete_topic').fadeIn('slow');

        
});
