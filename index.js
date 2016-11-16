$( document ).ready(function() {
	$.ajax({
    url: 'http://api.reimaginebanking.com/accounts/5827bd04360f81f10454a22f/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61',
    success: function(results){
    	$("div#testing").append(results);
    	var js_array = results;
    	var transactionarray = [];
    	for (var i =0;i<js_array.length;i++){
    		if (typeof js_array[i].purchase_date != 'undefined'){
    		transactionarray.push([js_array[i].purchase_date,js_array[i].amount]);
    	}}
        //do something 
		//console.log(getmonth(transactionarray[0][0]))
        var sorted = sorttransactions(getskimmedarray(transactionarray));
        var total = totalweeks(sorted);
       // console.log(totalthismonth(sorted));
        //console.log("total = " +total);
        gettotalsaved(sorted);
        //console.log(getmonthavg(sorted));
        var money = allsavings(sorted);
        money = Math.round(money * 100) / 100;
        $("#totalaccrued").html(" $"+money+" ");
        $("#monthlytotal").html(" $"+money+" ");
        var monthavg = getmonthavg(sorted);
        $("#monthavg").html(" $"+monthavg+" ");
}
});
});