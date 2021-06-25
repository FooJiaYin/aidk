<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1><?= $course ?> - 作業</h1>
        <!-- <div class="row">
            <div class="col">
                <form action=".">
                    <input type="text" class="form-control" name="search" placeholder="搜尋" required="">
                </form>
            </div>
            <div class="col-auto">
                <form action=".">
                    <div class="btn-group" role="group" >
                    <button type="submit" name="order" class="btn border-dark <?= (!isset($_GET['order']) || $_GET['order'] == 'idA') ? 'active' : '' ?>" value="idA">最舊</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'idD') ? 'active' : '' ?>" value="idD">最新</button>
                </div>
            </form>
        </div> -->
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
                        <th scope="row"><a href="/download/hw/<?= $hw['id'] ?>"><?= $hw['name'] ?></a></th>
                        <th scope="row"><?= $hw['uploaded_time'] ?></th>
                        <th scope="row"><?= $hw['score'] ?></th>
                        <td>
                            <div class="row m10">
                                    <a href="../courseEdit/<?= $hw['id'] ?>/" class="btn btn-outline-dark btn-block badge-pill">評語</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div><!-- 20201128 修改 表格外面加上此div End. -->

</div>