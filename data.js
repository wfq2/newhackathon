
$( document ).ready(function() {
	$.ajax({
    url: 'http://api.reimaginebanking.com/accounts/5827bd04360f81f10454a22f/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61
',
    success: function(results){
    	$("div#testing").append(results);
        //do something 
    }
});
});
