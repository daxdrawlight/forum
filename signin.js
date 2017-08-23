$(document).on('submit', '.signin_form', function(e){
    e.preventDefault();
	$.ajax({
	    type: "POST",
	    url: "login.php",
	    data: 'username='+$('#username').val()+'&password='+$('#password').val(),
        success: function(html){
            if(jQuery.trim(html) == 'Success'){
                history.go(-1);
            }
            else if(jQuery.trim(html) == 'Fail'){
                $('.incorrect').show();
                $('#username, #password').css('border-color', 'red')
	        }
        }
	});

});
