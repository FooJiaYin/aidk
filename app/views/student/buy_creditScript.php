<script type="text/javascript">
    window.onpageshow = function(event) {
        if (event.persisted) {
            alert("付款異常，請重新操作！");
            console.log('Reloading');
            window.location.replace("http://mentoraipro.com:9102/student/record/");
        }
    };
    $(document).ready(function() {
        var d = new Date();
        var callbackURI = "http://mentoraipro.com:9102/student/buy_credit_result/" + $('#amount').val() + "/";
        var url = "https://n.gomypay.asia/TestShuntClass.aspx?";
        url += "Send_Type=0&Pay_Mode_No=2&CustomerId=E1BB88E7DB4F27B168D712777470B3CC&";
        url += "Order_No=" + $('#orderNo').val() + "&";
        url += "Return_url=" + callbackURI + "&";
        url += "Amount=" + $('#amount').val() + "&";
        url += "Buyer_Name=" + encodeURI($('#name').val()) + "&";
        url += "Buyer_Telm=" + $('#phone').val() + "&";
        url += "Buyer_Mail=" + $('#email').val() + "&";
        url += "Buyer_Memo=%E5%AD%B8%E7%BF%92%E5%B9%A3" + $('#amount').val() + "&";
        url += "TransMode=1&Installment=0&TransCode=00";
        console.log(url);
        window.location.replace(url);
    });

    $(window).unload(function() {});
</script>