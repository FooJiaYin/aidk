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
                <select class="form-control" id="city" onchange="filter('school', 'city', 'type')" required>
                    <option value="">選擇學校縣市</option>
                    <option value="taipei">台北</option>
                    <option value="taoyuan">桃園</option>
                    <option>新竹</option>
                    <option value="taichung">台中</option>
                    <option value="tainan">台南</option>
                    <option>外島地區</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">學校立別</label>
                <select class="form-control" id="type" onchange="filter('school', 'city', 'type')" required>
                    <option value="">選擇學校立別</option>
                    <option value="public">公立</option>
                    <option value="private">私立</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">學校名稱</label>
                <select class="form-control" id="school" name="school" required>
                    <option value="">選擇學校名稱</option>
                    <option city="taipei" type="public">建國中學</option>
                    <option city="taipei" type="public">北一女中</option>
                    <option city="taipei" type="public">師大附中</option>
                    <option city="taipei" type="public">中山女高</option>
                    <option city="taoyuan" type="public">中山女高</option>
                    <option city="taichung" type="public">台中一中</option>
                    <option city="taichung" type="private">明道中學</option>
                    <option city="tainan" type="public">台南一中</option>
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