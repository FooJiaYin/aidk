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
    <form id="profile-edit-form" action="." method="POST">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">姓名</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $user['name'] ?>" required="">
            </div>
            <div class="form-group col-md-4">
                <label for="">生日</label>
                <input type="text" id="birthday" name="birthday" class="form-control" value="<?= $user['birthday'] ?>" required="">
            </div>
            <div class="form-group col-md-4">
                <label for="">性別</label>
                <select class="form-control" name="gender" required>
                    <option <?= ($user['gender'] == 'M') ? 'selected=""' : '' ?> value="M">男</option>
                    <option <?= ($user['gender'] == 'F') ? 'selected=""' : '' ?> value="F">女</option>
                </select>
            </div>
            <div class="form-group col-6 col-md-2">
                <label for="">學校縣市</label>
                <select class="form-control" id="city" name="city" onchange="filter('school', 'city', 'type')">
                    <?php foreach ($cities as $city) : ?>
                        <option value="<?= $city['city'] ?>" <?= ($school['city'] == $city['city']) ? 'selected' : '' ?>><?= ($city['city'] == 'other') ? "其他" : $city['city'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-6 col-md-2">
                <label for="">學校立別</label>
                <select class="form-control" id="type" name="type" onchange="filter('school', 'city', 'type')">
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['type'] ?>" <?= ($school['type'] == $type['type']) ? 'selected' : '' ?>><?= ($type['type'] == 'other') ? "其他" : $type['type'] ?></option>
                    <?php endforeach ?>                    
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">學校</label>
                <select class="form-control" id="school" name="school" required>
                    <?php foreach ($schools as $school_) : ?>
                        <option city="<?= $school_['city'] ?>" type="<?= $school_['type'] ?>" value="<?= $school_['name'] ?>" <?= ($school['name'] == $school_['name']) ? 'selected' : '' ?>><?= ($school_['name'] == 'other') ? "其他" : $school_['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="">年級</label>
                <input type="number" name="grade" min="1" max="3" class="form-control" value="<?= $user['grade'] ?>" required="">
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
        <?php if (!isset($_GET['editPassword'])) : ?>
        <a id="password-edit-link" href="/student/profileEdit?editPassword">
            <h2 class="collapse-left-green my-4">密碼變更</h2>
        </a>
        <?php else : ?>
            <h2 class="bar-left-green my-4">密碼變更</h2>
        <div class="row">
            <div class="form-group col-md-4">
                <input type="password" class="form-control" name="password_old" id="password_old" placeholder="舊密碼" required>
            </div>
            <div class="form-group col-md-4">
                <input type="password" class="form-control" name="password_new" id="password_new" placeholder="新密碼" required>
            </div>
            <div class="form-group col-md-4">
                <input type="password" class="form-control" placeholder="再次輸入新密碼" id="password_confirm" oninput="check(this, 'password_new')" required>
            </div>
        </div>
        <?php endif ?>
        <div class="d-flex justify-content-center my-5">
            <button type="submit" class="btn bg-green mx-2">確認變更</button>
            <a href="/student/profile/" class="btn border-grey text-grey mx-2">取消</a>
        </div>
    </form>
</div>
