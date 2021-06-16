<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1>學生管理</h1>
        <div class="row">
            <div class="col">
                <form action=".">
                    <input type="text" class="form-control" name="search" placeholder="搜尋" required="">
                </form>
            </div>
            <div class="col-auto">
                <form action=".">
                    <div class="btn-group" role="group" >
                    <button type="submit" name="order" class="btn border-dark <?= (!isset($_GET['order']) || $_GET['order'] == 'idA') ? 'active' : '' ?>" value="idA">注冊時間-舊至新</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'idD') ? 'active' : '' ?>" value="idD">注冊時間-新至舊</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'gradeD') ? 'active' : '' ?>" value="gradeD">年級-大至小</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'gradeA') ? 'active' : '' ?>" value="gradeA">年級-小至大</button>
                    <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'credit') ? 'active' : '' ?>" value="creditD">學習幣數量</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <!-- 20201128 修改 表格外面加上此div -->
        <table class="table table-bordered marT30">

            <thead>
                <tr>
                    <th scope="col" width="18%">學生帳號</th>
                    <th scope="col">學生姓名</th>
                    <th scope="col">學習幣</th>
                    <th scope="col" class="widthMax">功能</th><!-- 20201128 修改 class加上 -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stuList as $stu) : ?>
                    <tr class="alert alert-dismissible fade show" role="alert">
                        <th scope="row"><?= $stu['account'] ?></th>
                        <th scope="row"><?= $stu['name'] ?></th>
                        <th scope="row"><?= $stu['credit'] ?></th>
                        <td>
                            <div class="row m10">
                                <div class="col-4">
                                    <a href="/admin/studentInfo/<?= $stu['id'] ?>/" class="btn btn-outline-dark btn-block badge-pill">詳細資料</a>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-outline-dark btn-block badge-pill reset-user" data-id="<?= $stu['id'] ?>" data-name="<?= $stu['name'] ?>">重置</button>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline btn-danger btn-block badge-pill del-user" style="color:#FFF;" data-id="<?= $stu['id'] ?>" data-name="<?= $stu['name'] ?>">刪除</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>

    </div><!-- 20201128 修改 表格外面加上此div End. -->

</div>