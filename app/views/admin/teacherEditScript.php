<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script language='javascript'>
    $(function() {
        $("#birthday").datepicker({
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear : true,
            yearRange: "-100:+0",
            dateFormat: 'yy-mm-dd'
        });
    });
</script>