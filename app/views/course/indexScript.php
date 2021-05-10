<script>
    $(function() {
        $("button").click(function() {
            // remove classes from all
            $("button").removeClass("active");
            // add class to the one we clicked
            $(this).addClass("active");
        });
    });
</script>