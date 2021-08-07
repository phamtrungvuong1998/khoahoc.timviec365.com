                <center>
                    <div id="v_content-filter">
                        <div id="v_content-search">
                            <button id="v_content-search-btn"><img src="../../img/Search.svg" alt="Ảnh lỗi"></button>
                            <input type="text" name="keywords" id="keywords"
                                placeholder="Nhập tìm kiếm tên khóa học, tên môn học, tên học viên">
                        </div>
                        <form method="post" action="../code_xu_ly/h_GV_excel.php">
                            <input type="hidden" name="cookie_id" value="<?=$cookie_id?>">
                            <input type="hidden" name="actions" value="<?=$actions?>">

                            <div id="v_content-excel-div"><button name="btn" type="submit" id="v_content-excel"><img src="../../img/clarity_export-line.svg" alt="Ảnh lỗi">Xuất excel</button>
                            </div>
                        </form>
                    </div>
                </center>