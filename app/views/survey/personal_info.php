<div class="container">

    <div class="infoTxt">
        嗨～你好，歡迎來到AI智能輔助學群學系推薦系統<br />
        <br />
        為了可以更精準地分析結果給你，麻煩先填寫下列資料，填完之後點選按鈕即開始進行測驗<br />
    </div>

    <form action="." method="POST">
        <div class="marT40 boxBor padR100 padL100">

            <div class="form-group">
                <label for="">請輸入E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="輸入你的聯絡E-mail" required>
            </div>
            <div class="form-group">
                <label for="">學校縣市</label>
                <select class="form-control" id="city" name="city" onchange="filter('school', 'city', 'type')" required>
                    <option value="">選擇學校縣市</option>
                    <?php foreach ($cities as $city) : ?>
                        <option value="<?= $city['city'] ?>"><?= ($city['city'] == 'other') ? "其他" : $city['city'] ?></option>
                    <?php endforeach ?>
                    <option value="other">其他</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">學校立別</label>
                <select class="form-control" id="type" name="type" onchange="filter('school', 'city', 'type')" required>
                    <option value="">選擇學校立別</option>
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['type'] ?>"><?= ($type['type'] == 'other') ? "其他" : $type['type'] ?></option>
                    <?php endforeach ?>                    
                </select>
            </div>
            <div class="form-group">
                <label for="">學校名稱</label>
                <select class="form-control" id="school" name="school" required>
                    <option value="">選擇學校名稱</option>
                    <?php foreach ($schools as $school) : ?>
                        <option city="<?= $school['city'] ?>" type="<?= $school['type'] ?>" value="<?= $school['name'] ?>"><?= ($school['name'] == 'other') ? "其他" : $school['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">就讀年級</label>
                <select class="form-control" name="grade" required>
                    <option value="">選擇就讀年級</option>
                    <option value="1">一年級</option>
                    <option value="2">二年級</option>
                    <option value="3">三年級</option>
                </select>
            </div>

            <div class="middle_jl marT20 marB50">
                <button type="submit" class="btnJL">下一題</button>
            </div>
        </div>
    </form>
</div>