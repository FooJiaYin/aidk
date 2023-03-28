<section id="course-intro-section" class="mt-5 mb-4">

    <div class="container">
    
    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- banner -->
            <div class="slider single-item">
                <?php foreach ($imgs as $img) : ?>
                <div><img class="img-fluid" src="/course_data/<?= $course['id'] ?>/img/<?= $img ?>" alt="圖"></div>
                <?php endforeach ?>
                <?php if(is_file("course_data/".$course['id']."/intro.mp4")): ?>
                <div>
                    <video class="img-fluid" controls  disablepictureinpicture  controlsList="nodownload">
                        <source src="/course_data/<?= $course['id'] ?>/intro.mp4" type="video/mp4">
                        此瀏覽器不支援本網站的影片播放，請改用她款瀏覽器。
                    </video>
                </div>
                <?php endif ?>
            </div>
            <!-- banner end. -->
        </div>
        <div class="col-12 col-lg-4">
            <h1 class="course-title"><?= $course['name'] ?></h1>
            <?php foreach ($course['category'] as $category) : ?>
                <a href="/course/category/<?= $category ?>/">
                    <div class="badge bg-green rounded-pill course-tag px-3 py-2 my-2">
                        <?= COURSE_CATEGORY[$category] ?>
                    </div>
                </a>
            <?php endforeach ?>
            
            <p><?= nl2br($course['description']) ?></p>

            <div class="row justify-content-between align-items-end font-weight-bold">
                <div class="col-6 col-md d-sm-flex d-lg-block">
                    <p class="mb-2 mr-2"><i class="fa fa-clock-o text-green mr-2"></i>課程時長</p>
                    <p><?= $course['duration'] ?></p>
                </div>
                <div class="col-6 col-md d-sm-flex d-lg-block">
                    <p class="mb-2 mr-2"><i class="fa fa-user text-green mr-2"></i>學生人數</p>
                    <p><?= $course['stuCount'] ?> 位</p>
                </div>
                <?php if (!isset($_SESSION['isLogin']) || !$_SESSION['isLogin'] || !($isBought || $_SESSION['loginType'] == 3)) : ?>
                <div class="col-12 col-md col-lg-12 d-sm-flex d-lg-block justify-content-center mb-2">
                    <h6 class="font-weight-bolder text-center">課程售價 
                        <span class="course-price ml-3">$<?= $course['price'] ?></span>
                    </h6>
                </div>
                <?php endif ?>
            </div>

            <div class="text-center my-4">
                <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] && ($isBought || $_SESSION['loginType'] == 3)) : ?>
                    <a href="/course/play/<?= $course['id'] ?>/" class="btn bg-green">
                        進入課程
                    </a>
                <?php else : ?>
                    <!-- <h6 class="font-weight-bolder mr-sm-5 mr-lg-0 mb-0">課程售價 <span class="course-price ml-3">$<?= $course['price'] ?></span></h6> -->
                    <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']) : ?>
                        <a id="buy_this_course" href="#!" class="btn bg-orange" data-id="<?= $course['id'] ?>">
                            購買課程
                        </a>
                    <?php else : ?>
                        <a href="/student/login/" class="btn bg-orange text-center" data-id="<?= $course['id'] ?>">
                            購買課程
                        </a>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    
    </div>
</section>

<section id="course-content-section" class="bg-light-green">
    <div class="container">
        <h2 class="bar-left-orange">課程内容</h2>
        <div class="accordion" id="accordionExample">
        <?php foreach ($course['chapter'] as $i => $chap) : ?>
            <div class="card">
                <a class="text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                    <div class="card-header" id="heading<?= $i ?>">
                        <div class="mb-0">
                            <?= $chap['name'] ?>
                        </div>
                    </div>
                </a>

                <div id="collapse<?= $i ?>" class="collapse show" aria-labelledby="heading<?= $i ?>">
                    <?php foreach ($chap['section'] as $sec) : ?>
                    <div class="d-flex justify-content-between">
                        <div><?= $sec['name'] ?></div>
                        <div><?= $sec['duration'] ?></div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>
        </div>
    </div>
</section>