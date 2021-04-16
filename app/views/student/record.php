<div class="container-md">

    <div class="titleJL marT30 marB0 textC">
        <h1>你目前有 <?= $user['credit'] ?> 枚學習幣</h1>
    </div>

    <!-- tabStyleJL -->
    <div class="tabStyleJL">

        <div class="middle_jl marT50 marB30">
            <ul class="nav nav-pills mb-3 bgGrayJL" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">學習幣購買紀錄</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">購課紀錄</a>
                </li>
            </ul>
        </div>

        <!-- tab main -->
        <div class="tab-content" id="pills-tabContent">

            <!-- tab1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <div class="titleJL marT30">
                    <h3>購買學習幣</h3>
                </div>

                <div class="row justify-content-md-center">
                    <form class="col-12 col-md-10" action="../buy_credit/" method="POST">
                        <b class="marT20 marB20">我要新增學習幣量</b>
                        <input type="number" class="form-control" name="amount" placeholder="填入數量" required="">
                        <div class="middle_jl marB30">
                            <button type="submit" class="btnJL marL0">
                                信用卡付款
                            </button>
                        </div>
                    </form>
                </div>

                <div class="titleJL marT30">
                    <h3>學習幣購買紀錄</h3>
                </div>


                <table class="table sRecordTab">
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

            </div>
            <!-- tab1 End. -->


            <!-- tab2 -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


                <table class="table sRecordTab">
                    <tbody>
                        <?php if ($bougthCourses) : ?>
                            <?php foreach ($bougthCourses as $course) : ?>
                                <tr style="cursor: pointer;" onclick="document.location = '/course/view/<?= $course['id'] ?>/';">
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


        </div>
        <!-- tab main End. -->

    </div>
    <!-- tabStyleJL End. -->



</div>