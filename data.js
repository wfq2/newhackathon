
$( document ).ready(function() {
	$.ajax({
    url: 'http://api.reimaginebanking.com/atms?key=09a8dae9addf098be3a3d4ef4bc968b7',
    success: function(results){
    	$("div#testing").append(results);
        //do something 
    }
});
});
