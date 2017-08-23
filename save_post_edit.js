$(document).on('submit', '.myform', function(e){
    e.preventDefault();
	var url = window.location.href;
	var hash = url.substring(url.indexOf('id'));
    var splitHash = hash.split('#');
    var getID = splitHash[0];
	var post = $(this).parents('.post_content').attr('id');
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
		success  : function(){
            $('.alert').text('Post edit saved').fadeIn().delay(3000).fadeOut();
		$('.myform').closest('.post_content').load('post_content.php?'+getID+'&post='+post, function(){
		$(this).closest('.post_content').hide().fadeIn(800);
		});
		$('.edit_post').fadeIn('slow');
		$('.edit_topic').fadeIn('slow');
		$('.delete_post').fadeIn('slow');
		$('.delete_topic').fadeIn('slow');
			}
        
    });

});
