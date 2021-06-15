<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1><?= $course ?> - 作業</h1>
    </div>

    <div class="table-responsive">
        <!-- 20201128 修改 表格外面加上此div -->
        <table class="table table-bordered marT30">

            <thead>
                <tr>
                    <th scope="col">學生姓名</th>
                    <th scope="col" class="widthMax">檔案名稱</th>
                    <th scope="col">上傳日期</th>
                    <th scope="col">分數</th>
                    <th scope="col">批改</th><!-- 20201128 修改 class加上 -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hwList as $hw) : ?>
                    <tr class="alert alert-dismissible fade show" role="alert">
                        <th scope="row"><?= $hw['student_name'] ?></th>
                        <!-- <th scope="row"><a href="/course_data/<?= $hw['course'] ?>/hw/<?= $hw['name'] ?>"><?= $hw['name'] ?></a></th> -->
                        <th scope="row"><u><a href="/download/hw/<?= $hw['id'] ?>"><?= $hw['name'] ?></a></u></th>
                        <th scope="row"><?= $hw['uploaded_time'] ?></th>
                        <th scope="row"><?= $hw['published'] ? $hw['score'] : "-" ?></th>
                        <td>
                            <div class="row m10">
                                <!-- <div class="col-6"> -->
                                <a data-toggle="modal" data-target="#comment<?= $hw['id'] ?>" class="btn btn-outline-dark btn-block badge-pill">評語</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>
</div>

<!-- Modal -->
<?php foreach ($hwList as $hw) : ?>
<div class="modal fade" id="comment<?= $hw['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title terms_title" id="exampleModalLongTitle">評語</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <p><?= $hw['published'] ?  $hw['comment'] : "<i>此作業未有任何評語</i>"?></p>
            </div>

        </div>
    </div>
</div>
<?php endforeach ?>