<?php if (isset($_GET['status']) && $_GET['status'] == 1) : ?>
    <script>
        alert("學習幣購買成功，若交易有任何問題請洽詢客服！");
        window.location.replace("http://mentoraipro.com:9102/student/record/");
    </script>
<?php elseif (isset($_GET['status']) && $_GET['status'] == 0) : ?>
    <script>
        alert("學習幣購買失敗，請向發卡機構確認是否有扣款，若交易有任何問題請洽詢客服！");
        window.location.replace("http://mentoraipro.com:9102/student/record/");
    </script>
<?php endif ?>