
//[date,amount]
/*$( document ).ready(function() {

        //do something 
		//console.log(getmonth(transactionarray[0][0]))
		var chartdata = getdailytotals.bind(skimmedarray);
		console.log(chartdata);

        var chart = new CanvasJS.Chart("chartContainer", {
			title: {
				text: "Line Chart"
			},
			axisX: {
				interval: 10
			},
			data: [{
				type: "line",
				dataPoints: chartdata
			}]
		});
		chart.render();
});
//takes sorted
function getdailytotals(skimmedarray){
	var totalsarray = [];
	var currentdate = skimmedarray[0][0];
	var days = 0;
	var dailytotal = 0;
	for (var i=0;i<skimmedarray.length;i++){
		if (currentdate == skimmedarray[i][0]){
			dailytotal += skimmedarray[i][1];
		}
		else{
			totalsarray.push({x: days,y: dailytotal});
			dailytotal += skimmedarray[i][1];
			days++;
		}
	}
	return totalsarray;
}*/
