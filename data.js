
var payments = [];
var minimum = 10;
var skimmedarray;
var totalweek = [];
//[date,amount]
/*$( document ).ready(function() {
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
        skimmedarray = sorted;
        var money = allsavings(sorted);
        money = Math.round(money * 100) / 100;
        $("#totalaccrued").html(" $"+money+" ");
        $("#monthlytotal").html(" $"+money+" ");
        var monthavg = getmonthavg(skimmedarray);
        $("#monthavg").html(" $"+monthavg+" ");
        for (var i=0;i<payments.length;i++){
        	$("#payments").prepend("<p class='bar'> Date: " + payments[i][0] + "<span> Amount: $<span>" + payments[i][1]);
        }
        //makedeposit(0.05);
        makelinegraph();
}
});
});*/

function makelinegraph(thearray){
		//console.log(thearray);
	    var chartdata = getdailytotals(thearray);
        var chart = new CanvasJS.Chart("chartContainer", {
		title: {
			text: "Accrued Loan Payments"
		},
		axisX: {
			title: "Date",
			valueFormatString: "MM-DD-YY" ,
			interval: 20,
			intervalType: "day",
			labelAngle: -50,
		},
		axisY:{
			title: "Paid",
			maximum: 200,
			prefix: "$"
		},
		data: [{
			type: "line",
			dataPoints: chartdata
			}]
		});
		//console.log(chartdata);
		chart.render();
		//console.log(chartdata);
    }

function round(number){
	return Math.round(number * 100) / 100
}

function makebarchart(transactions){
	var totalloan = 2000;
	var total = round(realtotalsaved(transactions));
	var paidforward = 36.67;
	var projection = round(getprojectedsavings(transactions,500));
	var rest = totalloan - total - paidforward - projection;
var chart = new CanvasJS.Chart("barchart",
    {
      title:{
      text: "Trimmed"
      },
      dataPointMinWidth: 50,
      animationEnabled: true,
      axisX: {
      	interval:0,
      },
      axisY:{
			title: "Saved",
			maximum: totalloan,
			prefix: "$",
			gridColor:"white",
		},

      data: [
      {       
        type: "stackedBar",
        color: "#55C187",
        legendText: "Personal Trimmings",
        showInLegend: "true",
        dataPoints: [
        { x: 0, y: total },  
        ]
      },
        {        
        type: "stackedBar",
        color: "#F4D06F",
        name: "Paid Forward Trimmings",
        showInLegend: "true",
        dataPoints: [
        { x: 0, y: paidforward },  
        ]
      },
        {        
        type: "stackedBar",
        color:"#1B9AAA",
        name: "Projected Trimmings",
        showInLegend: "true",
        dataPoints: [
        { x: 0, y: projection },  
        ]
      },
        
        {        
        type: "stackedBar",
        color:"#E3E3E3",
        name: "unpaid",
        showInLegend: "true",
        dataPoints: [
        { x: 0, y: rest },    
        ]
      },
        
      ]
      ,
      legend:{
        cursor:"pointer",
        itemclick:function(e) {
          if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible){
            e.dataSeries.visible = false;
          }
          else {
            e.dataSeries.visible = true;
          }
          
          chart.render();
        }
      }
    });

    chart.render();
  }

 function getprojectedsavings(transactions,numdays){
 	var avg = getmonthavg(transactions);
 	var projection = avg * (numdays / 30);
 	return projection
 }


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

function realtotalsaved(transactions){
		var total = 0;
	for (var i=0;i<transactions.length;i++){
		total += transactions[i][1];
	}
	total = Math.round(total * 100) / 100;
	return total;
}

function getmonthavg(transactions){
	var total = 0;
	var months = 1;
	var latestmonth = transactions[0][0].getMonth();
	for (var i=0;i<transactions.length;i++){
		total += transactions[i][1];
		if (latestmonth == transactions[i][0].getMonth()){
		}
		else{
			months += 1;
		}
		latestmonth = transactions[i][0].getMonth();
	}
	console.log(months);
	months -= 1;
	total = total/months
	total = Math.round(total * 100) / 100
	$("#monthavg").html(" $" + total)
	return total
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
	//$("#monthlytotal").html(" $"+ acc + " ");
	return acc;
}

function sorttransactions(transactions){
	//console.log(transactions);
	for (var i=0;i<transactions.length;i++){
		for (var j=i;j<transactions.length-1;j++){
			if (transactions[j][0].getTime() >= transactions[j+1][0].getTime()){
				//console.log (transactions[j][0] + " >= " + transactions[j+1][0]);
				var temp = transactions[j+1];
				transactions[j+1]=transactions[j];
				transactions[j]= temp;
			}
		}
	}
	//console.log(transactions);
	return transactions;
}

function sortFunction(a, b) {
    if (a[0] === b[0]) {
        return 0;
    }
    else {
        return (a[0] < b[0]) ? -1 : 1;
    }
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
	var obj = JSON.stringify({
  "medium": "balance",
  "amount": amount,
  "description": "string"
});
	console.log(obj);
$.ajax({
    url : "http://api.reimaginebanking.com/accounts/582853cb360f81f10454c1b7/deposits?key=928cd0c9627ba32b3be6893c4c6c1d61",
    type: "POST",
    data : obj,
    contentType: "application/json",
    dataType: "json",
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

function makepurchase(amount){
	amount = parseFloat(amount);
	var obj = JSON.stringify({
    "merchant_id": "57cf75cea73e494d8675ec49",
    "amount": amount,
    "medium": "balance",
    "purchase_date": "2016-11-13",
    "description": "string"
});
	$.ajax({
    url : "http://api.reimaginebanking.com/accounts/5827bd04360f81f10454a22f/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61",
    type: "POST",
    data : obj,
    contentType: "application/json",
    dataType: "json",
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

function savemakepurchase(amount,checkingno,savingsno,date){
	amount = parseFloat(amount);
	var purchasedata = JSON.stringify({
    "merchant_id": "57cf75cea73e494d8675ec49",
    "amount": amount,
    "medium": "balance",
    "purchase_date": date,
    "description": "string"
});
	var savedamount = Math.round((Math.ceil(amount)-amount)*100)/100;
	var saveddata = JSON.stringify({
    "merchant_id": "57cf75cea73e494d8675ec49",
    "amount": savedamount,
    "medium": "balance",
    "purchase_date": date,
    "description": "TRIM"
});
	var depositdata = JSON.stringify({
  "medium": "balance",
  "transaction_date": date,
  "amount": savedamount,
  "description": "TRIM"
});
	$.ajax({
    url : "http://api.reimaginebanking.com/accounts/"+checkingno+"/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61",
    type: "POST",
    data : purchasedata,
    contentType: "application/json",
    dataType: "json",
    success: function(data)
    {
        console.log("successfully purchased");
    },
    error: function (data)
    {
 		console.log("failed to purchase");
    }
});
	$.ajax({
    url : "http://api.reimaginebanking.com/accounts/"+checkingno+"/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61",
    type: "POST",
    data : saveddata,
    contentType: "application/json",
    dataType: "json",
    success: function(data)
    {
        console.log("successfully charged trim");
    },
    error: function (data)
    {
 		console.log("failed charge trim");
    }
});
	$.ajax({
    url : "http://api.reimaginebanking.com/accounts/"+savingsno+"/deposits?key=928cd0c9627ba32b3be6893c4c6c1d61",
    type: "POST",
    data : depositdata,
    contentType: "application/json",
    dataType: "json",
    success: function(data)
    {
        console.log("successfully saved trim");
    },
    error: function (data)
    {
 		console.log("failed to save trim");
    }
});

}


$( "#submitamount" ).click(function() {
 	var num = $("#getamount").val();
 	makepurchase(num);
});

function getdailytotals(thearray){
	var totalsarray = [];
	var currentdate = thearray[0][0];
	var days = 0;
	var dailytotal = 0;
	for (var i=0;i<thearray.length;i++){
		if (i == thearray.length-1){
				totalsarray.push({x: currentdate,y: dailytotal,indexLabel: "Projection", indexLabelOrientation: "vertical", indexLabelFontColor: "green", markerColor: "orangered"});
			}
		if (currentdate == thearray[i][0]){
			console.log(currentdate + "  = " + thearray[i][0]);
			dailytotal += thearray[i][1];
		}
		else{
			dailytotal = Math.round(dailytotal * 100) / 100;
			totalsarray.push({x: currentdate,y: dailytotal});
			//console.log(currentdate);
			dailytotal += thearray[i][1];
			currentdate = thearray[i][0];
			days++;
		}
	}
	var avg = getmonthavg(thearray)/30;
	for (var i=0;i<100;i++){
		var tomorrow = new Date(currentdate.setDate(currentdate.getDate() + 1));
		//console.log(tomorrow);
		dailytotal += avg;
		totalsarray.push({x: tomorrow,y: dailytotal,lineColor:"green"});
	}
	//console.log(totalsarray);
	return totalsarray;
}
