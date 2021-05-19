<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script language='javascript'>
    $(function() {
        $("#birthday").datepicker({
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear : true,
            yearRange: "-23:+0",
            dateFormat: 'yy-mm-dd'
        });
    });
    function filter(target, f1, f2) {
        v1 = $("select#"+f1).val();
        v2 = $("select#"+f2).val();
        filters = "["+f1+"='"+v1+"']["+f2+"='"+v2+"'], [value='other']";
        $("#" + target).children().not(filters).hide();
        $("#" + target).find("option"+filters).show();
        // $('option').not("[filter*='taichung']", value).hide();
    }
    filter('school', 'city', 'type');
</script>