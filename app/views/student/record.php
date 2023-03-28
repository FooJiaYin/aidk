<div class="container profile">
    <div class="row info-cover no-gutters px-md-5 my-4">
        <div class="col-auto">
            <img src="/static/images/img_profile.svg">
        </div>
        <div class="col px-4">
            <h3><?= $user['name'] ?></h3>
        </div>
        <div class="col-12 col-md-2 d-flex flex-md-column mt-3 text-center justify-content-center">
            <h5><i class="fa fa-money text-orange mr-2 font-weight-normal"></i>學習幣</h5>
            <h2 class="mx-3 mb-0"><?= $user['credit'] ?></h2>
        </div>
    </div>
    <ul class="nav nav-fill my-5 mx-7">
        <li class="nav-item">
            <a class="nav-link ml-auto active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">儲值紀錄</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">購課紀錄</a>
        </li>
    </ul>
    <div class="tab-content my-5" id="pills-tabContent">

        <!-- tab1 -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form id="buy-credit" action="../buy_credit/" method="POST">
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center my-5">
                    <h2 class="mr-3 my-2">儲值</h2>
                    <input type="number" class="form-control my-2" name="amount" placeholder="填入數量" required="">
                    <button type="submit" class="btn bg-green m-2">付款</button>
                    <!-- <?php if (!isset($_GET['buyCredit'])) : ?>
                        <a href="/student/record/?buyCredit" class="btn bg-green">儲值</a>
                    <?php else : ?> 
                        <h2 class="mr-3 my-2">儲值</h2>
                        <input type="number" class="form-control my-2" name="amount" placeholder="填入數量" required="">
                        <button type="submit" class="btn bg-green m-2">付款</button>
                    <?php endif; ?> -->
                </div>
            </form>
            <div class="records my-5">                
                <?php if ($transactions) : ?>
                    <table>
                        <tr class="title">
                            <th>日期</th>
                            <th>付款方式</th>
                            <th>台幣</th>
                            <th>學習幣</th>
                        </tr>
                        <?php foreach ($transactions as $t) : ?>
                        <tr>
                            <td width="15%"><?= date('Y/m/d', strtotime($t['transaction_time'])) ?></td>
                            <td>信用卡付款</td>
                            <td width="15%"><?= $t['amount'] ?></td>
                            <td width="15%"><i class="fa fa-money text-orange mr-2"></i><?= $t['amount'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                <?php else : ?>
                    <div class="text-center">尚無儲值記錄</div>
                <?php endif ?>
            </div>

        </div>
        <!-- tab1 End. -->

        <!-- tab2 -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="records my-5">                
                <?php if ($bougthCourses) : ?>
                    <table>
                        <tr class="title">
                            <th>日期</th>
                            <th>課程</th>
                            <th>付款方式</th>
                            <th>金額</th>
                        </tr>
                        <?php foreach ($bougthCourses as $course) : ?>
                        <tr>
                            <td width="15%"><?= date('Y/m/d', strtotime($course['bought_time'])) ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php
                                        $path = "course_data/" . $course['course'] . "/img/";
                                        $imgs = array_diff(scandir($path), array('.', '..'));
                                    ?>
                                    <img src="/course_data/<?= $course['course'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                                    <div class="ml-3">
                                        <?= $course['name'] ?>
                                    </div>
                                </div>
                            </td>
                            <td width="15%">學習幣</td>
                            <td width="15%"><i class="fa fa-money text-orange mr-2"></i><?= $course['price'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                <?php else : ?>
                    <div class="text-center">尚無儲值記錄</div>
                <?php endif ?>
            </div>
        </div>
        <!-- tab2 End. -->

    </div>
</div>