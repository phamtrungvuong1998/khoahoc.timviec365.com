<div id="l_id_updatePass" class="l_password">
    <form onsubmit="l_submit(); return false;" class="l_modal-content l_animate" >
        <div class="l_form_title">
            <div class="l_form_title_item1">
                Thay đổi mật khẩu
            </div>
            <div class="l_form_title_item2">
                <div id="l_close_updatepass" onclick="document.getElementById('l_id_updatePass').style.display='none';$('#l_success').html('');">
                    <img class="lazyload" src="../img/image/Group 31755.svg" alt="icon">
                </div>
            </div>
        </div>
        <div id="l_success"></div>
        <div class="l_form_pass_item">
            <div class="l_form_text">
                Mật khẩu hiện tại
            </div>
            <div class="l_form_input">
                <input type="password" value="" name="password" id="l_ipnPassword1" onkeypress="istrim(event)">
                <div class="l_form_input_img" onclick="l_btnPassword()">
                    <img class="lazyload" src="../img/image/Group 31759.svg" alt="icon">
                </div>
            </div>
            <p id="l_errorPass1" class="l_colorPass"></p>
        </div>
        <div class="l_form_pass_item">
            <div class="l_form_text">
                Mật khẩu mới
            </div>
            <div class="l_form_input">
                <input type="password" value="" name="passwordnew" id="l_ipnPasswordnew1" onkeypress="istrim(event)">
                <div class="l_form_input_img" onclick="l_ipnPasswordnew()">
                    <img class="lazyload" src="../img/image/Group 31759.svg" alt="icon">
                </div>
            </div>
            <p id="l_errorPass2" class="l_colorPass"></p>
        </div>
        <div class="l_form_pass_item">
            <div class="l_form_text">
                Nhập lại mật khẩu mới
            </div>
            <div class="l_form_input">
                <input type="password" value="" name="retypepass" id="l_retypepass1" onkeypress="istrim(event)">
                <div class="l_form_input_img" onclick="l_retypepass()">
                    <img class="lazyload" src="../img/image/Group 31759.svg" alt="icon">
                </div>
            </div>
            <p id="l_errorPass3" class="l_colorPass"></p>
        </div>
        <div class="l_btn_sukien">
            <button class="l_sukien_item" type="submit" onclick="l_submit(); return false;">ĐỔI MẬT KHẨU</button>
            <button class="l_sukien_item" type="button" onclick="document.getElementById('l_id_updatePass').style.display='none';$('#l_success').html('');">HỦY BỎ</button>
        </div>
    </form>
</div>
