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

    <form>
        <div class="row m20">
            <div class="form-group col-md-6">
                <label for="">學校</label>
                <input type="text" class="form-control" value="<?= $user['school'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">年級</label>
                <input type="text" class="form-control" value="<?= $user['grade'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">生日</label>
                <input type="text" class="form-control" value="<?= $user['birthday'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">性別</label>
                <input type="text" class="form-control" value="<?= $user['gender'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">電子郵件</label>
                <input type="email" class="form-control" value="<?= $user['account'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">電話</label>
                <input type="text" class="form-control" value="<?= $user['phone'] ?>" readonly="">
            </div>
            <div class="form-group col-md-12">
                <label for="">住址</label>
                <input type="text" class="form-control" value="<?= $user['address'] ?>" readonly="">
            </div>
        </div>
    </form>

</div>

<input type="hidden" id="score" value="<?= $user['score'] ?>">