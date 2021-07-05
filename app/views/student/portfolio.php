<script language='javascript'> 
    function showModal(type, id);
</script> 
<div class="container-md">

    <div class="titleJL marT30 marB0 textC">
        <h1>學習歷程檔案專區</h1>
    </div>

    <form action="." method="POST">
        <!-- tabStyleJL -->
        <div class="tabStyleJL p-md-5">
            <div class="row">  
                <div class="col-12 col-md">
                    <div class="titleJL">
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <h3>基本資料</h3>
                            <a href="/student/profile/">
                                <div class="btnJL py-1 px-3" style="width:fit-content; min-width:inherit;">填寫</div>
                            </a>
                        </div>  
                    </div>
                    <div class="form-group">
                        <div class="radioStyle1JL">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="profile-select" value="free" checked>
                                <label class="form-check-label"><?= $user['name'] ?> <span class="badge">(free)<span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="profile-select" value="VIP">
                                <label class="form-check-label"><?= $user['name'] ?> <span class="badge">(VIP)<span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="titleJL">
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <h3>自傳</h3>
                            <a data-toggle="modal" data-target="#autobiography-modal">
                                <div class="btnJL py-1 px-3" style="width:fit-content; min-width:inherit;">填寫</div>
                            </a>
                        </div>  
                    </div>
                    <div class="form-group">
                        <div class="radioStyle1JL">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="autobiography-select" value="free" checked>
                                <label class="form-check-label">自傳 <span class="badge">(free)<span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="autobiography-select" value="VIP">
                                <label class="form-check-label">自傳 <span class="badge">(VIP)<span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="titleJL">
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <h3>興趣測驗分析報告</h3>
                            <a href="/student/myScore/">
                                <div class="btnJL py-1 px-3" style="width:fit-content; min-width:inherit;">作答</div>
                            </a>
                        </div>  
                    </div>
                    <div class="form-group">
                        <div class="radioStyle1JL">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="score-select" value="free" checked>
                                <label class="form-check-label">興趣測驗分析書 <span class="badge">(free)<span></label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="score-select" value="VIP">
                                <label class="form-check-label">興趣測驗分析書 <span class="badge">(VIP)<span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tabStyleJL End. -->

        <div class="tabStyleJL">
            <div class="titleJL textC marT30">
                <h1>挑選課程</h1>
            </div>
            <table class="table sRecordTab">
                <tbody>
                    <?php if ($bougthCourses) : ?>
                        <tr style="cursor: pointer;" onclick="document.location = '/course/view/<?= $course['course'] ?>/';">
                            <th scope="row">
                                <?php foreach ($bougthCourses as $course) : ?>
                                    <div class="row p-3 mx-2">
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="course-select[]" value="<?= $course['id'] ?>" checked>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card h-100 border-dark rounded-0" id="link_view" onclick="window.location = '/course/view/<?= $course['course'] ?>/';">
                                                <?php
                                                $path = "course_data/" . $course['course'] . "/img/";
                                                $imgs = array_diff(scandir($path), array('.', '..'));
                                                ?>
                                                <img src="/course_data/<?= $course['course'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $course['name'] ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col align-self-center">
                                            <a href="/student/hw/<?= $course['id'] ?>/">
                                                <div class="btnJL">查看作業</div>
                                            </a>
                                            <a href="#">
                                                <a href="/student/cert/<?= $course['id'] ?>/">
                                                <div class="btnJL">課程數位認證</div>
                                            </a>
                                        </div>
                                        <div class="col-6 col-lg d-none d-md-block">
                                            <div class="titleJL mb-0">
                                                <div class="d-flex flex-row justify-content-center align-items-center text-center" style="height: 55px">
                                                    <h3>教師評語</h3>
                                                    <a onclick="showModal('feedback', <?= $course['id'] ?>)">
                                                        <div class="btnJL py-1 px-3" style="width:fit-content; min-width:inherit;">查看</div>
                                                    </a>
                                                </div>  
                                            </div>
                                            <textarea class="form-control bg-white" name="feedback<?= $course['id'] ?>" style="height: calc(100% - 55px);" readonly><?= $course['feedback'] ?></textarea>
                                        </div>
                                        <div class="col-6 col-lg d-none d-md-block">
                                            <div class="titleJL mb-0">
                                                <div class="d-flex flex-row justify-content-center align-items-center text-center"  style="height: 55px">
                                                    <h3>修課心得</h3>
                                                    <a onclick="showModal('thoughts', <?= $course['id'] ?>)">
                                                        <div class="btnJL py-1 px-3" style="width:fit-content; min-width:inherit;">編輯</div>
                                                    </a>
                                                </div>
                                            </div>
                                            <textarea class="form-control bg-white" name="thoughts<?= $course['id'] ?>" style="height: calc(100% - 55px);" readonly><?= $course['thoughts'] ?></textarea>
                                        </div>
                                        <div class="col d-block d-md-none">
                                            <a onclick="showModal('feedback', <?= $course['id'] ?>)">
                                                <div class="btnJL">教師評語</div>
                                            </a>
                                            <a onclick="showModal('thoughts', <?= $course['id'] ?>)">
                                                <div class="btnJL">修課心得</div>
                                            </a>
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

        </div>
        <!-- tabStyleJL End. -->
    
    <textarea class="d-none" name="scoreImg_base64"></textarea>
    <button class="btnJL textC mx-auto my-5" type="submit" name="download" style="width:fit-content; min-width:inherit;">下載學習歷程</button>
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
                        <button class="btnJL mx-auto" id="autobiography-btn" style="width:fit-content; display:block" data-dismiss="modal" >儲存</button>
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
                        <button class="btnJL mx-auto" style="width:fit-content; display:block" data-dismiss="modal" >儲存</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<input class="d-none" id="score" value="<?= $user['score'] ?>">
<canvas class="skills-radar" id="skills-radar"></canvas>





        <!-- <div class="titleJL marT30">
            <div class="row">
                <h3>購買學習幣</h3>
                <div class="btnJL col-3" style="width:fit-content"><a href="/student/profileEdit/?editPassword">填寫</a></div>
            </div>  
        </div>
        <div class="row justify-content-md-center">
            <form class="col-12 col-md-10" action="../buy_credit/" method="POST">
                <b class="marT20 marB20">我要新增學習幣量</b>
                <textarea class="form-control" name="description" rows="3"></textarea>
                <div class="middle_jl marB30">
                    <button type="submit" class="btnJL marL0">
                        信用卡付款
                    </button>
                </div>
            </form>
        </div> -->