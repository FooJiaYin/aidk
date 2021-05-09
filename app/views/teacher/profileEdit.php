<div class="container" id="form">

    <div class="titleJL textC marT0 marB0">
        <h1>老師個人檔案</h1>
    </div>

    <div class="table-responsive">
        <form id="course_form" action="." method="POST">
            <div class="form-group">
                <label>帳號</label>
                <input type="text" class="form-control" value="<?= $user['account'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>老師姓名</label>
                <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required="">
            </div>
            <div class="form-group">
                <label>性別</label>
                <select class="form-control" name="gender" required>
                    <option <?= ($user['gender'] == 'M') ? 'selected=""' : '' ?>>M</option>
                    <option <?= ($user['gender'] == 'F') ? 'selected=""' : '' ?>>F</option>
                </select>
            </div>
            <div class="form-group">
                <label>信箱</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required="">
            </div>
            <button type="submit" class="btn btn-lg btn-primary">確認修改</button>
        </form>
    </div>

</div>