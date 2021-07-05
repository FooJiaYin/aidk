<main>
<section id="features-section" class="py-5">
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col">
                <img src="/static/images/index-survey.png">
            </div>
            <div class="col">
                <img src="/static/images/index-course.png">
            </div>
            <div class="col">
                <img src="/static/images/index-portfolio.png">
            </div>
        </div>
        <div class="row mt-3" data-aos="fade-up" data-aos-delay="500">
            <div class="col text-center">
                <a href="/survey">
                    <button class="btn bg-orange">興趣分析</button>
                </a>
            </div>
            <div class="col text-center">
                <a href="/course/all">
                    <button class="btn bg-orange">我要上課</button>
                </a>
            </div>
            <div class="col text-center">
                <a href="/student/portfolio">
                    <button class="btn bg-orange">學習歷程</button>
                </a>
        </div>
    </div>
</section>

<section id="banner-section" class="py-5" style="background-color: #f3fdf4">
    <div class="card shadow w-75 mx-auto" data-aos="fade-up" data-aos-delay="1000">
        <img src="/static/images/index-banner.png">
    </div>
</section>

<section id="portfolio-section" class="py-5">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col ml-5">
                <h2>學生分享學習履歷</h2>
                <p class="text-grey mb-4">學生分享學習履歷學，生分享學習履歷學生分享學習履歷學生。分享學習履歷學生分享學習履歷。學生分享學習履歷學，生分享學習履歷。學生分享學習履歷學生，分享學習履歷學生分享學習履歷。</p>
                <a href="/student/portfolio">
                    <div class="btn bg-orange">展開</div>
                </a>
            </div>
            <div class="col">
                <img src="/static/images/index-portfolio-placeholder.png">
            </div>
        </div>
    </div>
</section>

<section id="banner-section" class="py-5" style="background-color: #fff8e9">
    <div class="container">
        <div class="row justify-content-center align-items-center" data-aos="fade-up">
            <div class="col-auto">
                <img src="/static/images/index-sponsor.png" width="126px">
            </div>
            <div class="col-12 col-md-5">
                <div class="rounded-pill bg-white px-4 py-2">
                    <p class="text-grey mb-0">AIDK學習歷程導航者與您相伴，共同成長。請您也幫助我們一同成長。</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="courses-new-section" class="py-5">
    <div class="container" data-aos="fade-up">
        <div class="row">
        <?php foreach ($courses_new as $course) : ?>
            <div class="col-6 col-lg-3 mb-4">
                <div class="card course-card h-100 border-0 shadow" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                    <?php
                    $path = "course_data/" . $course['id'] . "/img/";
                    $imgs = array_diff(scandir($path), array('.', '..'));
                    ?>
                    <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top h-50" alt="圖">
                    <div class="card-body pt-2 pb-5">
                        <div class="text-ellipsis">
                        <?php foreach ($course['category'] as $category) : ?>
                            <a href="/course/category/<?= $category ?>/">
                                <div class="badge bg-green rounded-pill course-tag">
                                        <?= COURSE_CATEGORY[$category] ?>
                                </div>
                            </a>
                        <?php endforeach ?>
                        </div>
                        <h5 class="card-title mt-2"><?= (strlen($course['name']) > 60) ? mb_substr($course['name'], 0, 19) . "..." : $course['name'] ?></h5>
                        <div class="row justify-content-between align-items-end mb-3">
                            <div class="col-auto">
                                <p class="card-text"><i class="fa fa-clock-o text-green mr-2"></i>時數 <?= substr($course['duration'], 0, -3) ?> 分鐘</p>
                                <p class="card-text"><i class="fa fa-user text-green mr-2"></i><?= $course['stuCount'] ?> 同學</p>
                            </div>
                            <div class="col-auto">
                                <h5 class="text-green mb-0">NT$<?= $course['price'] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
            <div class="col-6 col-lg-3 align-self-center">
                <h2 class="bar-left">最新課程</h2>
                <p class="text-grey mb-4">學生分享學習履歷學，生分享學習履歷學生分享學習履歷學生。分享學習履歷學生分享學習履歷。學生分享學習履歷學，生分享學習履歷。學生分享學習履歷學生，分享學習履歷學生分享學習履歷。</p>
                <div class="text-center">
                    <a href="/student/portfolio">
                        <div class="btn bg-orange">更多課程<i class="fa fa-arrow-circle-right ml-2"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="courses-hot-section" class="py-5" style="background-color: #f6f6f6">
    <div class="container" data-aos="fade-up">
        <div class="row">            
            <div class="col-6 col-lg-3 align-self-center">
                <h2 class="bar-left">熱門課程</h2>
                <p class="text-grey mb-4">學生分享學習履歷學，生分享學習履歷學生分享學習履歷學生。分享學習履歷學生分享學習履歷。學生分享學習履歷學，生分享學習履歷。學生分享學習履歷學生，分享學習履歷學生分享學習履歷。</p>
                <div class="text-center">
                    <a href="/student/portfolio">
                        <div class="btn bg-orange">更多課程<i class="fa fa-arrow-circle-right ml-2"></i></div>
                    </a>
                </div>
            </div>
        <?php foreach ($courses_hot as $course) : ?>
            <div class="col-6 col-lg-3 mb-4">
                <div class="card course-card h-100 border-0 shadow" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                    <?php
                    $path = "course_data/" . $course['id'] . "/img/";
                    $imgs = array_diff(scandir($path), array('.', '..'));
                    ?>
                    <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top h-50" alt="圖">
                    <div class="card-body pt-2 pb-5">
                        <div class="text-ellipsis">
                        <?php foreach ($course['category'] as $category) : ?>
                            <a href="/course/category/<?= $category ?>/">
                                <div class="badge bg-green rounded-pill course-tag">
                                        <?= COURSE_CATEGORY[$category] ?>
                                </div>
                            </a>
                        <?php endforeach ?>
                        </div>
                        <h5 class="card-title mt-2"><?= (strlen($course['name']) > 60) ? mb_substr($course['name'], 0, 19) . "..." : $course['name'] ?></h5>
                        <div class="row justify-content-between align-items-end mb-3">
                            <div class="col-auto">
                                <p class="card-text"><i class="fa fa-clock-o text-green mr-2"></i>時數 <?= substr($course['duration'], 0, -3) ?> 分鐘</p>
                                <p class="card-text"><i class="fa fa-user text-green mr-2"></i><?= $course['stuCount'] ?> 同學</p>
                            </div>
                            <div class="col-auto">
                                <h5 class="text-green mb-0">NT$<?= $course['price'] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        </div>
    </div>
</section>

<section id="courses-new-section" class="py-5">
    <div class="container" data-aos="fade-up">
        <div class="row">
        <?php foreach ($courses_new as $course) : ?>
            <div class="col-6 col-lg-3 mb-4">
                <div class="card course-card h-100 border-0 shadow" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                    <?php
                    $path = "course_data/" . $course['id'] . "/img/";
                    $imgs = array_diff(scandir($path), array('.', '..'));
                    ?>
                    <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top h-50" alt="圖">
                    <div class="card-body pt-2 pb-5">
                        <div class="text-ellipsis">
                        <?php foreach ($course['category'] as $category) : ?>
                            <a href="/course/category/<?= $category ?>/">
                                <div class="badge bg-green rounded-pill course-tag">
                                        <?= COURSE_CATEGORY[$category] ?>
                                </div>
                            </a>
                        <?php endforeach ?>
                        </div>
                        <h5 class="card-title mt-2"><?= (strlen($course['name']) > 60) ? mb_substr($course['name'], 0, 19) . "..." : $course['name'] ?></h5>
                        <div class="row justify-content-between align-items-end mb-3">
                            <div class="col-auto">
                                <p class="card-text"><i class="fa fa-clock-o text-green mr-2"></i>時數 <?= substr($course['duration'], 0, -3) ?> 分鐘</p>
                                <p class="card-text"><i class="fa fa-user text-green mr-2"></i><?= $course['stuCount'] ?> 同學</p>
                            </div>
                            <div class="col-auto">
                                <h5 class="text-green mb-0">NT$<?= $course['price'] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
            <div class="col-6 col-lg-3 align-self-center">
                <h2 class="bar-left">好評課程</h2>
                <p class="text-grey mb-4">學生分享學習履歷學，生分享學習履歷學生分享學習履歷學生。分享學習履歷學生分享學習履歷。學生分享學習履歷學，生分享學習履歷。學生分享學習履歷學生，分享學習履歷學生分享學習履歷。</p>
                <div class="text-center">
                    <a href="/student/portfolio">
                        <div class="btn bg-orange">更多課程<i class="fa fa-arrow-circle-right ml-2"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
