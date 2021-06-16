<div class="tabStyleJL" style="background-color: inherit; margin-top: 0;">

    <div class="middle_jl">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">基本資料</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-record-tab" data-toggle="pill" href="#pills-record" role="tab" aria-controls="pills-record" aria-selected="true">消費紀錄</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-experience-tab" data-toggle="pill" href="#pills-experience" role="tab" aria-controls="pills-experience" aria-selected="false">學習歷程</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-log-tab" data-toggle="pill" href="#pills-log" role="tab" aria-controls="pills-log" aria-selected="false">Log歷史紀錄</a>
            </li>
        </ul>
    </div>

    <!-- tab main -->
    <div class="tab-content" id="pills-tabContent">
        <!-- tab1 -->
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="pad30" id="form">
                <div class="table-responsive">
                    <form id="course_form" action="." method="POST">
                        <div class="form-group">
                            <label>信箱</label>
                            <input type="text" class="form-control" name="account" value="<?= $stu['account'] ?>">
                        </div>
                        <div class="form-group">
                            <label>學生姓名</label>
                            <input type="text" class="form-control" name="name" value="<?= $stu['name'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>性別</label>
                            <select class="form-control" name="gender" required>
                                <option <?= ($stu['gender'] == 'M') ? 'selected=""' : '' ?> value="M">男</option>
                                <option <?= ($stu['gender'] == 'F') ? 'selected=""' : '' ?> value="F">女</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>學習幣</label>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">加值</button>
                            <input type="number" name="credit" class="form-control" value="<?= $stu['credit'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>學校</label>
                            <input type="text" name="school" class="form-control" value="<?= $stu['school'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>年級</label>
                            <input type="number" name="grade" min="1" max="3" class="form-control" value="<?= $stu['grade'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>生日</label>
                            <input type="text" id="birthday" name="birthday" class="form-control" value="<?= $stu['birthday'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>電話</label>
                            <input type="text" name="phone" class="form-control" value="<?= $stu['phone'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>地址</label>
                            <input type="text" name="address" class="form-control" value="<?= $stu['address'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>註冊日期</label>
                            <input type="text" class="form-control" value="<?= $stu['createdDate'] ?>" readonly="">
                        </div>
                        <div class="form-group">
            
                            <label>最後登入</label>
                            <input type="text" class="form-control" value="<?= $stu['lastLogin'] ?>" readonly="">
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary">確認修改</button>
                    </form>
                </div>

            </div>
        </div>
        <!-- tab1 End. -->

        <!-- tab2 -->
        <div class="tab-pane fade px-5" id="pills-record" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="titleJL marT30" id="record-1" data-toggle="collapse" data-target="#table-1" aria-expanded="false">
                <h3>學習幣購買紀錄</h3>
            </div>
            <table class="table sRecordTab collapse show" id="table-1" aria-labelledby="record-1" data-parent="#pills-record"">
                <tbody>
                    <?php if ($transactions) : ?>
                        <?php foreach ($transactions as $t) : ?>
                            <tr>
                                <th scope="row">
                                    <div class="media-body">
                                        <h5 class="marB10"><b>信用卡付款</b></h5>
                                        <?= date('Y/m/d', strtotime($t['transaction_time'])) ?>
                                    </div>
                                </th>
                                <td width="150">
                                    <div class="sunJL"><span class="roundIcon"></span><?= $t['amount'] ?></div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <th scope="row">
                                <div class="media-body">
                                    <h5 class="marB10"><b>尚無紀錄</b></h5>
                                </div>
                            </th>
                        </tr>
                    <?php endif ?>
                </tbody>

            </table>
            <div class="titleJL marT30" id="record-2" data-toggle="collapse" data-target="#table-2" aria-expanded="false">
                <h3>購課紀錄</h3>
            </div>
            <table class="table sRecordTab collapse show" id="table-2" aria-labelledby="record-2" data-parent="#pills-record"">
                <tbody>
                    <?php if ($bougthCourses) : ?>
                        <?php foreach ($bougthCourses as $course) : ?>
                            <tr style="cursor: pointer;" onclick="document.location = '/course/view/<?= $course['course'] ?>/';">
                                <th scope="row">
                                    <div class="marB10">課程購買日期: <?= date('Y/m/d', strtotime($course['bought_time'])) ?></div>
                                    <div class="media">
                                        <?php
                                        $path = "course_data/" . $course['course'] . "/img/";
                                        $imgs = array_diff(scandir($path), array('.', '..'));
                                        ?>
                                        <img src="/course_data/<?= $course['course'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                                        <div class="media-body">
                                            <h5 class="marB10"><b>學習幣付款</b></h5>
                                        </div>
                                    </div>
                                </th>
                                <td width="150">
                                    <div class="sunJL"><span class="roundIcon"></span><?= $course['price'] ?></div>
                                </td>
                            </tr>
                        <?php endforeach ?>
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


                    <!--<tr>
                        <th scope="row">
                            <div class="marB10">課程購買日期:2020/09/22</div>
                            <div class="media">
                                <img src="images/img.jpg" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="marB10"><b>信用卡付款</b></h5>
                                </div>
                            </div>

                        </th>
                        <td width="150">
                            <div class="sunJL"><span class="roundIcon"></span>2000</div>
                        </td>
                    </tr>-->

                </tbody>

            </table>
        </div>
        <!-- tab2 End. -->

        <!-- tab3 -->
        <div class="tab-pane fade px-5" id="pills-log" role="tabpanel" aria-labelledby="pills-contact-tab">
            <!-- <div class="titleJL textC marT0 marB0">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <form action=".">
                            <div class="btn-group" role="group" >
                            <button type="submit" name="order" class="btn border-dark <?= (!isset($_GET['order']) || $_GET['order'] == 'idA') ? 'active' : '' ?>" value="idA">舊至新</button>
                            <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'idD') ? 'active' : '' ?>" value="idD">新至舊</button>
                        </div>
                    </form>
                </div>
            </div> -->

            <table class="table table-bordered marT30">

                <thead>
                    <tr>
                        <th scope="col" width="18%">紀錄ID</th>
                        <th scope="col">使用者ID</th>
                        <th scope="col">身份</th>
                        <th scope="col">紀錄說明</th>
                        <th scope="col">時間</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $userType = ['1' => '學生', '2' => '老師', '3' => '管理員']; ?>
                    <?php foreach ($logs as $log) : ?>
                        <tr class="alert alert-dismissible fade show" role="alert">
                            <td scope="row">LOG-<?= $log['id'] ?></td>
                            <td scope="row"><?= $log['user'] ?></td>
                            <td scope="row"><?= $userType[$log['type']] ?></td>
                            <td scope="row"><?= $log['log'] ?></td>
                            <td scope="row"><?= $log['log_time'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>

        </div>
        <!-- tab3 End. -->

    </div>
    <!-- tab main End. -->

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">加值</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <form action="." method="POST">
                    <label>學習幣數量</label>
                    <div class="row">
                        <input type="number" class="form-control col-7 offset-1" min="0" name="add" placeholder="0" required="">
                        <input type="hidden" name="credit" value="<?= $stu['credit'] ?>">
                        <button type="submit" name="coin_add" class="btn btn-primary col-2 offset-1">送出</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>