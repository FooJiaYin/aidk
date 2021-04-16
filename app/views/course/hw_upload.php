<div class="container">
    <div class="boxBor loginBox">

        <div class="titleJL textC">
            <h1>上傳作業</h1>
        </div>

        <div class="upload">
            <div class="upload-progress"></div>

            <main class="upload-main">
                <label class="upload-drop">
                    <div class="upload-file-name"></div>

                    <svg viewBox="0 0 24 24" class="icon upload-icon">
                        <path d="M16 16l-4-4-4 4M12 12v9" />
                        <path d="M20 18a5 5 0 00-2-9h-1a8 8 0 10-14 7" />
                        <path d="M16 16l-4-4-4 4" />
                    </svg>

                    <svg viewBox="0 0 24 24" class="icon uploading-icon">
                        <path d="M1 4v6h6M23 20v-6h-6" />
                        <path d="M20 9A9 9 0 006 6l-5 4m22 4l-5 4a9 9 0 01-14-3" />
                    </svg>

                    <svg viewBox="0 0 24 24" class="icon done-icon">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    <form action="." method="POST" enctype="multipart/form-data">
                        <input type="file" class="upload-input" id="hw" name="hw" onchange="handleInputChange(event)">
                    </form>
                </label>
                <button id="upload" class="upload-button border border-dark rounded-0" onclick="clickFileUpload()">
                    開始上傳
                </button>
            </main>
        </div>

    </div>
</div>