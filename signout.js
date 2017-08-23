$(document).ready(function(){
	 $('#sign_out').click(function(){	
		  $.ajax({
		   type: "POST",
		   url: "signout.php",
		   data: 'redir='+window.location.hash,
		   success: function(){    
			location.reload(true);
		   }
		  
		  });
	});
});