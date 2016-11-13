
var payments = [];
var minimum = 10;
$( document ).ready(function() {
	$.ajax({
    url: 'http://api.reimaginebanking.com/accounts/5827bd04360f81f10454a22f/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61',
    success: function(results){
    	$("div#testing").append(results);
    	var js_array = results;
    	var transactionarray = [];
    	for (var i =0;i<js_array.length;i++){
    		transactionarray.push([js_array[i].purchase_date,js_array[i].amount]);
    	}
        //do something 
        var hello = getskimmedarray(transactionarray);
        $("#totaldeposited").html(payments);
    }
});
});

function gettotalsaved(transactions){
	var total = 0;
	for (var i=0;i<transactions.length;i++){
		if (total >= minimum){
			payments.push([transactions[i][0],total]);
			total = 0;
		}
		total += amounts[i];
	}
	return total;
}

function getskimmedarray(transactions){
	var newarray = [];
	var total = 0;
	for (var i=0;i<transactions.length;i++){
		transactions[i][1] = (Math.ceil(transactions[i][1]) - transactions[i][1]);
		newarray.push([transactions[i][0],+(transactions[i][1]).toFixed(2)]);
		total += transactions[i][1];
		if (total>=minimum){
			payments.push([transactions[i][0],total]);
			total = 0;
		}
	}
	return newarray;
}

$( "#paymentmade" ).click(function() {
  
});
