<div class="container">
    <ul class="nav nav-fill my-4">
        <li class="nav-item">
            <a class="nav-link" href="/student/profile">基本資料</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">自傳編撰</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">課程清單</a>
        </li>
    </ul>
    <div class="row" data-aos="fade-up">
        <?php if ($courses) : ?>
        <?php foreach ($courses as $course) : ?>
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card course-card h-100 border-0 shadow" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                    <?php
                    $path = "course_data/" . $course['id'] . "/img/";
                    $imgs = array_diff(scandir($path), array('.', '..'));
                    ?>
                    <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top h-50" alt="圖">
                    <div class="card-body pt-2">
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
                        <div class="row justify-content-between align-items-end">
                            <div class="col-auto pr-0">
                                <p class="card-text"><i class="fa fa-clock-o text-green mr-2"></i>時數 <?= substr($course['duration'], 0, -3) ?> 分鐘</p>
                            </div>
                            <div class="col-auto">
                                <p class="card-text"><i class="fa fa-user text-green mr-2"></i><?= $course['stuCount'] ?> 同學</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php else : ?>
            <div class="col-md-12 mb-4">
                <h5>沒有資料。。。</h5>
            </div>
        <?php endif ?>
    </div>
    <div class="d-flex justify-content-center my-5">
        <a href="/course/choose/" class="btn bg-orange">選擇更多課程</a>
    </div>
</div>