<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <![endif]-->

    <meta name="keywords" content="Aidk 學習歷程AI導航者" />
    <meta name="description" content="Aidk 學習歷程AI導航者" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>學習歷程AI導航者</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/static/images/favicon.ico">

    <!-- 分享 -->
    <meta property="og:title" content="Aidk 學習歷程AI導航者">
    </meta>
    <meta property="og:image" content="http://www.onelove99.com/web/aidk/images/fb.jpg">
    </meta>
    <meta property="og:description" content="學習歷程AI導航者">
    </meta>

    <meta name="google-signin-client_id" content="14529699044-aeu09otetcltelahpllg3rg32gncl2et.apps.googleusercontent.com">

    <?php if ($this->_controller == 'survey') : ?>
        <link href="/static/survey/css/all.css" rel="stylesheet">
    <?php else : ?>
        <link href="/static/css/all.css" rel="stylesheet">
    <?php endif ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <!--//==Preloader Start==//-->
    <div class="preloader">
        <div class="cssload-container">
            <div class="cssload-loading">
                <div id="object">
                </div>
            </div>
        </div>
    </div>
    <!--//==Preloader End==//-->


    <?php if ($this->_controller == 'survey' && !isset($_GET['nologin'])) : ?>
        <header class="header">
            <div class="logo">
                <a href="/survey/"><img src="/static/images/img_logo.svg" alt="AIDK" />學習歷程AI導航者</a>
            </div>
        </header>
    <?php else : ?>
        <header class="header">
            <div class="logo logo-nologin">
                <a href="/"><img src="/static/images/logo.png" alt="AIDK" /></a>
                <?php if (!isset($_SESSION['loginType']) || $_SESSION['loginType'] == 1) : ?>
                    <div class="classNavBtn">
                        <a href="#!" class="btnJL">課程總覽</a>

                        <div class="classDropNav">
                            <div class="classDropHr">
                                <div class="container-xl">
                                    <ul class="row no-gutters">
                                        <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                                            <li class="col-3 col-md-2"><a href="/course/category/<?= $key ?>/"><?= $name ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="searchBox">
                        <form action="/course/index/search/" method="GET" style="width:100%">
                            <input type="text" class="form-control" name="keyword" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" placeholder="搜尋">
                        </form>
                    </div>
                <?php endif ?>

                <ul class="userNav">
                    <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']) : ?>
                        <?php if ($_SESSION['loginType'] == 1) : ?>
                            <li>
                                <a href="#!"><img src="/static/images/img_profile.svg"></a>
                                <ul class="dropmenu">
                                    <li><a href="/student/profile/">個人檔案</a></li>
                                    <li><a href="/student/myCourses/">我的課程</a></li>
                                    <li><a href="/student/record/">消費紀錄</a></li>
                                    <li><a href="/student/myScore/">我的測驗</a></li>
                                    <li><a href="/student/logout/">登出</a></li>
                                </ul>
                            </li>
                        <?php elseif ($_SESSION['loginType'] == 2) : ?>
                            <li>
                                <a href="#!"><img src="/static/images/img_profile.svg"></a>
                                <ul class="dropmenu">
                                    <li><a href="/teacher/courseList/"><?= $_SESSION['name'] ?> 老師</a></li>
                                    <li><a href="/teacher/logout">登出</a></li>
                                </ul>
                            </li>
                        <?php elseif ($_SESSION['loginType'] == 3) : ?>
                            <li>
                                <a href="#!"><img src="/static/images/img_profile.svg"></a>
                                <ul class="dropmenu">
                                    <li><a href="/admin/dashboard">管理員</a></li>
                                    <li><a href="/admin/logout">登出</a></li>
                                </ul>
                            </li>
                        <?php endif ?>
                    <?php else : ?>
                        <li>
                            <a href="/survey/signup/?nologin">註冊</a>
                        </li>
                        <li>
                            <a href="/student/login/">登入</a>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </header>
    <?php endif ?>

    <?php if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 3 && $this->_controller != 'course') : ?>
        <div class="row no-gutters">
            <div class="col-12 col-xs-3 col-md-2 sideNav">
                <ul class="">
                    <li><a href="/admin/courses/">課程管理</a></li>
                    <li><a href="/admin/students/">學生管理</a></li>
                    <li><a href="/admin/teachers/">老師管理</a></li>
                    <li><a href="/admin/logs/">log歷史紀錄</a></li>
                </ul>
            </div>
            <div class="col-12 col-xs-9 col-md-10">
                <?php include($controllerLayout); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="mainJL">

            <?php include($controllerLayout); ?>

        </div>
    <?php endif ?>

    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.js"></script>

    <?php if (is_file($controllerScript)) include($controllerScript); ?>

</body>

</html>