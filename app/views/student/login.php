<div class="container">

    <form action="/student/login/" method="post">

        <div class="boxBor loginBox">

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
                        <input type="email" class="form-control" name="account" placeholder="信箱" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="密碼" required>
                    </div>

                    <button type="submit" class="btnJL">確認</button>

                    <div class="col-12 text-right marB10"><a href="javascript:alert('請洽詢客服協助重置密碼。')"><u>忘記密碼?</u></a></div>

                    <div class="col-12 textC marT10 marB10">還沒有帳號嗎? <a href="/survey/signup/"><u>立即註冊</u></a></div>

                </div>

            </div>

        </div>
    </form>

</div>