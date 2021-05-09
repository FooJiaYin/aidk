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
                <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>性別</label>
                <input type="text" class="form-control" name="gender" value="<?= $user['gender'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>信箱</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" readonly="">
            </div>
            <div class="btnJL" style="width:fit-content"><a href="/teacher/profileEdit/">修改資料</a></div>
        </form>
    </div>

</div>