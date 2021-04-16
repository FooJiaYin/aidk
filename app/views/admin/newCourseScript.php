<script>
    $('#new').on('click', function() {
        $('<div class="chp_body my-3">').html(
            '<div class="form-group">\
                <div class="input-group">\
                     <div class="input-group-prepend">\
                        <span class="input-group-text">章節名稱</span>\
                    </div>\
                    <input type="text" name="chapter_name[]" class="form-control" required="">\
                    <div class="input-group-append">\
                        <button class="rm-chapter btn btn-outline-danger" type="button">移除這個章節</button>\
                    </div>\
                </div>\
            </div>\
            <div class="px-3" style="border-left: 2px solid #000">\
                <div class="sect_body">\
                    <div>\
                        <div class="input-group">\
                            <div class="input-group-prepend">\
                                <span class="input-group-text">小節名稱</span>\
                            </div>\
                            <input type="text" name="sect_name[]" class="form-control" required="">\
                            <div class="input-group-append">\
                                <button class="rm-sect btn btn-outline-danger" type="button">移除這個小節</button>\
                            </div>\
                        </div>\
                        <div class="input-group mb-3">\
                            <div class="input-group-prepend">\
                                <span class="input-group-text">小節影片</span>\
                            </div>\
                            <div class="custom-file">\
                                <input type="file" class="custom-file-input" name="sect_video[]" accept="video/mp4" required="">\
                                <label class="custom-file-label" data-browse="瀏覽">選擇影片...</label>\
                            </div>\
                        </div>\
                        <hr />\
                    </div>\
                </div>\
                <button type="button" class="new2 btn btn-sm btn-success">新增小節</button>\
            </div>'
        ).appendTo($('.chp'))
    });

    $('body').on('click', '.new2', function() {
        $('<div>').append(
            $('<div class="input-group">').append(
                $('<div class="input-group-prepend">').append(
                    $('<span class="input-group-text">小節名稱</span>')
                )
            ).append(
                $('<input type="text" name="sect_name[]" class="form-control" required="">')
            ).append(
                $('<div class="input-group-append">').append(
                    $('<button class="rm-sect btn btn-outline-danger" type="button">移除這個小節</button>')
                )
            )
        ).append(
            $('<div class="input-group mb-3">').append(
                $('<div class="input-group-prepend">').append(
                    $('<span class="input-group-text">小節影片</span>')
                )
            ).append(
                $('<div class="custom-file">').append(
                    $('<input type="file" class="custom-file-input" name="sect_video[]" accept="video/mp4" required="">')
                ).append(
                    $('<label class="custom-file-label" data-browse="瀏覽">選擇影片...</label>')
                )
            )
        ).append(
            $('<hr />')
        ).appendTo($(this).parent().find('.sect_body'));
    });

    $('#new_img').on('click', function() {
        $('<div class="input-group">').html(
            '<div class="custom-file">\
                <input type="file" class="custom-file-input" name="img[]" accept="image/jpeg" required="">\
                <label class="custom-file-label" data-browse="瀏覽">選擇圖片...</label>\
            </div>\
            <div class="input-group-append">\
                <button class="rm-img btn btn-outline-danger" type="button">移除這個圖片</button>\
            </div>'
        ).appendTo($('#img > div'));
    });

    $('body').on('click', '.rm-img', function() {
        console.log();
        if ($(this).parent().parent().parent().children().length > 1)
            $(this).parent().parent().remove();
        else
            alert("至少要有一張圖片！");
    });

    $('body').on('click', '.rm-chapter', function() {
        console.log();
        if ($(this).parent().parent().parent().parent().parent().children().length > 1)
            $(this).parent().parent().parent().parent().remove();
        else
            alert("至少要有一個章節！");
    });

    $('body').on('click', '.rm-sect', function() {
        console.log();
        if ($(this).parent().parent().parent().parent().children().length > 1)
            $(this).parent().parent().parent().remove();
        else
            alert("至少要有一個小節！");
    });

    $('form').on('change', 'input[type="file"]', function() {
        var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(this).next('.custom-file-label').html(fileName);
    });

    $('#course_form').on('submit', function(event) {
        event.preventDefault();
        var check = confirm("課程建立後章節影片、圖片皆無法更動，確認新增課程？");
        if (!check) return;
        $('#form').hide();
        $('#wait').show();
        //if(!this.checkValidity()) return;
        var fd = new FormData();
        var course = {};
        course['name'] = $('input[name = "name"]').val();
        course['description'] = $('textarea[name = "description"]').val();
        course['price'] = $('input[name = "price"]').val();
        course['teacher'] = $('select[name = "teacher"]').val();
        course['category'] = $('select[name = "category"]').val();
        var chapter_data = $('.chp').children();
        var chapter_array = [];
        var k = 0;
        chapter_data.each(function(i) {
            var chapter = {};
            var sections = [];
            chapter['name'] = $(chapter_data[i]).find('input[name = "chapter_name[]"]').val();
            var section = $(chapter_data[i]).find('.sect_body > div');
            section.each(function(j) {
                var sect = {}
                sect['index'] = k;
                sect['name'] = $(section[j]).find('input[name = "sect_name[]"]').val();
                sect['video'] = $(section[j]).find('input[name = "sect_video[]"]').val().split('\\').pop();
                fd.append('sect_video[]', $(section[j]).find('input[name = "sect_video[]"]').prop('files')[0]);
                sections.push(sect);
                k++;
            });
            chapter['section'] = sections;
            chapter_array.push(chapter);
        });
        course['chapter'] = chapter_array;
        course = JSON.stringify(course);
        fd.append('course', course);
        var imgs = $('#img').find('input[name="img[]"]');
        imgs.each(function(i) {
            fd.append('img[]', $(imgs[i]).prop('files')[0]);
        });
        var intro = $('input[name="intro"]').prop('files').length;
        if (intro) {
            fd.append('intro', $('input[name="intro"]').prop('files')[0]);
        }
        fetch("/admin/newCourse", {
                method: 'POST',
                body: fd
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }

                return response.json();
            }).then((result) => {
                if (result.result)
                    window.location.replace("/admin/courses/");;
            });
    });
</script>