<div class="container-md">
    <?php if ($category) : ?>
        <div class="titleJL">
            <h1><?= COURSE_CATEGORY[$category] ?></h1>
        </div>
    <?php endif ?>
    <div class="row">
        <?php if ($courses) : ?>
            <?php foreach ($courses as $course) : ?>
                <div class="col-6 col-xs-6 col-md-4 mb-4">
                    <div class="card h-100 border-dark rounded-0" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                        <?php
                        $path = "course_data/" . $course['id'] . "/img/";
                        $imgs = array_diff(scandir($path), array('.', '..'));
                        ?>
                        <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                        <div class="row">
                            <div class="col-6">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $course['name'] ?></h5>
                                    <p class="card-text"><?= $course['stuCount'] ?>同學</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-body text-right">
                                    <h5 class="mb-1">
                                        <div class="card textC rounded-pill border-dark course_sort"><a href="/course/category/<?= $course['category'] ?>/"><?= COURSE_CATEGORY[$course['category']] ?></a></div>
                                    </h5>
                                    <!--<h5>$<?= $course['price'] ?></h5>-->
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

</div>