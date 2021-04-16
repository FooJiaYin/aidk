<script src='/static/js/fa.js'></script>
<script>
    window.onpageshow = function(event) {
        if (event.persisted) {
            console.log('Reloading');
            window.location.reload();
        }
    };
    $(window).unload(function() {});
</script>