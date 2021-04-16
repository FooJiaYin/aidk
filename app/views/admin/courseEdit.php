<div class="pad30" id="form">

    <div class="titleJL textC marT0 marB0">
        <h1>課程內容</h1>
    </div>

    <div class="table-responsive">
        <form id="course_form" action="." method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>課程名稱</label>
                <input type="text" class="form-control" name="name" value="<?= $course['name'] ?>" required="">
            </div>
            <div class="form-group">
                <label>課程說明</label>
                <textarea class="form-control" name="description" rows="3" required=""><?= $course['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label>課程售價</label>
                <input type="number" name="price" min="1" max="30000" class="form-control" value="<?= $course['price'] ?>" required="">
            </div>
            <div class="form-group">
                <label>開課老師</label>
                <select class="form-control" name="teacher" required="">
                    <option value="">請選擇</option>
                    <?php foreach ($teachers as $teacher) : ?>
                        <option value="<?= $teacher['id'] ?>" <?= ($course['teacher'] == $teacher['id'] ? 'selected=""' : '') ?>><?= $teacher['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>所屬學程</label>
                <select class="form-control" name="category" required="">
                    <option value="">請選擇</option>
                    <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                        <option value="<?= $key ?>" <?= ($course['category'] == $key ? 'selected=""' : '') ?>><?= $name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-lg btn-primary">確認修改</button>
        </form>
    </div>

</div>