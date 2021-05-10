<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1>課程管理</h1>
        <div class="row">
            <div class="col">
                <form action=".">
                    <input type="text" class="form-control" name="search" placeholder="搜尋" required="">
                </form>
            </div>
            <div class="col-auto">
                <form action=".">
                    <div class="btn-group" role="group" >
                    <button type="submit" name="order" class="btn border-dark <?= (!isset($_GET['order']) || $_GET['order'] == 'idA') ? 'active' : '' ?>" value="idA">默認排序</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'idD') ? 'active' : '' ?>" value="idD">最新</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'stuCountD') ? 'active' : '' ?>" value="stuCountD">熱門</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'priceA') ? 'active' : '' ?>" value="priceA">價格（低至高）</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'priceD') ? 'active' : '' ?>" value="priceD">價格（高至低）</button>
                </div>
            </form>
        </div>
        <div class="uploadBtn"><a href="../newCourse"><i class="fa fa-plus-square"></i></a></div>
    </div>

    <div class="table-responsive">
        <!-- 20201128 修改 表格外面加上此div -->
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
                                    <a href="../courseEdit/<?= $course['id'] ?>/" class="btn btn-outline-dark btn-block badge-pill">修改</a>
                                </div>
                                <div class="col-6">
                                    <a href="../../course/analysis/<?= $course['id'] ?>/" class="btn btn-outline-dark btn-block badge-pill">分析</a>
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
    </div><!-- 20201128 修改 表格外面加上此div End. -->

</div>