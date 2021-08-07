    <div class="modal fade" id="comment-rate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Bạn đang đánh giá <?php echo $rowCenter['user_name']?></h2>
                    <p>Đánh giá của bạn giúp hàng ngàn học viên lựa chọn nơi học tốt hơn</p>
                </div>
                <form enctype="multipart/form-data" onsubmit="return false">
                    <div class="modal-body">
                        <div class="form-group">
                            <h3 class="form-label">Bạn đã học khóa học nào ở đây?</h3>
                            <input type="text" class="form-control" name="course_learn" id="course_learn"
                                placeholder="Tên khóa học bạn đã học">
                        </div>
                        <div class="form-group">
                            <h3 class="form-label">Đánh giá chung</h3>
                            <div class="form-rate">
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Giảng viên</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="teacher1" id="teacher1" value="0"
                                            class="checkboxs">
                                        <label for="teacher1" class="star teacher1"></label>
                                        <input type="checkbox" name="teacher2" id="teacher2" value="0"
                                            class="checkboxs">
                                        <label for="teacher2" class="star teacher2"></label>
                                        <input type="checkbox" name="teacher3" id="teacher3" value="0"
                                            class="checkboxs">
                                        <label for="teacher3" class="star teacher3"></label>
                                        <input type="checkbox" name="teacher4" id="teacher4" value="0"
                                            class="checkboxs">
                                        <label for="teacher4" class="star teacher4"></label>
                                        <input type="checkbox" name="teacher5" id="teacher5" value="0"
                                            class="checkboxs">
                                        <label for="teacher5" class="star teacher5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Tư vấn xếp lớp</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="place_class1" id="place_class1" value="0"
                                            class="checkboxs">
                                        <label for="place_class1" class="star place_class1"></label>
                                        <input type="checkbox" name="place_class2" id="place_class2" value="0"
                                            class="checkboxs">
                                        <label for="place_class2" class="star place_class2"></label>
                                        <input type="checkbox" name="place_class3" id="place_class3" value="0"
                                            class="checkboxs">
                                        <label for="place_class3" class="star place_class3"></label>
                                        <input type="checkbox" name="place_class4" id="place_class4" value="0"
                                            class="checkboxs">
                                        <label for="place_class4" class="star place_class4"></label>
                                        <input type="checkbox" name="place_class5" id="place_class5" value="0"
                                            class="checkboxs">
                                        <label for="place_class5" class="star place_class5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Cơ sở vật chất</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="infrastructure1" id="infrastructure1" value="0"
                                            class="checkboxs">
                                        <label for="infrastructure1" class="star infrastructure1"></label>
                                        <input type="checkbox" name="infrastructure2" id="infrastructure2" value="0"
                                            class="checkboxs">
                                        <label for="infrastructure2" class="star infrastructure2"></label>
                                        <input type="checkbox" name="infrastructure3" id="infrastructure3" value="0"
                                            class="checkboxs">
                                        <label for="infrastructure3" class="star infrastructure3"></label>
                                        <input type="checkbox" name="infrastructure4" id="infrastructure4" value="0"
                                            class="checkboxs">
                                        <label for="infrastructure4" class="star infrastructure4"></label>
                                        <input type="checkbox" name="infrastructure5" id="infrastructure5" value="0"
                                            class="checkboxs">
                                        <label for="infrastructure5" class="star infrastructure5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Số lượng học viên</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="student_number1" id="student_number1" value="0"
                                            class="checkboxs">
                                        <label for="student_number1" class="star student_number1"></label>
                                        <input type="checkbox" name="student_number2" id="student_number2" value="0"
                                            class="checkboxs">
                                        <label for="student_number2" class="star student_number2"></label>
                                        <input type="checkbox" name="student_number3" id="student_number3" value="0"
                                            class="checkboxs">
                                        <label for="student_number3" class="star student_number3"></label>
                                        <input type="checkbox" name="student_number4" id="student_number4" value="0"
                                            class="checkboxs">
                                        <label for="student_number4" class="star student_number4"></label>
                                        <input type="checkbox" name="student_number5" id="student_number5" value="0"
                                            class="checkboxs">
                                        <label for="student_number5" class="star student_number5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Môi trường HT</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="enviroment1" id="enviroment1" value="0"
                                            class="checkboxs">
                                        <label for="enviroment1" class="star enviroment1"></label>
                                        <input type="checkbox" name="enviroment2" id="enviroment2" value="0"
                                            class="checkboxs">
                                        <label for="enviroment2" class="star enviroment2"></label>
                                        <input type="checkbox" name="enviroment3" id="enviroment3" value="0"
                                            class="checkboxs">
                                        <label for="enviroment3" class="star enviroment3"></label>
                                        <input type="checkbox" name="enviroment4" id="enviroment4" value="0"
                                            class="checkboxs">
                                        <label for="enviroment4" class="star enviroment4"></label>
                                        <input type="checkbox" name="enviroment5" id="enviroment5" value="0"
                                            class="checkboxs">
                                        <label for="enviroment5" class="star enviroment5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Quan tâm học viên</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="student_care1" id="student_care1" value="0"
                                            class="checkboxs">
                                        <label for="student_care1" class="star student_care1"></label>
                                        <input type="checkbox" name="student_care2" id="student_care2" value="0"
                                            class="checkboxs">
                                        <label for="student_care2" class="star student_care2"></label>
                                        <input type="checkbox" name="student_care3" id="student_care3" value="0"
                                            class="checkboxs">
                                        <label for="student_care3" class="star student_care3"></label>
                                        <input type="checkbox" name="student_care4" id="student_care4" value="0"
                                            class="checkboxs">
                                        <label for="student_care4" class="star student_care4"></label>
                                        <input type="checkbox" name="student_care5" id="student_care5" value="0"
                                            class="checkboxs">
                                        <label for="student_care5" class="star student_care5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Thực hành </label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="practice1" id="practice1" value="0"
                                            class="checkboxs">
                                        <label for="practice1" class="star practice1"></label>
                                        <input type="checkbox" name="practice2" id="practice2" value="0"
                                            class="checkboxs">
                                        <label for="practice2" class="star practice2"></label>
                                        <input type="checkbox" name="practice3" id="practice3" value="0"
                                            class="checkboxs">
                                        <label for="practice3" class="star practice3"></label>
                                        <input type="checkbox" name="practice4" id="practice4" value="0"
                                            class="checkboxs">
                                        <label for="practice4" class="star practice4"></label>
                                        <input type="checkbox" name="practice5" id="practice5" value="0"
                                            class="checkboxs">
                                        <label for="practice5" class="star practice5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Hài lòng về học phí</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="pround_price1" id="pround_price1" value="0"
                                            class="checkboxs">
                                        <label for="pround_price1" class="star pround_price1"></label>
                                        <input type="checkbox" name="pround_price2" id="pround_price2" value="0"
                                            class="checkboxs">
                                        <label for="pround_price2" class="star pround_price2"></label>
                                        <input type="checkbox" name="pround_price3" id="pround_price3" value="0"
                                            class="checkboxs">
                                        <label for="pround_price3" class="star pround_price3"></label>
                                        <input type="checkbox" name="pround_price4" id="pround_price4" value="0"
                                            class="checkboxs">
                                        <label for="pround_price4" class="star pround_price4"></label>
                                        <input type="checkbox" name="pround_price5" id="pround_price5" value="0"
                                            class="checkboxs">
                                        <label for="pround_price5" class="star pround_price5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Tiến bộ bản thân</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="self_improvement1" id="self_improvement1" value="0"
                                            class="checkboxs">
                                        <label for="self_improvement1" class="star self_improvement1"></label>
                                        <input type="checkbox" name="self_improvement2" id="self_improvement2" value="0"
                                            class="checkboxs">
                                        <label for="self_improvement2" class="star self_improvement2"></label>
                                        <input type="checkbox" name="self_improvement3" id="self_improvement3" value="0"
                                            class="checkboxs">
                                        <label for="self_improvement3" class="star self_improvement3"></label>
                                        <input type="checkbox" name="self_improvement4" id="self_improvement4" value="0"
                                            class="checkboxs">
                                        <label for="self_improvement4" class="star self_improvement4"></label>
                                        <input type="checkbox" name="self_improvement5" id="self_improvement5" value="0"
                                            class="checkboxs">
                                        <label for="self_improvement5" class="star self_improvement5"></label>
                                    </div>

                                </div>
                                <div class="rating">
                                    <div class="ratelabel">
                                        <label>Sẵn sàng giới thiệu</label>
                                    </div>
                                    <div class="starrate">
                                        <input type="checkbox" name="ready_introduct1" id="ready_introduct1" value="0"
                                            class="checkboxs">
                                        <label for="ready_introduct1" class="star ready_introduct1"></label>
                                        <input type="checkbox" name="ready_introduct2" id="ready_introduct2" value="0"
                                            class="checkboxs">
                                        <label for="ready_introduct2" class="star ready_introduct2"></label>
                                        <input type="checkbox" name="ready_introduct3" id="ready_introduct3" value="0"
                                            class="checkboxs">
                                        <label for="ready_introduct3" class="star ready_introduct3"></label>
                                        <input type="checkbox" name="ready_introduct4" id="ready_introduct4" value="0"
                                            class="checkboxs">
                                        <label for="ready_introduct4" class="star ready_introduct4"></label>
                                        <input type="checkbox" name="ready_introduct5" id="ready_introduct5" value="0"
                                            class="checkboxs">
                                        <label for="ready_introduct5" class="star ready_introduct5"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3 class="form-label nx">Nhận xét</h3>
                            <div class="form-textarea">
                                <label>Tiêu đề đánh giá:</label>
                                <input type="text" class="form-control" name="title_rate" id="title_rate"
                                    placeholder="Nhập tên tiêu đề">
                            </div>
                            <div class="form-textarea">
                                <label>Ưu điểm:</label>
                                <textarea class="form-control" name="advantages" id="advantages"
                                    placeholder="Hãy cho chúng tôi biết ưu điểm của giảng viên"></textarea>
                            </div>
                            <div class="form-textarea">
                                <label>Khuyết điểm:</label>
                                <textarea class="form-control" name="weakness" id="weakness"
                                    placeholder="Bạn cần giảng viên cải thiện điều gì"></textarea>
                            </div>
                            <div class="form-textarea">
                                <label>Trải nghiệm và lời khuyên cho học viên mới:</label>
                                <textarea class="form-control" name="comment_experiment" id="comment_experiment"
                                    placeholder="Nêu cảm nhận của bạn về giảng viên và lời khuyên cho các bạn học viên khác"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-checkbox">
                                <div class="form-checkbox1">
                                    <input checked type="checkbox" name="">
                                </div>

                                <label>Nên mua khóa học</label>
                            </div>
                            <div class="form-checkbox">
                                <div class="form-checkbox1">
                                    <input required checked type="checkbox">
                                </div>
                                <label>Tôi cam đoan đây là nhận xét trung thực và khách quan dựa trên những trải nghiệm
                                    của tôi về trung tâm <span><?=$rowCenter['user_name']?></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="comment_rate()" name="save-btn" id="addcomment" class="save-btn"
                            data-avatar="<?=$row['user_avatar']?>" data-user_name="<?=$row['user_name']?>"
                            data-center_id="<?=$center_id?>" data-student_id="<?=$cookie_id?>">Đăng bình luận</button>
                        <button type="button" class="close-btn" data-dismiss="modal">Hủy đăng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>