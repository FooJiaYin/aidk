<div class="pad30" id="form">

    <div class="titleJL textC marT0 marB0">
        <h1>新增老師帳號</h1>
    </div>

    <div class="table-responsive">
        <form id="course_form" action="." method="POST">
            <div class="form-group">
                <label>帳號</label>
                <input type="text" class="form-control" name="account" required="">
            </div>
            <div class="form-group">
                <label>密碼</label>
                <input type="text" class="form-control" name="password" required="">
            </div>
            <div class="form-group">
                <label>老師姓名</label>
                <input type="text" class="form-control" name="name" required="">
            </div>
            <div class="form-group">
                <label>性別</label>
                <select class="form-control" name="gender" required="">
                    <option>M</option>
                    <option>F</option>
                </select>
            </div>
            <div class="form-group">
                <label>信箱</label>
                <input type="email" name="email" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-lg btn-primary">新增帳號</button>
        </form>
    </div>

</div>