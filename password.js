$(document).ready(function(){
    $("#password_repeat").keyup(function(){
        if($(this).val() != $("#password").val()){
            $('.pass_match').show();
            $('input[type="submit"]').attr('disabled','disabled');
        }
        else{
            $('.pass_match').hide();
            $('input[type="submit"]').removeAttr('disabled');
        }
    });

});
