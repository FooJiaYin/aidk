<div class="pad30">

    <div class="titleJL textC marT0 marB0">
        <h1>老師管理</h1>
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
                </div>
            </form>
        </div>
        <div class="uploadBtn"><a href="../newTeacher/"><i class="fa fa-plus-square"></i></a></div>
    </div>

    <div class="table-responsive">
        <!-- 20201128 修改 表格外面加上此div -->
        <table class="table table-bordered marT30">

            <thead>
                <tr>
                    <th scope="col" width="18%">老師ID</th>
                    <th scope="col">老師姓名</th>
                    <th scope="col">課程列表</th>
                    <th scope="col" class="widthMax">功能</th><!-- 20201128 修改 class加上 -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teacherList as $teacher) : ?>
                    <tr class="alert alert-dismissible fade show" role="alert">
                        <th scope="row"><?= $teacher['account'] ?></th>
                        <th scope="row"><?= $teacher['name'] ?></th>
                        <th scope="row"><?= $teacher['courses'] ?></th>
                        <td>
                            <div class="row m10">
                                <div class="col-12">
                                    <a href="/admin/teacherEdit/<?= $teacher['id'] ?>/" class="btn btn-outline-dark btn-block badge-pill">查看與變更老師個人檔案</a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-dark btn-block badge-pill reset-user" data-id="<?= $teacher['id'] ?>" data-name="<?= $teacher['name'] ?>">重置</button>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-outline btn-danger btn-block badge-pill del-user" style="color:#FFF;" data-id="<?= $teacher['id'] ?>" data-name="<?= $teacher['name'] ?>">刪除</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>

    </div><!-- 20201128 修改 表格外面加上此div End. -->

</div>