$(document).on('click', '.delete_post', function(){
		var post = $(this).siblings('.post_content').attr('id');
		var thisButton = $(this);
		var firm = confirm("Are you sure you want to DELETE this POST?");
		if (firm == true){	
		$.ajax({
		   type: "POST",
		   url: 'delete_post.php?id='+post,
		   success: function(){
               $('.alert').text('Post deleted').fadeIn().delay(3000).fadeOut();
		$(thisButton).parents('.post_container').slideUp(800);
		   }
		});
		}
		});
			