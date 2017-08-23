$(document).on('click', '.edit_post', function(){
		var url = window.location.href;
		var hash = url.substring(url.indexOf('id'));
        var splitHash = hash.split('#');
        var getID = splitHash[0];
		var post = $(this).siblings('.post_content').attr('id');
		$(this).siblings('.post_content').load('edit_post.php?'+getID+'&post='+post, function(){
			$(this).closest('.post_content').hide().fadeIn(800);
			});
		
		$('.edit_post').fadeOut('slow');
		$('.edit_topic').fadeOut('slow');
		$('.delete_post').fadeOut('slow');
		$('.delete_topic').fadeOut('slow');
		});
				

