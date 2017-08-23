$(document).ready(function(){
	$('.edit_topic').click(function(){
		var url = window.location.href;
		var hash = url.substring(url.indexOf('id'));
        var splitHash = hash.split('#');
        var getID = splitHash[0];
		$(this).siblings('.topic_content').load('edit_topic.php?'+getID, function(){
			$(this).closest('.topic_content').hide().fadeIn(800);
			});
		$('.edit_post').fadeOut('slow');
		$('.edit_topic').fadeOut('slow');
		$('.delete_post').fadeOut('slow');
		$('.delete_topic').fadeOut('slow');
		});
		});		

