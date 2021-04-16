<script>
    $('.del-course').on('click', function() {
        var check = confirm("刪除後即無法復原！\n確認要刪除課程”" + $(this).data("name") + "“嗎？");
        if (!check) return;

        var course = $(this).data("id");

        var fd = new FormData();
        fd.append('course', $(this).data("id"));
        fd.append('name', $(this).data("name"));

        fetch("/admin/delCourse", {
                method: 'POST',
                body: fd
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }

                return response.json();
            }).then((result) => {
                if (result.status)
                    alert("課程“" + $(this).data("name") + "”已刪除！");
                    window.location.reload();
            });
    });
</script>