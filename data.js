var timearray = [];
var amountarray = [];


$( document ).ready(function() {
	$.ajax({
    url: 'http://api.reimaginebanking.com/accounts/5827bd04360f81f10454a22f/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61',
    success: function(results){
    	$("div#testing").append(results);
    	var js_array = results;
    	for (var i =0;i<js_array.length;i++){
    		timearray.push(js_array[i].purchase_date);
    		amountarray.push(js_array[i].amount);
    		$("#totaldeposited").html(amountarray);
    		$("numerdeposits")
    	}
        //do something 
    }
});
});

function gettotalsaved(amounts){
	var total = 0;
	for (int i=0;i<amounts.length;i++){
		total += amounts[i];
	}
	return total;
}

$( "#paymentmade" ).click(function() {
  
});
