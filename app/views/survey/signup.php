<div class="container">

    <div class="row">
        <form action="." method="POST" class="col-12 col-md-12 col-lg-6 align-items-stretch loginBox">
            <div class="boxBor">

                <div class="titleJL">
                    <h1>註冊</h1>
                </div>

                <div class="row">

                    <div class="col-12 snsSignup">
                        <a id="FBSignup" data-do="signup" class="btnJL fb" href="#">Facebook</a>
                        <a id="GSignup" data-do="signup" class="btnJL google" href="#">Google</a>
                    </div>
                    <b class="col-12 textC marB10 snsSignup">或</b>
                    <b class="col-12 textC marB10 snsSignup2" style="display: none;">社群帳號已連動，請完成以下資訊建立帳號！</b>

                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" class="form-control" id="signup_email" name="email" placeholder="信箱" value="<?= (isset($_SESSION['surv_email'])) ? $_SESSION['surv_email'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="密碼" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="再次輸入密碼" id="password_confirm" oninput="check(this)" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="signup_name" name="name" placeholder="姓名" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="gender" required>
                                <option value="">性別</option>
                                <option value="M">男</option>
                                <option value="F">女</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="school" value="<?= (isset($_SESSION['surv_email'])) ? $_SESSION['surv_school'] : '' ?>" placeholder="學校" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="grade" required>
                                <option value="">選擇就讀年級</option>
                                <option value="1" <?= (isset($_SESSION['surv_grade']) && $_SESSION['surv_grade'] == 1) ? 'selected=""' : '' ?>>一年級</option>
                                <option value="2" <?= (isset($_SESSION['surv_grade']) && $_SESSION['surv_grade'] == 2) ? 'selected=""' : '' ?>>二年級</option>
                                <option value="3" <?= (isset($_SESSION['surv_grade']) && $_SESSION['surv_grade'] == 3) ? 'selected=""' : '' ?>>三年級</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="birthday" name="birthday" placeholder="生日" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="電話" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="地址" required>
                        </div>

                        <div class="form-group">
                            <label class="check_style">我已詳閱並同意《<a data-toggle="modal" data-target="#exampleModalCenter"><u>
                                        使用條文</u></a>》
                                <input type="checkbox" required>
                                <span class="check_checkmark"></span>
                            </label>
                        </div>

                        <input type="hidden" id="fb_token" name="fb_token" value="" />
                        <input type="hidden" id="google_token" name="google_token" value="" />
                        <?php if (isset($_GET['nologin'])) : ?>
                            <input type="hidden" name="nologin" value="nologin" />
                        <?php endif ?>

                        <button type="submit" class="btnJL">註冊</button>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>
        </form>
        <?php if (!isset($_GET['nologin'])) : ?>
            <form id="login_form" action="/survey/survey_login/" method="POST" class="col-12 col-md-12 col-lg-6 align-items-stretch loginBox">
                <div class="boxBor">

                    <div class="titleJL">
                        <h1>登入</h1>
                    </div>

                    <div class="row">

                        <div class="col-12">
                            <a id="FBlogin" class="btnJL fb" href="#">Facebook</a>
                            <a id="Glogin" class="btnJL google" href="#">Google</a>
                        </div>
                        <b class="col-12 textC marB10">或</b>

                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="login_account" name="account" placeholder="帳號" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="login_password" name="password" placeholder="密碼" required>
                            </div>

                            <input type="hidden" id="loginBy" name="loginBy" value="web" />

                            <button type="submit" class="btnJL">登入</button>

                        </div>

                    </div>

                </div>
            </form>
        <?php endif ?>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title terms_title" id="exampleModalLongTitle">網站使用條款</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body terms_body">
                <p>
                    本使用條款和條件 (下稱「使用條款」) 適用於位於 www.aidk.com 的 AIDK 網站，以及 AIDK、其子公司與關係企業連結至 www.aidk.com 的所有相關網站，
                    包括全球的 AIDK 網站 (通稱「本網站」)。本網站為 AIDK Inc. (下稱「AIDK」) 及其授權人之財產。凡使用本網站，即代表您同意本使用條款。
                    若您不同意，請勿使用本網站。</p>

                <p>AIDK 有權隨時自行決定變更、修改、增加或移除本使用條款任何內容。您應自行負責定期檢查本使用條款是否有變更。凡在變更公告後繼續使用本網站，
                    即代表您接受並同意此等變更。在您遵守本使用條款的前提下，AIDK 授予您個人、非專屬、不可轉讓、有限之權利得進入並使用本網站。</p>
            </div>

        </div>
    </div>
</div>