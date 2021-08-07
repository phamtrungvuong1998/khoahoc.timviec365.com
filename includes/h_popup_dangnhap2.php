<div class="modal fade" id="modal-login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close signclose" data-dismiss="modal" aria-label="Close">x</button>
            <div class="modal-content1">
                <div id="thebur"></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Đăng nhập học viên</h5>
                </div>
                <div id="error_ajax1"></div>
                <form class="modal-body" onsubmit="return popuplogin2()">
                    <div class="signbody">
                        <div class="signbody1">
                            <input type="email" name="usermail" id="usermail" class="inputlogin"
                                placeholder="Email đăng nhập">
                            <div id="error1" class="error"></div>
                        </div>
                        <div class="signbody1">
                            <input type="password" name="userpass" id="userpass" class="inputlogin"
                                placeholder="Mật khẩu">
                            <div id="error2" class="error"></div>
                        </div>
                        <div class="signbody2">
                            <button id="sbm_login" type="submit">ĐĂNG NHẬP</button>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <div class="divfootsign"><a href="/quen-mat-khau.html">Quên mật khẩu</a></div>
                    <div class="divfootsign1">Nếu bạn chưa đăng ký? <a href="/dang-ki-hoc-vien.html">Đăng ký</a></div>
                </div>
            </div>
        </div>
    </div>
</div>