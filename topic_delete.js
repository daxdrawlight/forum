$(document).ready(function(){
	$('.delete_topic').click(function(){
		var topic = $(this).siblings('.topic_content').attr('id');
		var firm = confirm("Are you sure you want to DELETE this TOPIC?");
		if (firm == true){		
		$.ajax({
		   type: "POST",
		   url: 'delete_topic.php?id='+topic,
		   success: function(){
        $('.alert').text('Topic deleted').fadeIn().delay(3000).fadeOut();
		$('.post_container').hide();
		$('.reply_container').hide();
		$('.pagination').hide();
		   }
		
		});
		}
		
		});
		});	