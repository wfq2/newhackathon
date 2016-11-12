
$( document ).ready(function() {
    $('#mobile_nav #button').click(function(){
    	var x = $('#mobile_nav ul');
    	if (x.hasClass('responsive')){
    		x.removeClass('responsive');
    	}
    	else{
    		x.addClass('responsive');
    	}

    });
});
