<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if (isset($_GET['teacher'])) : ?>
<div class="tabStyleJL" style="background-color: inherit; margin-top: 0;">

    <div class="middle_jl">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-profile-tab" href="/admin/teacherInfo/<?= $_GET['teacher'] ?>/?tab=profile">基本資料</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-record-tab" href="/admin/teacherInfo/<?= $_GET['teacher'] ?>/?tab=courses">課程資料</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-log-tab" href="/admin/teacherInfo/<?= $_GET['teacher'] ?>/?tab=log">Log歷史紀錄</a>
            </li>
        </ul>
    </div>
</div>
<?php else: ?>
<div class="pad30">
<?php endif ?>
    <div class="titleJL textC marT0 marB0">
        <h1><?= $course['name'] ?><br />課程分析</h1>
    </div>    
    <div class="analysis">
        <div class="card h-100">
            <div class="card-body">                    
                <h5 class="card-title">購課人數</h5>                
                <h2 class="card-subtitle"><?= $course['stuCount'] ?></h2>
            </div>
        </div>
        <div class="card h-100">
            <div class="card-body">                    
                <h5 class="card-title">課程總收入</h5>                
                <h2 class="card-subtitle"><?= $course['price'] *  $course['stuCount'] ?></h2>
            </div>
        </div>
        <div class="card h-100">
            <div class="card-body">                    
                <h5 class="card-title">教師分潤比例</h5>                
                <h2 class="card-subtitle"><?= 1- $course['share'] ?></h2>
            </div>
        </div>
    </div>
    <div class="analysis">
        <div class="card">
            <div class="card-body">                    
                <h5 class="card-title">學生年級</h5>
                <canvas id="grade-pie" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-body">                    
                <h5 class="card-title">學生性別</h5>
                <canvas id="gender-pie" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-body">                    
                <h5 class="card-title">購課時間</h5>
                <canvas id="dayofweek-line" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>