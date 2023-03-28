<?php use app\models\StudentModel; ?>
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
    
    <?php if ($newStyle) : ?>
        <link href="/static/css/style_new.css" rel="stylesheet">
    <?php elseif ($this->_controller == 'survey') : ?>
        <link href="/static/survey/css/all.css" rel="stylesheet">
    <?php else : ?>
        <link href="/static/css/all.css" rel="stylesheet">
    <?php endif ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<?php if (isset($_SESSION['loginType']) && $_SESSION['loginType'] == 3 && $this->_controller != 'course') : ?>
<body style="overflow:hidden">
<?php else: ?>
<body>
<?php endif ?>

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
    <?php if ($newStyle) : ?>
        <header class="sticky-top shadow-sm">
            <nav class="navbar navbar-light bg-light navbar-expand-md">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="/static/images/logo_green.png" class="nav-img me-2">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                            <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] && $_SESSION['loginType'] == 1) : ?>
                                <a class="nav-link" href="/student/myScore">
                            <?php else : ?>
                                <a class="nav-link" href="/survey/">
                            <?php endif ?>
                                <i class="fa fa-pencil text-orange mr-1"></i>興趣分析
                            </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/course/choose">
                                    <i class="fa fa-book text-orange mr-1"></i>我想上課
                                </a>
                            </li>
                            <li class="nav-item">
                            <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] && $_SESSION['loginType'] == 1) : ?>
                                <a class="nav-link" href="/student/portfolio">
                            <?php else : ?>
                                <a class="nav-link" href="/student/portfolio/?intro">
                            <?php endif ?>
                                    <i class="fa fa-clipboard text-orange mr-1"></i>學習歷程
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-area-chart text-orange mr-1"></i>落點分析
                                </a>
                            </li> -->
                            <form class="search position-relative" action="/course/index/search/" method="GET">
                                <input class="form-control ml-md-3 mr-sm-2 rounded-pill" type="search" name="keyword" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" placeholder="熱門關鍵字" aria-label="Search">
                                <i class="fa fa-search position-absolute text-orange"></i>
                            </form>						
                        </ul>
                        <ul class="navbar-nav ml-auto align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-facebook text-green"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-twitter text-green"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-instagram text-green"></i></a>
                            </li>
                            <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin']) : ?>
                                <li class="nav-item dropdown ml-2">
                                    <a class="nav-link" id="menu-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="/static/images/img_profile.svg">                                        
                                        <?php $user = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch(); ?>
                                        <?= $user['credit'] ?>
                                    </a>
                                    <ul class="dropdown-menu shadow p-3 text-center" aria-labelledby="dropdownMenuLink">
                                        <?php if ($_SESSION['loginType'] == 1) : ?>
                                            <li><a class="dropdown-item" href="/student/profile/">個人檔案</a></li>
                                            <li><a class="dropdown-item" href="/student/myCourses/">我的課程</a></li>
                                            <li><a class="dropdown-item" href="/student/record/">消費紀錄</a></li>
                                            <li><a class="dropdown-item" href="/student/myScore/">我的測驗</a></li>
                                            <li><a class="dropdown-item" href="/student/portfolio/">學習歷程</a></li>
                                            <div class="dropdown-divider"></div>
                                            <li><a class="dropdown-item" href="/student/logout/"><i class="fa fa-sign-out mr-2"></i>登出</a></li>
                                        <?php elseif ($_SESSION['loginType'] == 2) : ?>
                                            <li><?= $_SESSION['name'] ?> 老師</a></li>
                                            <li><a class="dropdown-item" href="/teacher/profile/">個人資料</a></li>
                                            <li><a class="dropdown-item" href="/teacher/courseList/">開課清單</a></li>
                                            <li><a class="dropdown-item" href="/teacher/logout">登出</a></li>
                                        <?php elseif ($_SESSION['loginType'] == 3) : ?>
                                            <li><a class="dropdown-item" href="/admin/dashboard">管理員</a></li>
                                            <li><a class="dropdown-item" href="/admin/logout">登出</a></li>
                                        <?php endif ?>
                                    </ul>
                                </li>
                            <?php else : ?>
                                <li class="nav-item dropdown ml-2">
                                    <a class="nav-link" id="menu-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        註冊/登入    
                                    </a>
                                    <ul class="dropdown-menu shadow p-3 text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="/survey/signup/">學生註冊/登入</a></li>
                                        <li><a class="dropdown-item" href="/teacher/login/">教師登入</a></li>
                                    </ul>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <?php include($controllerLayout); ?>
        </main>
        <footer class="w-100 p-5 text-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="text-green font-weight-bold">關於</h3>
                        <p>關於我們</p>
                        <p>關於興趣測驗</p>
                        <p>聯絡我們</p>
                    </div>
                    <div class="col">
                        <h3 class="text-green font-weight-bold">條款與政策</h3>
                        <p>使用者條款</p>
                        <p>服務契約</p>
                        <p>隱私權政策</p>
                    </div>
                    <div class="col">
                        <h3 class="text-green font-weight-bold">追蹤</h3>
                        <p>
                            <i class="fa fa-facebook"></i>
                            <i class="fa fa-twitter"></i>
                            <i class="fa fa-instagram"></i>
                        </p>
                        <p>考生專區</p>
                    </div>
                    <div class="col-auto align-self-end">
                        <p>AIDK © 2021 All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="/static/js/jquery.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
            $('[data-aos="fade-up"]').attr('data-aos-duration', "1000");
        </script>  
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
                                    <h2>普通大學</h2>
                                    <ul class="row no-gutters">
                                        <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                                            <?php if ($key < 19 && $key > 0) : ?>
                                                <li class="col-3 col-md-2"><a href="/course/category/<?= $key ?>/"><?= $name ?></a></li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                    <h2>科技大學</h2>
                                    <ul class="row no-gutters">
                                        <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                                            <?php if ($key >= 19) : ?>
                                                <li class="col-3 col-md-2"><a href="/course/category/<?= $key ?>/"><?= $name ?></a></li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                    <h2 id="category-0"><a href="/course/category/0/">其他技能</a></h2>
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
                                    <li><a href="/student/portfolio/">學習歷程</a></li>
                                    <li><a href="/student/logout/">登出</a></li>
                                </ul>
                            </li>
                            <?php $user = (new StudentModel)->where(['id = :id'], [':id' => $_SESSION['id']])->fetch(); ?>
                            <li><?= $user['credit'] ?></li>
                        <?php elseif ($_SESSION['loginType'] == 2) : ?>
                            <li>
                                <a href="#!"><img src="/static/images/img_profile.svg"></a>
                                <ul class="dropmenu">
                                    <li><?= $_SESSION['name'] ?> 老師</a></li>
                                    <li><a href="/teacher/profile/">個人資料</a></li>
                                    <li><a href="/teacher/courseList/">開課清單</a></li>
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
                    <?php else : ?><li class="dropdown">
                            <a href="#!">註冊/登入</a>
                            <ul class="dropmenu">
                                <li><a class="dropdown-item" href="/survey/signup/">學生註冊/登入</a></li>
                                <li><a class="dropdown-item" href="/teacher/login/">教師登入</a></li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </header>

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
                <div class="col-12 col-xs-9 col-md-10" style="overflow-y: scroll; height: 90vh;">
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
    <?php endif ?>


    <?php if (is_file($controllerScript)) include($controllerScript); ?>

</body>

</html>