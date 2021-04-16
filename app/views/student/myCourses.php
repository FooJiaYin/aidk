<div class="container-md">

    <div class="titleJL textC">
        <h1>我的課程</h1>
    </div>

    <div class="row">
        <?php if ($courses) : ?>
            <?php foreach ($courses as $course) : ?>
                <div class="col-6 col-xs-6 col-md-4 mb-4">
                    <a href="/course/view/<?= $course['id'] ?>/">
                        <div class="card h-100 border-dark rounded-0">
                            <?php
                            $path = "course_data/" . $course['id'] . "/img/";
                            $imgs = array_diff(scandir($path), array('.', '..'));
                            ?>
                            <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                            <div class="card-body">
                                <h5 class="mb-1">
                                    <div class="card textC rounded-pill border-dark inBlock pl-4 pr-4"><?= COURSE_CATEGORY[$course['category']] ?></div>
                                </h5>
                                <h5 class="card-title"><?= $course['name'] ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col-6 col-xs-6 col-md-4 mb-4">
                <h5>沒有資料。。。</h5>
            </div>
        <?php endif ?>
    </div>


</div>