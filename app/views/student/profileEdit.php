<div class="container-md">


    <div class="studentDataUp card rounded-0 border-dark pad20">
        <div class="row row-cols-3">
            <div class="col-9">
                <img src="/static/images/img_profile.svg">
                <h3 class="inBlock"><?= $user['name'] ?></h3>
            </div>
            <div class="col-3 textC">
                <h5>學習幣</h5>
                <h2><?= $user['credit'] ?></h2>
            </div>
        </div>
    </div>

    <div class="titleJL marT30 marB0">
        <h1>基本資料</h1>
    </div>

    <form id="course_form" action="." method="POST">
        <div class="row m20">
            <div class="form-group col-md-6">
                <label for="">學校</label>
                <input type="text" name="school" class="form-control" value="<?= $user['school'] ?>" required="">
            </div>
            <div class="form-group col-md-6">
                <label for="">年級</label>
                <input type="number" name="grade" min="1" max="3" class="form-control" value="<?= $user['grade'] ?>" required="">
            </div>
            <div class="form-group col-md-6">
                <label for="">生日</label>
                <input type="text" id="birthday" name="birthday" class="form-control" value="<?= $user['birthday'] ?>" required="">
            </div>
            <div class="form-group col-md-6">
                <label for="">性別</label>
                <select class="form-control" name="gender" required>
                    <option <?= ($user['gender'] == 'M') ? 'selected=""' : '' ?>>男</option>
                    <option <?= ($user['gender'] == 'F') ? 'selected=""' : '' ?>>女</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">電子郵件</label>
                <input type="email" name="account" class="form-control" value="<?= $user['account'] ?>" require="">
            </div>
            <div class="form-group col-md-6">
                <label for="">電話</label>
                <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>" required="">
            </div>
            <div class="form-group col-md-12">
                <label for="">住址</label>
                <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>" required="">
            </div>
        </div>
        <button type="submit" class="btn btn-lg btn-primary">確認修改</button>
    </form>

</div>
