<script>
    $('.reset-user').on('click', function() {
        var check = confirm("確認要重置老師”" + $(this).data("name") + "“的密碼？");
        if (!check) return;

        var user = $(this).data("id");

        var fd = new FormData();
        fd.append('user', $(this).data("id"));
        fd.append('type', '2');

        fetch("/admin/resetUser", {
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
                    alert("老師“" + $(this).data("name") + "”的密碼已重置為“1111”。");
            });
    });

    $('.del-user').on('click', function() {
        var check = confirm("該老師所有開課資訊、學生作業皆會一併刪除且無法復原！\n確認要刪除老師”" + $(this).data("name") + "“的帳號？");
        if (!check) return;

        var user = $(this).data("id");

        var fd = new FormData();
        fd.append('user', $(this).data("id"));
        fd.append('type', '2');

        fetch("/admin/delUser", {
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
                    alert("老師“" + $(this).data("name") + "”帳號已刪除！");
                    window.location.reload();
            });
    });
</script>