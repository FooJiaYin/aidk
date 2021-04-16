<div class="pad30" id="form">

    <div class="titleJL textC marT0 marB0">
        <h1>新增課程</h1>
    </div>

    <div class="table-responsive">
        <form id="course_form" action="." method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>課程名稱</label>
                <input type="text" class="form-control" name="name" required="">
            </div>
            <div class="form-group">
                <label>課程說明</label>
                <textarea class="form-control" name="description" rows="3" required=""></textarea>
            </div>
            <div class="form-group">
                <label>課程售價</label>
                <input type="number" name="price" min="1" max="30000" class="form-control" required="">
            </div>
            <div class="form-group">
                <label>開課老師</label>
                <select class="form-control" name="teacher" required="">
                    <option value="">請選擇</option>
                    <?php foreach ($teachers as $teacher) : ?>
                        <option value="<?= $teacher['id'] ?>"><?= $teacher['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>所屬學群</label>
                <select class="form-control" name="category" required="">
                    <option value="">請選擇</option>
                    <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                        <option value="<?= $key ?>"><?= $name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div id="img">
                <label>課程簡介圖片</label>
                <button type="button" id="new_img" class="btn btn-sm btn-primary">新增簡介圖片</button>
                <div class="mt-1">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img[]" accept="image/jpeg" required="">
                            <label class="custom-file-label" data-browse="瀏覽">選擇圖片...</label>
                        </div>
                        <div class="input-group-append">
                            <button class="rm-img btn btn-outline-danger" type="button">移除這個圖片</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group my-3">
                <label>課程簡介影片</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="intro" accept="video/mp4">
                        <label class="custom-file-label" data-browse="瀏覽">選擇影片...</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-1">
                <label>章節內容</label>
                <button type="button" id="new" class="btn btn-sm btn-primary">新增章節</button>
            </div>

            <div class="chp mb-3">
                <div class="chp_body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">章節名稱</span>
                            </div>
                            <input type="text" name="chapter_name[]" class="form-control" required="">
                            <div class="input-group-append">
                                <button class="rm-chapter btn btn-outline-danger" type="button">移除這個章節</button>
                            </div>
                        </div>
                    </div>

                    <div class="px-3" style="border-left: 2px solid #000">
                        <div class="sect_body">
                            <div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">小節名稱</span>
                                    </div>
                                    <input type="text" name="sect_name[]" class="form-control" required="">
                                    <div class="input-group-append">
                                        <button class="rm-sect btn btn-outline-danger" type="button">移除這個小節</button>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">小節影片</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="sect_video[]" accept="video/mp4" required="">
                                        <label class="custom-file-label" data-browse="瀏覽">選擇影片...</label>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <button type="button" class="new2 btn btn-sm btn-success">新增小節</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary">新增課程</button>
        </form>
    </div>

</div>
<div class="pad30" id="wait" style="display: none;">
    <div class="titleJL textC marT0 marB0">
        <h1><i class="fa fa-spinner fa-spin"></i> 處理中。。。</h1>
    </div>
    <div class="alert alert-danger text-center" role="alert">
        依據檔案大小與網路速度，過程可能會花費3-5分鐘不等，請勿重新整理此頁面！
    </div>
</div>