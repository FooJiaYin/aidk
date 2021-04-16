<div class="pad30" id="form">

    <div class="titleJL textC marT0 marB0">
        <h1>學生資料修改</h1>
    </div>

    <div class="table-responsive">
        <form id="course_form" action="." method="POST">
            <div class="form-group">
                <label>信箱</label>
                <input type="text" class="form-control" value="<?= $stu['account'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>學生姓名</label>
                <input type="text" class="form-control" name="name" value="<?= $stu['name'] ?>" required="">
            </div>
            <div class="form-group">
                <label>性別</label>
                <select class="form-control" name="gender" required>
                    <option <?= ($stu['gender'] == 'M') ? 'selected=""' : '' ?>>M</option>
                    <option <?= ($stu['gender'] == 'F') ? 'selected=""' : '' ?>>F</option>
                </select>
            </div>
            <div class="form-group">
                <label>學習幣</label>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">加值</button>
                <input type="number" name="credit" class="form-control" value="<?= $stu['credit'] ?>" disabled>
            </div>
            <div class="form-group">
                <label>學校</label>
                <input type="text" name="school" class="form-control" value="<?= $stu['school'] ?>" required="">
            </div>
            <div class="form-group">
                <label>年級</label>
                <input type="number" name="grade" min="1" max="3" class="form-control" value="<?= $stu['grade'] ?>" required="">
            </div>
            <div class="form-group">
                <label>生日</label>
                <input type="text" id="birthday" name="birthday" class="form-control" value="<?= $stu['birthday'] ?>" required="">
            </div>
            <div class="form-group">
                <label>電話</label>
                <input type="text" name="phone" class="form-control" value="<?= $stu['phone'] ?>" required="">
            </div>
            <div class="form-group">
                <label>地址</label>
                <input type="text" name="address" class="form-control" value="<?= $stu['address'] ?>" required="">
            </div>
            <div class="form-group">
                <label>註冊日期</label>
                <input type="text" class="form-control" value="<?= $stu['createdDate'] ?>" readonly="">
            </div>
            <div class="form-group">
                <label>最後登入</label>
                <input type="text" class="form-control" value="<?= $stu['lastLogin'] ?>" readonly="">
            </div>
            <button type="submit" class="btn btn-lg btn-primary">確認修改</button>
        </form>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">加值</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <form action="." method="POST">
                    <label>學習幣數量</label>
                    <div class="row">
                        <input type="number" class="form-control col-7 offset-1" min="0" name="add" placeholder="0" required="">
                        <input type="hidden" name="credit" value="<?= $stu['credit'] ?>">
                        <button type="submit" name="coin_add" class="btn btn-primary col-2 offset-1">送出</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>