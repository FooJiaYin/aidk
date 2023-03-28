<section id="hero-section" class="my-5">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col ml-5">
                <h2>精彩課程不間斷，<br>
                豐富有趣課程就在這！</h2>
                
                <form class="search position-relative" action="/course/index/search/" method="GET">
                    <input class="form-control rounded-pill" type="search" name="keyword" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" placeholder="熱門關鍵字" aria-label="Search">
                    <i class="fa fa-search position-absolute text-orange"></i>
                </form>	
            </div>
            <div class="col">
                <img src="/static/images/index-course.png">
            </div>
        </div>
    </div>
</section>
<section class="my-5">
    <div class="container course-category"  data-aos="fade-up"  data-aos-delay="500">
        <h2 class="bar-left-orange" id="all">所有課程</h2>
        <ul class="row p-0 mx-0">
            <div class="col-6 col-sm-3 col-md-2">
                <a href="/course/all/"><li>所有課程</li></a>
            </div>
        </ul>
        <h2 class="bar-left-orange" id="普通大學">普通大學</h2>
        <ul class="row p-0 mx-0">
            <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                <?php if ($key < 19 && $key > 0) : ?>
                    <div class="col-6 col-sm-3 col-md-2">
                        <a href="/course/category/<?= $key ?>/"><li><?= $name ?></li></a>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
        <h2 class="bar-left-orange" id="科技大學">科技大學</h2>
        <ul class="row p-0 mx-0">
            <?php foreach (COURSE_CATEGORY as $key => $name) : ?>
                <?php if ($key >= 19) : ?>
                    <div class="col-6 col-sm-3 col-md-2">
                        <a href="/course/category/<?= $key ?>/"><li><?= $name ?></li></a>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
        <h2 id="其他技能"  class="bar-left-orange" >其他技能</h2>
            <ul class="row p-0 mx-0">
                <div class="col-6 col-sm-3 col-md-2">
                    <a href="/course/category/0/"><li>其他技能</li></a>
                </div>
            </ul>
        </ul>
    </div>
</section>