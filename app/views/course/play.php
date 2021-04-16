<div class="container-xl">

    <div class="row">
        <div class="col-12 col-xs-8 col-md-8 col-xl-9 order-1 order-md-0">
            <!-- banner -->
            <section class="top-banner slider">
                <div>
                    <video style="width:100%; max-width:100%;" controls controlsList="nodownload">
                        <source src="/course_data/<?= $course['id'] ?>/videos/<?= $video ?>" type="video/mp4">
                        此瀏覽器不支援本網站的影片播放，請改用她款瀏覽器。
                    </video>
                </div>
            </section>
            <!-- banner end. -->

            <ul class="list-unstyled teacherReply marB50">
                <li class="media">
                    <div class="align-self-center">
                        <i class="fa fa-user-circle mr-3"></i>
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
                                <i class="fa fa-<?= ($comment['isTeacher']) ? 'microphone' : 'user-circle' ?> mr-3"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><?= $comment['content'] ?></h5>
                                <small><?= $comment['comment_time'] ?></small>
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

        <div class="col-12 col-xs-4 col-md-4 col-xl-3 order-0 order-md-1">

            <div class="titleJL marT0 marB0">
                <h4>課程內容</h4>
            </div>

            <div class="overflow-auto classRight">

                <table class="table table-hover marB0 chapter-table">
                    <?php foreach ($course['chapter'] as $ckey => $chap) : ?>
                        <thead>
                            <tr class="thead-light">
                                <th scope="col"><?= $chap['name'] ?></th>
                                <th scope="col" width="60"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($chap['section'] as $skey => $sec) : ?>
                                <tr onclick="document.location = '/course/play/<?= $course['id'] ?>/?chapter=<?= $ckey ?>&section=<?= $skey ?>';" style="cursor:pointer;">
                                    <th scope="row"><a href="/course/play/<?= $course['id'] ?>/?chapter=<?= $ckey ?>&section=<?= $skey ?>"><?= $sec['name'] ?></a></th>
                                    <td><?= $sec['duration'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    <?php endforeach ?>
                </table>


            </div>
            <?php if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 1) : ?>
                <?php if ($isBought['hw_uploaded']) : ?>
                    <div class="btnJL mar0 textL padL10 padR10"><a href="/course/download_cert/<?= $course['id'] ?>/" target="_blank">下載課程證書</a></div>
                <?php else : ?>
                    <div class="btnJL mar0 textL padL10 padR10"><a href="/course/hw_upload/<?= $course['id'] ?>/">上傳作業</a></div>
                <?php endif ?>
            <?php endif ?>
        </div>


    </div>