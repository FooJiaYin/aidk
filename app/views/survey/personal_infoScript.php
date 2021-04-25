<script>
    function filter(target, f1, f2) {
        v1 = $("select#"+f1).val();
        v2 = $("select#"+f2).val();
        filters = "["+f1+"='"+v1+"']["+f2+"='"+v2+"']";
        $("#" + target).find("option"+filters).show();
        $("#" + target).children().not(filters).hide();
        // $('option').not("[filter*='taichung']", value).hide();
    }
</script>