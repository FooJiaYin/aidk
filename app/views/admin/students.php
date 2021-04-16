<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1>學生管理</h1>
        <form action=".">
            <input type="text" class="form-control" name="search" placeholder="搜尋" required="">
        </form>
        <div class="uploadBtn"><a href="../newStudent/"><i class="fa fa-plus-square"></i></a></div>
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
                                    <a href="/admin/studentEdit/<?= $stu['id'] ?>/" class="btn btn-outline-dark btn-block badge-pill">修改</a>
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