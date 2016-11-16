function post_purchases(payer_id, trans_per_month, year){
    for(count = 0; count <= trans_per_month; count++){
        month = (Math.floor(Math.random() * (12 - 1) + 1)).toString();
        if (month.Length < 2) {
            month = "0" + month;
        }
        if (month = "09" || "04" || "06" || "11"){
            day_max = 30;
        }
        else if (month = "02"){
            day_max = 28
        }
        else{
            day_max = 31;
        }
        day = (Math.floor(Math.random() * (day_max - 1) + 1)).toString();
        trans_date = year + "-" + month + "-" + day;
        amount = +((Math.random() * (30.0 - 1.00) + 1.00).toFixed(2));
        trans_desc = "Transaction #" + count.toString();

        var purchase = JSON.stringify({
            "merchant_id": "57cf75cea73e494d8675ec49",
            "amount": amount,
            "medium": "balance",
            "purchase_date": trans_date,
            "description": trans_desc
        });
        $.ajax({
        url : "http://api.reimaginebanking.com/accounts/" + payer_id + "/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61",
        type:"POST",
        data: purchase,
        contentType: "application/json",
        dataType: "json",
        success: function(data){
            console.log(data);
            console.log("success");
        },
        error: function(data){
            console.log(data);
            console.log("failure");
        }
    });
} 
}

function clear_purchase_history(account_id){
    purchases = [];
    $.ajax({
        url : "http://api.reimaginebanking.com/accounts/" + account_id + "/purchases?key=928cd0c9627ba32b3be6893c4c6c1d61",
        type : "GET",
        contentType: "application/json",
        dataType: "json",
        success: function(data){
            purchases = data;
            console.log(purchases);
            console.log("get success")
        },
        error: function(data){
            console.log(data)
            console.log("get failure")
        }
    });
    console.log(purchases.length);
    while (purchases.length > 0){
        p_id = (purchases [0])._id;
        console.log(p_id);
        $.ajax({
            url : "http://api.reimaginebanking.com/purchases/" + p_id +"?key=928cd0c9627ba32b3be6893c4c6c1d61",
            type : "DELETE",
            contentType: "application/json",
            dataType: "json",
            success: function(data){
                console.log("del success");
            },
            error: function(data){
                console.log("del failure");
            }
        });
    }

}
