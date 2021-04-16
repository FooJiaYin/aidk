<div class="container-xl">

    <div class="row">
        <div class="col-12 col-xs-8 col-md-8 col-xl-9 order-1 order-md-0">
            <!-- banner -->
            <section class="top-banner slider">
                <?php foreach ($imgs as $img) : ?>
                    <div><img src="/course_data/<?= $course['id'] ?>/img/<?= $img ?>" style="max-width:900px;max=height:450px;" width="900" height="450" alt="圖"></div>
                <?php endforeach ?>
                <?php if(is_file("course_data/".$course['id']."/intro.mp4")): ?>
                <div>
                    <video style="width:830px; max-width:100%;" controls  disablepictureinpicture  controlsList="nodownload">
                        <source src="/course_data/<?= $course['id'] ?>/intro.mp4" type="video/mp4">
                        此瀏覽器不支援本網站的影片播放，請改用她款瀏覽器。
                    </video>
                </div>
                <?php endif ?>
            </section>
            <!-- banner end. -->

            <div class="titleJL marT30 marB0">
                <h4>課程內容</h4>
            </div>

            <table class="table table-hover">
                <?php foreach ($course['chapter'] as $chap) : ?>
                    <thead>
                        <tr class="thead-light">
                            <th scope="col"><?= $chap['name'] ?></th>
                            <th scope="col" width="60"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chap['section'] as $sec) : ?>
                            <tr>
                                <th scope="row"><a href="#!"><?= $sec['name'] ?></a></th>
                                <td><?= $sec['duration'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                <?php endforeach ?>
            </table>

        </div>

        <div class="col-12 col-xs-4 col-md-4 col-xl-3 order-0 order-md-1">

            <div class="titleJL marT0 marB10">
                <h1><?= $course['name'] ?></h1>
            </div>

            <div class="text-break">
                <?= nl2br($course['description']) ?>
            </div>

            <div class="row marT20">
                <div class="col-6">
                    <h6 class="font-weight-bolder">課程時長</h6>
                    <div class="text-muted"><?= $course['duration'] ?></div>
                </div>
                <div class="col-6">
                    <h6 class="font-weight-bolder">學生人數</h6>
                    <div class="text-muted"><?= $course['stuCount'] ?>位</div>
                </div>
            </div>

            <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] && ($isBought || $_SESSION['loginType'] == 3)) : ?>
                <span class="inBlock marT15 marB30">
                    <a href="/course/play/<?= $course['id'] ?>/" class="btnJL marL0">
                        進入課程
                    </a>
                </span>
            <?php else : ?>
                <span class="inBlock marT15 marB30">
                    <h6 class="font-weight-bolder">課程售價：<span id="course_price"><?= $course['price'] ?></span></h6>
                    <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']) : ?>
                        <a id="buy_this_course" href="#!" class="btnJL marL0" data-id="<?= $course['id'] ?>">
                            購買課程
                        </a>
                    <?php else : ?>
                        <a href="/student/login/" class="btnJL marL0" data-id="<?= $course['id'] ?>">
                            購買課程
                        </a>
                    <?php endif ?>
                </span>
            <?php endif ?>

        </div>
    </div>


</div>