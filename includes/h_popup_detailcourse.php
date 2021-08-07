<div class="modal fade" id="comment-rate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="exampleModalLabel">ĐÁNH GIÁ CỦA BẠN</h3>
            </div>
            <form enctype="multipart/form-data" onsubmit="return comment_rate(<?php echo $course_id; ?>);"
                name="evaluate">
                <div class="modal-body">
                    <div class="rating">
                        <div class="ratespan">
                            <span>Bài giảng</span>
                        </div>
                        <div class="starrate" id="lession_rate">
                            <input type="checkbox" name="lesson1" id="lesson1" value="0" class="checkboxs">
                            <label for="lesson1" class="star lesson1"></label>
                            <input type="checkbox" name="lesson2" id="lesson2" value="0" class="checkboxs">
                            <label for="lesson2" class="star lesson2"></label>
                            <input type="checkbox" name="lesson3" id="lesson3" value="0" class="checkboxs">
                            <label for="lesson3" class="star lesson3"></label>
                            <input type="checkbox" name="lesson4" id="lesson4" value="0" class="checkboxs">
                            <label for="lesson4" class="star lesson4"></label>
                            <input type="checkbox" name="lesson5" id="lesson5" value="0" class="checkboxs">
                            <label for="lesson5" class="star lesson5"></label>
                        </div>
                    </div>
                    <div class="rating" id="video_rate">
                        <div class="ratespan">
                            <span>Video</span>
                        </div>
                        <div class="starrate">
                            <input type="checkbox" name="video1" id="video1" value="0" class="checkboxs">
                            <label for="video1" class="star video1"></label>
                            <input type="checkbox" name="video2" id="video2" value="0" class="checkboxs">
                            <label for="video2" class="star video2"></label>
                            <input type="checkbox" name="video3" id="video3" value="0" class="checkboxs">
                            <label for="video3" class="star video3"></label>
                            <input type="checkbox" name="video4" id="video4" value="0" class="checkboxs">
                            <label for="video4" class="star video4"></label>
                            <input type="checkbox" name="video5" id="video5" value="0" class="checkboxs">
                            <label for="video5" class="star video5"></label>
                        </div>
                    </div>
                    <div class="rating" id="teacher_rate">
                        <div class="ratespan">
                            <span>Giảng viên</span>
                        </div>
                        <div class="starrate">
                            <input type="checkbox" name="teacher1" id="teacher1" value="0" class="checkboxs">
                            <label for="teacher1" class="star teacher1"></label>
                            <input type="checkbox" name="teacher2" id="teacher2" value="0" class="checkboxs">
                            <label for="teacher2" class="star teacher2"></label>
                            <input type="checkbox" name="teacher3" id="teacher3" value="0" class="checkboxs">
                            <label for="teacher3" class="star teacher3"></label>
                            <input type="checkbox" name="teacher4" id="teacher4" value="0" class="checkboxs">
                            <label for="teacher4" class="star teacher4"></label>
                            <input type="checkbox" name="teacher5" id="teacher5" value="0" class="checkboxs">
                            <label for="teacher5" class="star teacher5"></label>
                        </div>
                    </div>
                    <div class="cmtarea">
                        <textarea placeholder="Nhập đánh giá của bạn" id="comment"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-cmt"><img src="../img/Spinner-1s-200px.gif" id="btn_cmt_img" alt="" srcset=""><span id="btn_cmt_span">GỬI ĐÁNH GIÁ</span></button>
                    <p>Các đánh giá của bạn giúp học viên khác dễ dàng lựa chọn khóa học</p>
                </div>
            </form>
        </div>
    </div>
</div>