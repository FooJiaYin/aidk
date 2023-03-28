<section id="course-video-section" class="d-md-none my-5">
    <div class="mb-5 container">
        <h2 class="bar-left-orange">課程影片</h2>
        <?php if(is_file("course_data/".$course['id']."/intro.mp4")): ?>
        <video class="img-fluid border-white" controls  disablepictureinpicture  controlsList="nodownload">
            <source src="/course_data/<?= $course['id'] ?>/videos/<?= $video ?>" type="video/mp4">
            此瀏覽器不支援本網站的影片播放，請改用她款瀏覽器。
        </video>
        <?php endif ?>
    </div>
</section>
<div id="course-play" class="bg-light-green">

<div class="container-lg py-5 pr-md-5">
    
    <div class="row">
        <div class="col-12 col-md-4 pr-md-4">
            <div class="row mx-0">
                <div class="col-12 col-sm-6 col-md-12">
                    <h2 class="bar-left-orange">課程内容</h2>
                    <div class="accordion mb-4" id="accordionExample">
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
                                <div class="row no-gutters justify-content-between">
                                    <div class="col"><?= $sec['name'] ?></div>
                                    <div class="col-auto"><?= $sec['duration'] ?></div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-12">
                    <?php if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 1) : ?>
                        <h2 class="bar-left-orange mb-4">我的作業</h2>
                        <center>
                            <a class="btn bg-green justify-self-center" href="/course/hw_upload/<?= $course['id'] ?>/">上傳作業</a>
                        </center>
                        <div class="accordion my-3" id="accordionExample">
                            <div class="card">
                                <a class="text-left" type="button" data-toggle="collapse" data-target="#collapse-hw" aria-expanded="true" aria-controls="collapse-hw">
                                    <div class="card-header" id="heading-hw">
                                        <div class="mb-0">
                                            已上傳作業
                                        </div>
                                    </div>
                                </a>
        
                                <div id="collapse-hw" class="collapse show" aria-labelledby="heading-hw>">
                                    <?php foreach ($hwList as $hw) : ?>
                                    <a class="row no-gutters justify-content-between" href="/student/hw/<?= $courseBought['id'] ?>">
                                        <div class="col text-ellipsis"><?= $hw['name'] ?></div>
                                        <div class="col-auto"><?= substr($hw['uploaded_time'], 0, 10) ?></div>
                                    </a>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    
                        <?php if ($isBought['hw_uploaded']) : ?>
                            <div class="text-center">
                                <a class="btn bg-green my-2" href="/student/cert/<?= $courseBought['id'] ?>/" target="_blank">下載課程證書</a>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="d-none d-md-block col-8 px-4 bg-white">
            <!-- banner -->
            <div class="py-5">
                <?php if(is_file("course_data/".$course['id']."/intro.mp4")): ?>
                <video class="img-fluid border-white" controls  disablepictureinpicture  controlsList="nodownload">
                    <source src="/course_data/<?= $course['id'] ?>/videos/<?= $video ?>" type="video/mp4">
                    此瀏覽器不支援本網站的影片播放，請改用她款瀏覽器。
                </video>
                <?php endif ?>
            </div>
            <!-- banner end. -->
            <h2 class="bar-left-orange mb-4">討論區</h2>
            <ul class="list-unstyled comments">
                <li class="media">
                    <div class="align-self-center">
                        <i class="fa fa-user-circle mr-3 text-orange"></i>
                    </div>
                    <div class="media-body">
                        <form action="/course/comment/<?= $course['id'] ?>/?chapter=<?= $chapter ?>&section=<?= $section ?>" method="POST">
                            <input type="text" class="form-control" name="content" placeholder="發問..." required="">
                        </form>
                    </div>
                </li>
                <?php if ($comments) : ?>
                    <?php foreach ($comments as $comment) : ?>
                        <li class="media">
                            <div class="align-self-center">
                                <i class="fa fa-<?= ($comment['isTeacher']) ? 'microphone' : 'user-circle' ?> mr-3 text-orange"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><?= $comment['content'] ?></h5>
                                <div class="d-flex justify-content-between">

                                    <small><?= $comment['user'] ?></small>
                                    <small><?= $comment['comment_time'] ?></small>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                <?php else : ?>
                    <li class="media">
                        <div class="align-self-center">
                            <i class="fa fa-commenting mr-3"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">尚無留言。。。</h5>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
        <div class="d-md-none col-12" style="padding: 30px;">
            <h2 class="bar-left-orange mb-4">討論區</h2>
            <ul class="list-unstyled comments p-4 bg-white">
                <li class="media">
                    <div class="align-self-center">
                        <i class="fa fa-user-circle mr-3 text-orange"></i>
                    </div>
                    <div class="media-body">
                        <form action="/course/comment/<?= $course['id'] ?>/?chapter=<?= $chapter ?>&section=<?= $section ?>" method="POST">
                            <input type="text" class="form-control" name="content" placeholder="發問..." required="">
                        </form>
                    </div>
                </li>
                <?php if ($comments) : ?>
                    <?php foreach ($comments as $comment) : ?>
                        <li class="media">
                            <div class="align-self-center">
                                <i class="fa fa-<?= ($comment['isTeacher']) ? 'microphone' : 'user-circle' ?> mr-3 text-orange"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><?= $comment['content'] ?></h5>
                                <div class="d-flex justify-content-between">

                                    <small><?= $comment['user'] ?></small>
                                    <small><?= $comment['comment_time'] ?></small>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                <?php else : ?>
                    <li class="media">
                        <div class="align-self-center">
                            <i class="fa fa-commenting mr-3"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">尚無留言。。。</h5>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    
    </div>
</div>
</div>
