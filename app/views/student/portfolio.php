<script language='javascript'> 
    function showModal(type, id);
</script> 

<?php if (isset($_GET['intro'])) : ?>
<div class="container">
    <div class="row justify-content-center align-items-center my-5">        
        <div class="d-md-none col-9 mb-4">
            <img class="img-fluid" src="/static/images/index-portfolio.png">
        </div>
        <div class="col-12 col-md">
            <h2 class="bar-left-orange">如何做一份吸睛的學習歷程？</h2>
            <p>想像一下如果自己是位教授，面對數以百計、堆疊如山的學習歷程檔案，你會想先從哪份開始看起？會是封面封底精美絕倫的那份嗎？或是圖片數量目不暇給的那份呢？還是文字內容詳盡精實的那份呀？</p>
        </div>
        <div class="d-none d-md-block col-4">
            <img class="img-fluid" src="/static/images/index-portfolio.png">
        </div>
    </div>
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-9 col-md-4 mb-4">
            <img class="img-fluid" src="/static/images/index-portfolio-placeholder.png">
        </div>
        <div class="col-12 col-md">
            <h2 class="bar-left-orange">學校沒教的事</h2>
            <p>傳說中，教授會用電風扇吹學生的考卷，看誰飛得遠來決定分數高低…，別再相信沒有根據的說法了！<br>
            學習歷程檔案包含六個項目，分別為：基本資料、修課紀錄、課程學習成果、多元表現、學習歷程自述、其他個別校系指定之資料。比起以往的備審資料，更多了以下三個重點：</p>
            <p>一、強調學習成果<br>
                二、納入綜整心得呈現<br>
                三、提早探索生涯興趣</p>
            <p>換句話說，必須讓教授可以透過你的學習歷程檔案，清楚了解你為了上這個科系所做的努力，舉凡過去曾規劃學些什麼、學了什麼、學到什麼，以及所有相關的學習心得、成果心得等，將自己的學習經歷明確地與該科系的關聯性綁在一起。而為了達到這個目的，你必須提早開始規畫、探索與實踐，不再是靠臨時抱佛腳就能應付得來了！</p>
            <p>過去的備審資料總是強調數量要夠多，但學習歷程檔案可不是這樣。由於受理總數一開始就受限，必須針對上傳項目與學校科系要求做取捨，而內容更是重質不重量，因此不用怕項目少，在有限的數量內清楚且具體地展現學習成果，方為上策。</p>
        </div>
    </div>
    <div class="row justify-content-center align-items-center my-4">
        
        <div class="d-md-none col-9 mb-4">
            <img class="img-fluid" src="/static/images/index-portfolio-placeholder.png">
        </div>
        <div class="col-12 col-md">
            <h2 class="bar-left-orange">製作學習歷程只要簡單幾個步驟</h2>
            <p>在AIDK製作學習歷程，只要在完成課程後，依照指示勾選資料、填入內容、指定項目、撰寫心得、確認無誤後，就可以一鍵生成，匯出一套專屬你的學習歷程參考檔案，讓你在後續深度優化內容時也不再是難關！</p>
        </div>
        <div class="d-none d-md-block col-4">
            <img class="img-fluid" src="/static/images/index-portfolio-placeholder.png">
        </div>
    </div>
    <center>
        <a href="/student/portfolio/" class="btn bg-orange my-5">
            立刻製作學習歷程 <i class="fa fa-arrow-circle-right ml-2"></i>
        </a>
    </center>
</div>

<?php else : ?>
<div class="container">
    <form action="." method="POST" target="_blank" >
        <section id="portfolio-info-section" class="my-4 font-weight-bold">
        
            <h1 class="bar-left-green mt-5 mb-4">學習歷程檔案</h1>
        
            <div class="row my-2">  
                <div class="col-12 col-md">
                    <a class="d-flex flex-row justify-content-center align-items-center my-4" href="/student/profile/">
                        <h2 class="bar-bottom mb-0 mx-auto">基本資料</h2>
                        <i class="fa fa-pencil text-orange"></i>
                    </a>  
                    <div class="form-group bg-light-green p-4">
                        <div class="radioStyle1JL">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="profile-select" value="free" checked>
                                <label class="form-check-label"><?= $user['name'] ?> <span class="badge ml-2 bg-green">free<span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="profile-select" value="VIP">
                                <label class="form-check-label"><?= $user['name'] ?> <span class="badge ml-2 bg-orange">VIP<span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <a class="d-flex flex-row justify-content-center align-items-center my-4" data-toggle="modal" data-target="#autobiography-modal">
                        <h2 class="bar-bottom mb-0 mx-auto">自傳</h2>
                        <i class="fa fa-pencil text-orange"></i>
                    </a>  
                    <div class="form-group bg-light-green p-4">
                        <div class="radioStyle1JL">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="autobiography-select" value="free" checked>
                                <label class="form-check-label">自傳 <span class="badge ml-2 bg-green">free<span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="autobiography-select" value="VIP">
                                <label class="form-check-label">自傳 <span class="badge ml-2 bg-orange">VIP<span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <a class="d-flex flex-row justify-content-center align-items-center my-4" href="/student/myScore/">
                        <h2 class="bar-bottom mb-0 mx-auto">興趣測驗分析報告</h2>
                        <i class="fa fa-pencil text-orange"></i>
                    </a>  
                    <div class="form-group bg-light-green p-4">
                        <div class="radioStyle1JL">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="score-select" value="free" checked>
                                <label class="form-check-label">興趣測驗分析書 <span class="badge ml-2 bg-green">free<span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="score-select" value="VIP">
                                <label class="form-check-label">興趣測驗分析書 <span class="badge ml-2 bg-orange">VIP<span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="portfolio-course-section">
            <center class="justify-content-center">

                <h2 class="bar-bottom">挑選課程</h2>
            </center>
            <table class="table">
                <tbody>
                    <?php if ($bougthCourses) : ?>
                        <tr style="cursor: pointer;" onclick="document.location = '/course/view/<?= $course['course'] ?>/';">
                            <th scope="row">
                                <?php foreach ($bougthCourses as $course) : ?>
                                    <div class="row px-3 mx-2 my-3">
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="course-select[]" value="<?= $course['course'] ?>" checked>
                                        </div>
                                        
                                        <div class="col-12 col-sm col-lg-3 mb-4">
                                            <div class="card course-card h-100 border-0 shadow" id="link_view" onclick="window.location = '/course/view/<?= $course['course'] ?>/';">
                                                <?php
                                                $path = "course_data/" . $course['course'] . "/img/";
                                                $imgs = array_diff(scandir($path), array('.', '..'));
                                                ?>
                                                <img src="/course_data/<?= $course['course'] ?>/img/<?= $imgs[2] ?>" class="card-img-top h-50" alt="圖">
                                                <div class="card-body pt-2">
                                                    <div class="text-ellipsis">
                                                    <!-- <?php foreach ($course['category'] as $category) : ?>
                                                        <a href="/course/category/<?= $category ?>/">
                                                            <div class="badge ml-2 bg-green rounded-pill course-tag">
                                                                    <?= COURSE_CATEGORY[$category] ?>
                                                            </div>
                                                        </a>
                                                    <?php endforeach ?> -->
                                                    </div>
                                                    <h5 class="card-title mt-2"><?= (strlen($course['name']) > 60) ? mb_substr($course['name'], 0, 19) . "..." : $course['name'] ?></h5>
                                                    <!-- <div class="row justify-content-between align-items-end">
                                                        <div class="col-auto pr-0">
                                                            <p class="card-text"><i class="fa fa-clock-o text-green mr-2"></i>時數 <?= substr($course['duration'], 0, -3) ?> 分鐘</p>
                                                        </div>
                                                        <div class="col-auto">
                                                            <p class="card-text"><i class="fa fa-user text-green mr-2"></i><?= $course['stuCount'] ?> 同學</p>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-auto d-flex d-sm-block align-self-center px-md-4 mb-4">
                                            <div class="px-2 px-sm-0 flex-fill">
                                                <a href="/student/hw/<?= $course['id'] ?>/" class="d-block my-4 btn-short bg-white">
                                                    <i class="fa fa-file-text text-green mr-2"></i>查看作業
                                                </a>
                                                <a href="/student/cert/<?= $course['id'] ?>/" target="_blank" class="d-block btn btn-short bg-orange my-4">
                                                    <i class="d-none d-sm-inline fa fa-certificate text-white mr-2"></i>
                                                    下載數位認證
                                                </a>
                                            </div>
                                            <div class="px-2 px-sm-0 flex-fill">
                                                <a class="btn btn-short bg-green d-block d-md-none my-4" onclick="showModal('feedback', <?= $course['id'] ?>)">
                                                    教師評語
                                                </a>
                                                <a class="btn btn-short bg-green d-block d-md-none my-4" onclick="showModal('thoughts', <?= $course['id'] ?>)">
                                                    修課心得
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg d-none d-md-block mb-4 pl-5 pl-lg-0">
                                            <a class="d-flex flex-row justify-content-between align-items-center bg-green p-2" onclick="showModal('feedback', <?= $course['id'] ?>)">
                                                <h2 class="mb-0">教師評語</h2>
                                                <i class="fa fa-eye text-white"></i>
                                            </a>  
                                            <textarea class="form-control bg-white" name="feedback<?= $course['id'] ?>" style="height: calc(100% - 55px);" readonly><?= $course['feedback'] ?></textarea>
                                        </div>
                                        <div class="col-6 col-lg d-none d-md-block mb-4">
                                            <a class="d-flex flex-row justify-content-between align-items-center bg-green p-2" onclick="showModal('thoughts', <?= $course['id'] ?>)">
                                                <h2 class="mb-0">修課心得</h2>
                                                <i class="fa fa-pencil text-white"></i>
                                            </a> 
                                            <textarea class="form-control bg-white" name="thoughts<?= $course['id'] ?>" style="height: calc(100% - 55px);" readonly><?= $course['thoughts'] ?></textarea>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </th>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <th scope="row">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="marB10"><b>尚無紀錄</b></h5>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    <?php endif ?>
                </tbody>

            </table>

            
            <textarea class="d-none" name="scoreImg_base64"></textarea>
            <center>
                <button class="btn bg-green mb-5" type="submit" name="download">下載學習歷程</button>
            </center>
        </section>
    </form>
</div>

<div class="modal fade" id="autobiography-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title terms_title mx-auto" id="exampleModalLongTitle">自傳</h5>
                <button type="button" class="close" style="margin:-1rem;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <div class="table-responsive">
                    <form id="autobiography-form">
                        <textarea class="form-control" name="autobiography" rows="12" style="height: 40vh;"><?= $user['autobiography'] ?></textarea>
                        <button class="btn bg-green mt-4 mb-3 mx-auto" id="autobiography-btn" style="width:fit-content; display:block" data-dismiss="modal" >儲存</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title terms_title mx-auto" id="exampleModalLongTitle">教師評語</h5>
                <button type="button" class="close" style="margin:-1rem;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <div class="table-responsive">
                    <!-- <form action="save" method="POST">
                        <div class="form-group"> -->
                            <textarea class="form-control bg-white" name="feedback" rows="12" style="height: 40vh;" readonly></textarea>
                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="thoughts-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title terms_title mx-auto" id="exampleModalLongTitle">修課心得</h5>
                <button type="button" class="close" style="margin:-1rem;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <div class="table-responsive">
                    <!-- <form action="save" method="POST">
                        <div class="form-group"> -->
                            <textarea class="form-control bg-white" name="thoughts" rows="12" style="height: 40vh;"></textarea>
                        <!-- </div> -->
                        <button class="btn bg-green mt-4 mb-3 mx-auto" style="width:fit-content; display:block" data-dismiss="modal" >儲存</button>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<input class="d-none" id="score" value="<?= $user['score'] ?>">
<canvas class="skills-radar" id="skills-radar"></canvas>

<?php endif; ?>




        <!-- <div class="titleJL marT30">
            <div class="row">
                <h3>購買學習幣</h3>
                <div class="btn bg-green mt-4 mb-3 col-3" style="width:fit-content"><a href="/student/profileEdit/?editPassword">填寫</a></div>
            </div>  
        </div>
        <div class="row justify-content-md-center">
            <form class="col-12 col-md-10" action="../buy_credit/" method="POST">
                <b class="marT20 marB20">我要新增學習幣量</b>
                <textarea class="form-control" name="description" rows="3"></textarea>
                <div class="middle_jl marB30">
                    <button type="submit" class="btn bg-green mt-4 mb-3 marL0">
                        信用卡付款
                    </button>
                </div>
            </form>
        </div> -->