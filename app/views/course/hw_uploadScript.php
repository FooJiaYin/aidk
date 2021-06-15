<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>

<script id="rendered-js">
    const $fileName = document.querySelector('.upload-file-name');
    const $uploadProgress = document.querySelector('.upload-progress');
    const $uploadDrop = document.querySelector('.upload-drop');
    const $uploadInput = document.querySelector('.upload-input');
    const $uploadIcon = document.querySelector('.upload-icon');
    const $uploadingIcon = document.querySelector('.uploading-icon');
    const $doneIcon = document.querySelector('.done-icon');
    const $uploadButton = document.querySelector('.upload-button');

    let filename;
    let state = 'choose';

    const updateState = newState => {
        state = newState;
        $uploadButton.textContent = {
            choose: '開始上傳',
            upload: '開始上傳',
            uploading: '作業上傳中...',
            done: '取消重傳'
        } [state];

        const uploadActive = ['choose', 'upload'].includes(state);
        $uploadDrop.classList.toggle('active', uploadActive);
        $uploadInput.disabled = !uploadActive;
        $uploadIcon.classList.toggle('hidden', state != 'choose');
        $fileName.classList.toggle('hidden', state != 'upload');
        $uploadingIcon.classList.toggle('hidden', state != 'uploading');
        $doneIcon.classList.toggle('hidden', state != 'done');
    };
    updateState('choose');

    const handleInputChange = event => {
        filename = event?.target?.files[0]?.name ?? '';

        $fileName.textContent = filename;
        updateState(filename ? 'upload' : 'choose');
    };

    const setProgress = progress => {
        $uploadProgress.style.setProperty('--progress', progress);
    };

    const clickFileUpload = () => {
        switch (state) {
            case 'choose':
                $uploadInput.click();
                break;
            case 'upload':
                $('#upload').attr('disabled', '');
                updateState('uploading');
                var fd = new FormData();
                var files = $('#hw')[0].files;
                fd.append('hw', files[0]);
                $.ajax({
                    url: '.',
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 1) {
                            alert("上傳完成！");
                        } else if (response == 2) {
                            alert("檔名不可超過20字元！");
                        } else {
                            alert("上傳失敗！");
                        }
                        window.location.replace("/course/play/<?= $courseID ?>");
                    },
                });
                break;
            case 'done':
                updateState('choose');
                setProgress('0%');
                break;
        }
    };
</script>