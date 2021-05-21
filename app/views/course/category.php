<div class="container-md">
    <div class="row mb-3 justify-content-end">
        <form >
            <div class="btn-group" role="group" >
                <!-- <button type="submit" name="order" class="btn border-dark <?= ($_GET['order'] == 'idA') ? 'active' : '' ?>" value="idA">默認排序</button> -->
                <button type="submit" name="order" class="btn border-dark <?= (!isset($_GET['order']) || isset($_GET['order']) && $_GET['order'] == 'idD') ? 'active' : '' ?>" value="idD">最新</button>
                <button type="submit" name="order" class="btn border-dark <?= (isset($_GET['order']) && $_GET['order'] == 'stuCountD') ? 'active' : '' ?>" value="stuCountD">熱門</button>
            </div>
        </form>
    </div>
    <?php if ($category) : ?>
        <div class="titleJL">
            <h1><?= COURSE_CATEGORY[$category] ?></h1>
        </div>
    <?php endif ?>
    <div class="row">
        <?php if ($courses) : ?>
            <?php foreach ($courses as $course) : ?>
                <div class="col-6 col-xs-6 col-md-4 mb-4">
                    <div class="card h-100 border-dark rounded-0" id="link_view" onclick="window.location = '/course/view/<?= $course['id'] ?>/';">
                        <?php
                        $path = "course_data/" . $course['id'] . "/img/";
                        $imgs = array_diff(scandir($path), array('.', '..'));
                        ?>
                        <img src="/course_data/<?= $course['id'] ?>/img/<?= $imgs[2] ?>" class="card-img-top" alt="圖">
                        <div class="row">
                            <div class="col-6">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $course['name'] ?></h5>
                                    <p class="card-text"><?= $course['stuCount'] ?>同學</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <?php foreach ($course['category'] as $category) : ?>
                                    <div class="card-body text-right">
                                        <h5 class="mb-1">
                                            <div class="card textC rounded-pill border-dark course_sort">
                                                <a href="/course/category/<?= $category ?>/">
                                                    <?= COURSE_CATEGORY[$category] ?>
                                                </a>
                                            </div>
                                        </h5>
                                        <!--<h5>$<?= $course['price'] ?></h5>-->
                                    </div>
                                <?php endforeach ?>
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

</div>