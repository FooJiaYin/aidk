<script src='/static/js/slick.js'></script>
<script src="/static/js/slide.js"></script>

<?php if (!(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] && $isBought)) : ?>
    <script>
        $('#buy_this_course').on('click', function() {
            var r = confirm("確定要花費" + $('#course_price').text() + "學習幣購買此課程？");
            if (r) {
                window.location.replace("/course/buy/" + $(this).data('id'));
            }
        });
    </script>
<?php endif ?>
<?php if (isset($_GET['alert']) && $_GET['alert'] == '1') : ?>
    <script>
        alert("<?= $_GET['msg'] ?>");
        window.location.replace("/course/view/<?= $course['id'] ?>");
    </script>
<?php endif ?>