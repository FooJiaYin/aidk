<div class="container score">
    <ul class="nav nav-fill my-4">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">測驗結果分析</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-interest-tab" data-toggle="pill" href="#pills-interest" role="tab" aria-controls="pills-interest" aria-selected="true">我的興趣類型</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">學習課程推薦</a>
        </li>
    </ul>

    <!-- tab main -->
    <div class="tab-content my-4">

        <!-- tab1 -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <h2 class="bar-left-green my-4">我的興趣分析雷達圖</h2>
            <div class="row">
                <div class="col-12 col-lg-6 my-3">
                    <canvas class="skills-radar w-100 h-100" id="skills-radar"></canvas>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="px-5 my-3">
                        <p>美國約翰‧霍普金斯大學心理學教授John Holland，於1959年開始陸續提出職業興趣理論及其延伸，將人格與職業興趣結合，分為六種類型。 受測者主要利用問卷調查來瞭解自己的性向，並根據分數而計算出個人對六種特質的偏好。</p>
                        <p>本測驗係以上述的生涯理論為基礎所發展而成的。他認為職業選擇是個人基於過去經驗的累積，加上人格特質的影響而做的抉擇，故同一職業會吸引有相同經驗與相似人格特質的人，職業上的適應與滿足也決定於人格和工作環境的適配度。以下為Holland所提的一些理論假設：</p>
                        <ol>
                            <li>人的個性與工作環境皆可區分為六種類型：<span class="no-wrap">企業型（E）、</span><span class="no-wrap">研究型（I）、</span><span class="no-wrap">事務型（C）、</span><span class="no-wrap">社會型（S）、</span><span class="no-wrap">實用型（R）、</span><span class="no-wrap">藝術型（A）。</span></li>
                            <li>找到與自己類型一致的環境，會生活得較為滿意，學業、工作起來會更容易感受到勝任愉快</li>
                        </ol>
                    </div>                    
                    <center>
                        <a href="/survey/instructions/" class="btn bg-orange mt-5">重新測驗</a>
                    </center>
                </div>
            </div>
        </div>
        <!-- tab1 End. -->

        <!-- tab2 -->
        <div class="tab-pane fade" id="pills-interest" role="tabpanel" aria-labelledby="pills-interest-tab">
            <h2 class="bar-left-green my-4">我的興趣類型</h2>
            <h3 class="font-weight-bold">你的興趣類型為：
                <span class="text-green font-weight-bolder">
                    <?= $interestType[0]['name'][0] ?><?= $interestType[1]['name'][0] ?><?= $interestType[2]['name'][0] ?>
                </span>
            </h3>
            <h3 class="font-weight-bold mb-5">適合的學群含：
                <span class="text-green font-weight-bolder">
                    <?php foreach ($recCategories as $category) : ?>
                    <?= COURSE_CATEGORY[$category] ?>
                    <?php endforeach ?>
                </span>
            </h3>
            <?php for ($i = 0; $i < 3; $i++) : ?>
            <div class="row my-4">
                <div class="col-12 col-lg-5 interest-name bar-left-orange">
                    <h2 class="mb-2"><?= $interestType[$i]['name'] ?></h2>
                    <div class="row no-gutters align-items-center">
                        <div class="col-9">
                            <div class="progress">
                                <div class="progress-bar bg-green" style="width:<?= $interestType[$i]['prop'] ?>%"></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <h2 class="mb-0 text-center"><?= $interestType[$i]['prop'] ?>%</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <p><?= $interestType[$i]['desc'] ?></p>
                </div>                
            </div>
            <?php endfor ?>
        </div>
        <!-- tab2 End. -->

        <!-- tab3 -->
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <h2 class="bar-left-green my-4">根據興趣分析，推薦自主學習課程：</h2>            
            <div class="row my-5" data-aos="fade-up">
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

        </div>
        <!-- tab3 End. -->

    </div>
    <!-- tab main End. -->

</div>

<input type="hidden" id="score" value="<?= $user['score'] ?>">