<script>
    function filter(target, f1, f2) {
        v1 = $("select#"+f1).val();
        v2 = $("select#"+f2).val();
        filters = "["+f1+"='"+v1+"']["+f2+"='"+v2+"'], [value='other']";
        $("#" + target).children().not(filters).hide();
        $("#" + target).find("option"+filters).show();
        // $('option').not("[filter*='taichung']", value).hide();
    }
</script>