<div class="container-md">

    <!-- tabStyleJL -->
    <div class="tabStyleJL">

        <div class="middle_jl marT50 marB30">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">測驗結果</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">興趣類型</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">自主學習課程推薦</a>
                </li>
            </ul>
        </div>

        <!-- tab main -->
        <div class="tab-content" id="pills-tabContent">

            <!-- tab1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <div class="tab1Box">
                    <div class="btnJL fr_jl" style="position: relative;z-index: 999;"><a href="/survey/instructions/">重新測驗</a></div>
                    <canvas class="skills-radar" id="skills-radar"></canvas>
                </div>

            </div>
            <!-- tab1 End. -->

            <!-- tab2 -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <div class="px-5 my-3">
                    <!--
                        資訊學群 R I
                        工程學群 R I
                        數理化學群 I
                        醫藥衛生學群 I R S
                        生命科學學群 I
                        生物資源學群 I R
                        地球環境學群 I R
                        建築設計學群 A R
                        藝術學群 A
                        社會心理學群 A S
                        大眾傳播學群 A S
                        外語學群 A S
                        文史哲學群 A S
                        教育學群 S
                        法政學群 S E
                        管理學群 S E
                        財經學群 E C
                        遊憩運動學群 E S
                    -->
                    <h3 class="px-5">你的興趣類型為：<?= $interestType[0]['name'][0] ?><?= $interestType[1]['name'][0] ?><?= $interestType[2]['name'][0] ?></h3>
                    <h3 class="px-5">適合的學群含：
                        <?php foreach ($recCategories as $category) : ?>
                            <?= COURSE_CATEGORY[$category] ?>
                        <?php endforeach ?>
                    </h3>
                </div>
                <div class="tab2Box">
                    <div id="score_top1" class="progressBox">
                        <h3><?= $interestType[0]['name'] ?></h3>
                        <div class="row">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar" style="width:<?= $interestType[0]['prop'] ?>%"></div>
                                </div>
                            </div>
                            <div class="col-3 h1">
                                <?= $interestType[0]['prop'] ?>%
                            </div>
                        </div>
                        <div class="txtJL">
                            <?= $interestType[0]['desc'] ?>
                        </div>
                    </div>
                    <div id="score_top2" class="progressBox">
                        <h3><?= $interestType[1]['name'] ?></h3>
                        <div class="row">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar" style="width:<?= $interestType[1]['prop'] ?>%"></div>
                                </div>
                            </div>
                            <div class="col-3 h1">
                                <?= $interestType[1]['prop'] ?>%
                            </div>
                        </div>
                        <div class="txtJL">
                            <?= $interestType[1]['desc'] ?>
                        </div>
                    </div>
                    <div id="score_top3" class="progressBox">
                        <h3><?= $interestType[2]['name'] ?></h3>
                        <div class="row">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar" style="width:<?= $interestType[2]['prop'] ?>%"></div>
                                </div>
                            </div>
                            <div class="col-3 h1">
                                <?= $interestType[2]['prop'] ?>%
                            </div>
                        </div>
                        <div class="txtJL">
                            <?= $interestType[2]['desc'] ?>
                        </div>
                    </div>

                </div>

            </div>
            <!-- tab2 End. -->

            <!-- tab3 -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                <div class="row">
                    <?php foreach ($courses as $c) : ?>
                        <div class="col-6 col-xs-6 col-md-4 mb-4">
                            <a href="/course/view/<?= $c['id'] ?>/">
                                <div class="card h-100 border-dark rounded-0">
                                    <?php
                                    $path = "course_data/" . $c['id'] . "/img/";
                                    $imgs = array_diff(scandir($path), array('.', '..'));
                                    ?>
                                    <img src="/course_data/<?= $c['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                                    <div class="card-body">
                                        <h6 class="mb-1">
                                            <?php foreach ($c['category'] as $category) : ?>
                                                <div class="card textC rounded-pill border-dark inBlock pl-1 pr-1"><?= COURSE_CATEGORY[$category] ?></div>
                                            <?php endforeach ?>
                                            <!--<div class="card textC rounded-pill border-dark inBlock pl-1 pr-1">XX學系</div>-->
                                        </h6>
                                        <h4 class="card-title"><?= $c['name'] ?></h4>
                                        <p class="card-text"><?= nl2br($c['description']) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
            <!-- tab3 End. -->

        </div>
        <!-- tab main End. -->

    </div>
    <!-- tabStyleJL End. -->

</div>

<input type="hidden" id="score" value="<?= $user['score'] ?>">