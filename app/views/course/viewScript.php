<!-- <script src='/static/js/slick.js'></script>
<script src="/static/js/slide.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>    
    $('.single-item').slick({
        dots: true,
        arrows: false
    });
    <?php if (!(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] && $isBought)) : ?>
        $('.single-item').on('init', function (slick) {
            $('.slick-dots button').html('');
        });
        $('#buy_this_course').on('click', function() {
            var r = confirm("確定要花費" + $('#course_price').text() + "學習幣購買此課程？");
            if (r) {
                window.location.replace("/course/buy/" + $(this).data('id'));
            }
        });
    <?php endif ?>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == '1') : ?>
        alert("<?= $_GET['msg'] ?>");
        window.location.replace("/course/view/<?= $course['id'] ?>");
    <?php endif ?>
</script>