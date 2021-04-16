<div class="container-md">

    <div class="titleJL marB0">
        <h1><?= $user['name'] ?>老師 開課清單</h1>
    </div>

    <div class="row">
        <?php foreach ($courseList as $course) : ?>
            <div class="col-6 col-xs-6 col-md-4 mb-4">
                <a href="/course/view/<?= $course['id'] ?>/">
                    <div class="card h-100 border-dark rounded-0">
                        <?php
                        $path = "course_data/" . $course['id'] . "/img/";
                        $imgs = array_diff(scandir($path), array('.', '..'));
                        ?>
                        <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                        <div class="card-body">
                            <h5 class="card-title"><?= $course['name'] ?></h5>
                            <p class="card-text"><?= $course['stuCount'] ?>同學</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>


</div>