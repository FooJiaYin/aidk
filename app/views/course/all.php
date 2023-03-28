<section id="courses-section" class="my-5">
    <div class="container">
        <div class="course-nav">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb pb-2">
                    <li class="breadcrumb-item"><a href="/course/choose/">課程分類</a></li>
                    <li class="breadcrumb-item text-orange"  aria-current="page">所有課程</li>
                </ol>
            </nav>
        </div>
        <div class="course-sort text-grey mb-4">
            <form >
                排序：
                <div class="btn-group" role="group" >
                    <!-- <button type="submit" name="order" class="btn border-dark <?= (!isset($_GET['order']) || $_GET['order'] == 'idA') ? 'active' : '' ?>" value="idA">默認排序</button> -->
                    <button type="submit" name="order" class="btn <?= (!isset($_GET['order']) || isset($_GET['order']) && $_GET['order'] == 'idD') ? 'active' : '' ?>" value="idD">最新</button>
                    <button type="submit" name="order" class="btn <?= (isset($_GET['order']) && $_GET['order'] == 'stuCountD') ? 'active' : '' ?>" value="stuCountD">熱門</button>
                </div>
            </form>
        </div>
        <div class="row" data-aos="fade-up">
        <?php if ($courses) : ?>
        <?php foreach ($courses as $course) : ?>
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card course-card h-100 border-0 shadow" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                    <?php
                    $path = "course_data/" . $course['id'] . "/img/";
                    $imgs = array_diff(scandir($path), array('.', '..'));
                    ?>
                    <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top h-50" alt="圖">
                    <div class="card-body pt-2 pb-4">
                        <div class="text-ellipsis">
                        <?php foreach ($course['category'] as $category) : ?>
                            <a href="/course/category/<?= $category ?>/">
                                <div class="badge bg-green rounded-pill course-tag">
                                        <?= COURSE_CATEGORY[$category] ?>
                                </div>
                            </a>
                        <?php endforeach ?>
                        </div>
                        <h5 class="card-title mt-2"><?= (strlen($course['name']) > 60) ? mb_substr($course['name'], 0, 19) . "..." : $course['name'] ?></h5>
                        <div class="row justify-content-between align-items-end mb-3">
                            <div class="col-auto pr-0">
                                <p class="card-text"><i class="fa fa-clock-o text-green mr-2"></i>時數 <?= substr($course['duration'], 0, -3) ?> 分鐘</p>
                                <p class="card-text"><i class="fa fa-user text-green mr-2"></i><?= $course['stuCount'] ?> 同學</p>
                            </div>
                            <div class="col-auto">
                                <h5 class="text-green mb-0">NT$<?= $course['price'] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php else : ?>
            <div class="col-md-12 mb-4">
                <h5>沒有資料。。。</h5>
            </div>
        <?php endif ?>
        </div>
        
        <div class="mt-5 text-center">
            <a href="/course/choose">
                <button class="btn bg-orange">課程分類</button>
            </a>
        </div>
    </div>
</section>
