<div class="tabStyleJL" style="background-color: inherit; margin-top: 0;">

    <div class="middle_jl">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= (!isset($_GET['tab']) || $_GET['tab'] == 'profile') ? 'active' : '' ?>" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">基本資料</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'courses') ? 'active' : '' ?>" id="pills-courses-tab" data-toggle="pill" href="#pills-courses" role="tab" aria-controls="pills-record" aria-selected="true">課程資料</a>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-experience-tab" data-toggle="pill" href="#pills-analysis" role="tab" aria-controls="pills-analysis" aria-selected="false">分潤分析</a>
            </li> -->
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'log') ? 'active' : '' ?>" id="pills-log-tab" data-toggle="pill" href="#pills-log" role="tab" aria-controls="pills-log" aria-selected="false">Log歷史紀錄</a>
            </li>
        </ul>
    </div>

    <!-- tab main -->
    <div class="tab-content" id="pills-tabContent">
        <!-- tab1 -->
        <div class="tab-pane fade <?= (!isset($_GET['tab']) || $_GET['tab'] == 'profile') ? 'show active' : '' ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="pad30" id="form">
                <div class="table-responsive">
                    <form id="course_form" action="." method="POST">
                        <div class="form-group">
                            <label>帳號</label>
                            <input type="text" class="form-control" value="<?= $teacher['account'] ?>" readonly="">
                        </div>
                        <div class="form-group">
                            <label>老師姓名</label>
                            <input type="text" class="form-control" name="name" value="<?= $teacher['name'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>性別</label>
                            <select class="form-control" name="gender" required>
                                <option <?= ($teacher['gender'] == 'M') ? 'selected=""' : '' ?>>M</option>
                                <option <?= ($teacher['gender'] == 'F') ? 'selected=""' : '' ?>>F</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>信箱</label>
                            <input type="email" name="email" class="form-control" value="<?= $teacher['email'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label>註冊日期</label>
                            <input type="text" class="form-control" value="<?= $teacher['createdDate'] ?>" readonly="">
                        </div>
                        <div class="form-group">
                            <label>最後登入</label>
                            <input type="text" class="form-control" value="<?= $teacher['lastLogin'] ?>" readonly="">
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary">確認修改</button>
                    </form>
                </div>

            </div>
        </div>
        <!-- tab1 End. -->

        <!-- tab2 -->
        <div class="tab-pane fade px-5  <?= (isset($_GET['tab']) && $_GET['tab'] == 'courses') ? 'show active' : '' ?>" id="pills-courses" role="tabpanel" aria-labelledby="pills-courses-tab">
            <table class="table table-bordered marT30">
                <thead>
                    <tr>
                        <th scope="col" width="18%">課程名稱</th>
                        <th scope="col">課程費用</th>
                        <th scope="col">學生人數</th>
                        <th scope="col">課程總收入</th>
                        <th scope="col" class="widthMax">功能</th><!-- 20201128 修改 class加上 -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courseList as $course) : ?>
                        <tr class="alert alert-dismissible fade show" role="alert">
                            <th scope="row"><?= $course['name'] ?></th>
                            <th scope="row"><?= $course['price'] ?></th>
                            <th scope="row"><?= $course['stuCount'] ?></th>
                            <th scope="row"><?= $course['price'] * $course['share'] * $course['stuCount'] ?></th>
                            <td>
                                <div class="row m10">
                                    <div class="col-6">
                                        <a href="/admin/courseEdit/<?= $course['id'] ?>/?teacher=<?= $teacher['id'] ?>" class="btn btn-outline-dark btn-block badge-pill">詳細資料</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/admin/analysis/<?= $course['id'] ?>/?teacher=<?= $teacher['id'] ?>" class="btn btn-outline-dark btn-block badge-pill">分析</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/admin/hw/<?= $course['id'] ?>/?teacher=<?= $teacher['id'] ?>" class="btn btn-outline-dark btn-block badge-pill">學生作業</a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-outline btn-danger btn-block badge-pill del-course" style="color:#FFF;" data-id="<?= $course['id'] ?>" data-name="<?= $course['name'] ?>">刪除</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
        <!-- tab2 End. -->

        <!-- tab3 -->
        <div class="tab-pane fade px-5  <?= (isset($_GET['log']) && $_GET['log'] == 'record') ? 'show active' : '' ?>" id="pills-log" role="tabpanel" aria-labelledby="pills-contact-tab">
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

</div>