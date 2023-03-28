<div class="container profile">
    <ul class="nav nav-fill my-4">
        <li class="nav-item">
            <a class="nav-link active" href="#">基本資料</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">自傳編撰</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/student/myCourses">課程清單</a>
        </li>
    </ul>
    <div class="row info-cover no-gutters px-md-5 my-4">
        <div class="col-auto">
            <img src="/static/images/img_profile.svg">
        </div>
        <div class="col px-4">
            <h3><?= $user['name'] ?></h3>
        </div>
        <div class="col-12 col-md-2 d-flex flex-md-column mt-3 text-center justify-content-center">
            <h5><i class="fa fa-money text-orange mr-2 font-weight-normal"></i>學習幣</h5>
            <h2 class="mx-3 mb-0"><?= $user['credit'] ?></h2>
        </div>
    </div>
    <h2 class="bar-left-green my-4">基本資料</h2>
    <form>
        <div class="row">            
            <div class="form-group col-md-4">
                <label for="">姓名</label>
                <input type="text" class="form-control" value="<?= $user['name'] ?>" readonly="">
            </div>
            <div class="form-group col-md-4">
                <label for="">生日</label>
                <input type="text" class="form-control" value="<?= $user['birthday'] ?>" readonly="">
            </div>
            <div class="form-group col-md-4">
                <label for="">性別</label>
                <input type="text" class="form-control" value="<?= $user['gender'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">學校</label>
                <input type="text" class="form-control" value="<?= ($user['school'] == 'other') ? "其他" : $user['school'] ?>" readonly="">
            </div>
            <div class="form-group col-md-6">
                <label for="">年級</label>
                <input type="text" class="form-control" value="<?= $user['grade'] ?>" readonly="">
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
        <div class="d-flex justify-content-center my-5">
            <a href="/student/profileEdit/" class="btn bg-green mx-2">修改資料</a>
            <a href="/student/profileEdit/?editPassword" class="btn border-grey text-grey mx-2">更改密碼</a>
        </div>
    </form>
    
</div>

<input type="hidden" id="score" value="<?= $user['score'] ?>">