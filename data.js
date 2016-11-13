
var payments = [];
var minimum = 10;
var skimmedarray = [];
var totalweek = [];
//[date,amount]
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
		//console.log(getmonth(transactionarray[0][0]))
        var sorted = sorttransactions(getskimmedarray(transactionarray));
        var total = totalweeks(sorted);
       // console.log(totalthismonth(sorted));
        //console.log("total = " +total);
        gettotalsaved(sorted);
        console.log(payments);
        $("#totalaccrued").html(" $"+allsavings(sorted)+" ");
        for (var i=0;i<payments.length;i++){
        	$("#payments").append("<p> Date: " + payments[i][0] + " Amount: " + payments[i][1]);
        }
        makedeposit(0.05);
    }
});
});

function gettotalsaved(transactions){
	var total = 0;
	for (var i=0;i<transactions.length;i++){
		if (total >= minimum){
			total = Math.round(total * 100) / 100
			payments.push([transactions[i][0],total]);
			total = 0;
		}
		total += transactions[i][1];
	}
	return total;
}

function allsavings(transactions){
	var total = 0;
	for (var i=0;i<transactions.length;i++){
		total += transactions[i][1];
	}
	return total;
}

//takes sorted, skimmed transactions
function totalweeks(transactions){
	var latest = transactions[transactions.length-1][0];
	var acc = 0;
	for (var i=transactions.length-1;i>=0;i--){
		if (getday(latest)-getday(transactions[i][0])<8){
			acc += transactions[i][1];
		}
		else if (getmonth(latest)-getday(transactions[i][0])==-1 && getday(latest)-(31-getday(transactions[i][0]))<8){
			acc += transactions[i][1];
		}
		else{
			break;
		}
	}
	return acc;
}
//takes sorted, trimmed transactions
function totalthismonth(transactions){
	var latest = transactions[transactions.length-1][0];
	var acc = 0;
	for (var i=transactions.length-1;i>=0;i--){
		if (getmonth(latest) != getmonth(transactions[i][0])){
			break;
		}
		acc += transactions[i][1];
	}
	acc = Math.round(acc * 100) / 100;
	$("#monthlytotal").html(" $"+ acc + " ");
	return acc;
}

function sorttransactions(transactions){
	for (var i=0;i<transactions.length;i++){
		for (var j=0;j<transactions.length-i-1;j++){
			if (comparedate(transactions[j][0],transactions[j+1][0])){
				//console.log (transactions[j][0] + " >= " + transactions[j-1][0]);
				var temp = transactions[j+1];
				transactions[j+1]=transactions[j];
				transactions[j]= temp;
			}
		}
	}
	return transactions;
}

//returns a<=b
function comparedate(a,b){
	if (getyear(a)>getyear(b)){
		return true;
	}
	else if (getyear(a)==getyear(b) && getmonth(a)>getmonth(b)){
		return true;
	}
	else if (getyear(a)==getyear(b) && getmonth(a)==getmonth(b) && getday(a)>=getday(b)){

		return true;
	}
	else{
		return false;
	}
}

function getday(date){
	var arr = date.split("-");
	return arr[2];
}

function getmonth(date){
	var arr = date.split("-");
	return arr[1];
}

function getyear(date){
	var arr = date.split("-");
	return arr[0];
}



function getskimmedarray(transactions){
	var newarray = [];
	for (var i=0;i<transactions.length;i++){
		transactions[i][1] = (Math.ceil(transactions[i][1]) - transactions[i][1]);
		newarray.push([transactions[i][0],+(transactions[i][1]).toFixed(2)]);
	}
	return newarray;
}
function makedeposit(amount){
	var obj = {};
	obj.medium = "balance";
	obj.amount = amount;
	obj.description = "string";
	console.log(obj);
$.ajax({
    url : "http://api.reimaginebanking.com/accounts/582853cb360f81f10454c1b7/deposits?key=928cd0c9627ba32b3be6893c4c6c1d61",
    type: "POST",
    data : obj,
    success: function(data)
    {
        console.log(data);
        console.log("success");
    },
    error: function (data)
    {
 		console.log(data);
 		console.log("failure");
    }
});
}


$( "#paymentmade" ).click(function() {
  
});
