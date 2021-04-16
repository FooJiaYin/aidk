<?php if (isset($_GET['alert']) && $_GET['alert'] == '1') : ?>
    <script>
        alert("<?= $_GET['msg'] ?>");
        window.location.replace("/admin/newTeacher/");
    </script>
<?php endif ?>