$(document).on('submit', '.reply_form', function(e){
    e.preventDefault();
	var closestdiv = $('.reply_container').siblings('.post_container').last();
	var postNum = $(closestdiv).children('.post_body').children('.post_num').attr('id');
	var splitNum = postNum.split('post');
	var idNum = parseInt(splitNum[1], 10);
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
		success  : function(data){

			var response = $(data);
			var newid = response.filter('.getid').attr('id');
			$.get('reply_content.php?id='+newid, function(content){
				if(newid == undefined){
					alert("The field can not be empty");
					}
				else{
    			var showContent = $('.reply_container').siblings('.post_container').last().after(content);
				$('#'+newid).closest('.post_container').hide().slideDown(800);	
				$(showContent).siblings('.post_container').last().children('.post_body').children('.post_num').append(idNum+++1).attr('id', 'post'+idNum);
                 $('.reply_content').slideUp(800)
                    $('.alert').text('Reply posted').fadeIn().delay(3000).fadeOut();
				}
				
				});
				
				for (instance in CKEDITOR.instances){
   				CKEDITOR.instances[instance].setData("");
				}
			}
		
    });

});
