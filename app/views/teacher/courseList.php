<div class="container-md">

    <div class="titleJL marB0">
        <h1><?= $user['name'] ?>老師 開課清單</h1>
    </div>

    <div class="row">
        <?php foreach ($courseList as $course) : ?>
            <div class="col-6 col-xs-6 col-md-4 mb-4">
                <div class="card h-100 border-dark rounded-0">
                    <?php
                        $path = "course_data/" . $course['id'] . "/img/";
                        $imgs = array_diff(scandir($path), array('.', '..'));
                        ?>
                    <a href="/course/view/<?= $course['id'] ?>/">
                        <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                    </a>
                    <div class="row">
                        <div class="col-8">
                            <a href="/course/view/<?= $course['id'] ?>/">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $course['name'] ?></h5>
                                    <p class="card-text"><?= $course['stuCount'] ?>同學</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <div class="card-body text-right">
                                <h5 class="mb-1">
                                    <div class="card textC rounded-pill border-dark course_sort">
                                        <a href="/teacher/analysis/<?= $course['id'] ?>/">分析</a>
                                    </div>
                                </h5>
                            </div>
                            <div class="card-body text-right">
                                <h5 class="mb-1">
                                    <div class="card textC rounded-pill border-dark course_sort">
                                        <a href="/teacher/hw/<?= $course['id'] ?>/">作業</a>
                                    </div>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>


</div>