<div class="container">
    <h2 class="bar-left-orange mt-4 mb-0">興趣測驗問卷</h2>
    <div class="row justify-content-center align-items-center mb-5">
        <div class="col-12 col-md-5">
            <img class="img-fluid" src="/static/survey/images/<?= $question['id'] ?>.png">
        </div>
        <div class="col-12 col-md-7 col-lg-5 ml-lg-5">
            <div id="progress" class="progressBox my-4">
                <div class="row align-items-center justify-content-center">
                    <div class="label col-auto align-self-center pr-0"><b>測驗進度</b></div>
                    <div class="col">
                        <div class="progress">
                            <div class="progress-bar bg-orange" style="width:<?= $step*100/48 ?>%"></div>
                        </div>
                    </div>
                    <div class="label col-auto align-self-center pl-0"><b><?= $step ?>/48</b></div>
                </div>
            </div>
            <form action="." method="POST">
                <h2 class="survey-question"><?= $step ?>. <?= $question['description'] ?></h2>
    
                <div class="form-group">                        
                    <div class="row no-gutters star_rating text-center align-items-center my-4">
                        <div class="col">完全不符合</div>
                        <p class="col-auto mb-0 clasificacion">
                            <input id="radio1" type="radio" name="<?= $question['id'] ?>" value="5">
                            <label for="radio1"><i class="far fa-star"></i></label>
                            <input id="radio2" type="radio" name="<?= $question['id'] ?>" value="4">
                            <label for="radio2"><i class="far fa-star"></i></label>
                            <input id="radio3" type="radio" name="<?= $question['id'] ?>" value="3">
                            <label for="radio3"><i class="far fa-star"></i></label>
                            <input id="radio4" type="radio" name="<?= $question['id'] ?>" value="2">
                            <label for="radio4"><i class="far fa-star"></i></label>
                            <input id="radio5" type="radio" name="<?= $question['id'] ?>" value="1">
                            <label for="radio5"><i class="far fa-star"></i></label>
                            <input id="radio6" type="radio" name="<?= $question['id'] ?>" value="0" required>
                            <label for="radio6"><i class="far fa-star"></i></label>
                        </p>
                        <div class="col">完全符合</div>
                    </div>
                </div>
    
                <div class="text-center">
                    <button class="btn bg-green mb-5">下一題</button>
                </div>    
            </form>
        </div>
    </div>
</div>