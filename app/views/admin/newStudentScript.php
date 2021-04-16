<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script language='javascript'>
    $(function() {
        $("#birthday").datepicker({
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear : true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>

<?php if (isset($_GET['alert']) && $_GET['alert'] == '1') : ?>
    <script>
        alert("<?= $_GET['msg'] ?>");
        window.location.replace("/admin/newStudent/");
    </script>
<?php endif ?>