<div class="container">
    <div id="progress" class="progressBox">
        <div class="row justify-content-center">
            <div class="label col-auto align-self-center pr-0"><b>測驗進度</b></div>
            <div class="col-3">
                <div class="progress">
                    <div class="progress-bar" style="width:<?= $step*100/48 ?>%"></div>
                </div>
            </div>
            <div class="label col-auto align-self-center pl-0"><b><?= $step ?>/48</b></div>
        </div>
    </div>
    <form action="." method="POST">

        <center>
        <div>
            <img style="max-width: 60vw; max-height: 40vh;" src="/static/survey/images/<?= $question['id'] ?>.png">
        </div>
        <div class="boxBor">
            <div class="titleJL q">
                <h3><?= $step ?>. <?= $question['description'] ?></h3>
            </div>

            <div class="form-group">
                <!-- <div class="radioStyle1JL row justify-content-center">
                    <div class="form-check-inline col-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="10" value="4" required>完全符合
                        </label>
                    </div>
                    <div class="form-check-inline col-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="10" value="3">符合
                        </label>
                    </div>
                    <div class="form-check-inline col-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="10" value="2" value="3">部分符合
                        </label>
                    </div>
                    <div class="form-check-inline col-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="10" value="1" value="5">不符合
                        </label>
                    </div>
                    <div class="form-check-inline col-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="10" value="0" value="6">完全不符合
                        </label>
                    </div>
                </div> -->
                
            <div class="star_rating">
                <div class="starTxt">完全不符合</div>
                <p class="clasificacion">
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
                <div class="starTxt">完全符合</div>
            </div>
            </div>
        </div>

        <div class="middle_jl marT30">
            <button class="btnJL">下一題</button>
        </div>
        </center>

    </form>
</div>