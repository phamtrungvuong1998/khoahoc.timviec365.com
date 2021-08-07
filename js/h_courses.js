function changeImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#avatar').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function changeImg1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#avatar1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function isnumber(evt) {
    var num = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(num))) {
        evt.preventDefault();
    }
}

function v_isnumber(evt) {
    var num = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(num))) {
        evt.preventDefault();
    }
}

$(document).ready(function() {
    $('.cate2').select2({
        data: $('.cate2db').val()
    });
    $('.tag2').select2({
        data: $('.tag2db').val()
    });
    $('.teach2').select2();
    // $(".select2-container").eq(0).css("width","93% !important");
    // $(".select2-container").eq(1).css("width","93% !important");
    $('#cit_id').select2({
        data: $('.chontinhthanh').val()
    });
    $('#district_id').select2({
        data: $('.chonquanhuyen').val()
    });
    $('.camera-img').click(function() {
        $('#img').click();
    });
    $('.camera-img1').click(function() {
        $('#img1').click();
    });
    $('#addprices').on('click', function() {
        $('.addnewprices').css("display", "block");
        $('#clearaddprice').css("display", "none");
    });
    $('#cate_multip').select2({
            multiple: true,
            maximumSelectionLength: 5,
            minimumInputLength: 0,
        });
    // $('.clickvideo2').click(function() {
    //     $('.clickvideo2').eq($(this).index('.clickvideo2')).prev().click();
    // });
    // $('.clickdoc2').click(function() {
    //     $('.clickdoc2').eq($(this).index('.clickdoc2')).prev().click();
    // });
    // $('.video').change(function(event) {
    //     $(".vsp").eq($(this).index('.video')).text(event.target.files[0].name);
    // });
    // $('.document').change(function(event) {
    //     $(".lsp").eq($(this).index('.document')).text(event.target.files[0].name);
    // });

    $('#cate_id').change(function() {
        cate_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_cate_tag.php",
            dataType: 'json',
            data: {
                cate_id: cate_id
            },
            success: function(data) {
                $("#tag_id").html(data.html);
                $("#tag2").html(data.html);
            }
        });
    });
    $('#cit_id').change(function() {
        tinh = $(this).val();
        $.ajax({
            type: "POST",
            url: "/../ajax/h_ajax_load_city.php",
            data: {
                tinh: tinh
            },
            success: function(result) {
                $("#district_id").html(result);
            }
        });
    });

});
function clickVideo2(e){
    $(e).prev().click();
    $('.video').change(function(event) {
        $(".vsp").eq($(this).index('.video')).text(event.target.files[0].name);
    });
}
function clickDoc2(e){
    $(e).prev().click();
    $('.document').change(function(event) {
        $(".lsp").eq($(this).index('.document')).text(event.target.files[0].name);
    });
}
function addnewpost(e){
    var count_post_item = $('.post-item').length;
        count_post_item = Number(count_post_item) + 1;
    var count_post_item2 = $('.postrightitem').length;
        count_post_item2 = Number(count_post_item2) + 1;
        html = `
            <div class="post-item">
                <div class="postright">
                    <div class="postright1">
                        <div class="postright11">
                            <input type="text" name="season_name[]" class="season_name part1" placeholder="Phần `+count_post_item +` :Tên phần">
                        </div>
                    </div>
                    <div class="allpostright24">
                        <div class="csspostrightitem postrightitem">
                            <div class="postright2">
                                <div class="postright21">
                                    <img src="../img/image/scroll.svg">
                                </div>
                                <div class="postright22">
                                    <img onclick="clickvideo(this)" class="clickvideo" src="../img/image/video.svg">
                                    <input type="text" class="episode_name part" name="episode_name[]"
                                        placeholder="Tên bài">
                                </div>
                            </div>
                            <div class="csspostright4 thepostright">
                                <ul class="postright41">
                                    <li class="upvideo activeli1" onclick="upvideo(this)"> Upload video</li>
                                    <li class="upfile" onclick="upfile(this)">Upload tài liệu</li>
                                </ul>
                                <div class="upvideo1">
                                    <input type="file" class="video" name="video" >
                                    <label onclick="clickVideo2(this)">CHỌN FILE</label>
                                    <span class="vsp">Chỉ được up file mp4</span>
                                </div>
                                <div class="upfile1">
                                    <input type="file" class="document" name="document" >
                                    <label onclick="clickDoc2(this)">CHỌN FILE</label>
                                    <span class="lsp">Chỉ được up file pdf</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="postright3" onclick="addlesson(this)">
                        <div class="postright31">
                            <img src="../img/image/add2.svg">
                            <p>Thêm bài giảng</p>
                        </div>
                    </div>
                </div>
                <img class="move1" src="../img/image/up.svg">
                <img class="clear1" onclick="clears(this)" src="../img/image/delete.svg">
            </div>        
        `;
        $('#allposthere').append(html);
}

function addlesson(e){
    var n = $(e).parents(".postright").outerHeight() + 46;
    $(e).parents(".postright").animate({
        'height': n + "px"
    });
    var count_post_item = $('.postrightitem').length;
        count_post_item = Number(count_post_item) + 1;
    var html =`
        <div class="csspostrightitem postrightitem">
            <div class="postright2">
                <div class="postright21">
                    <img src="../img/image/scroll.svg">
                </div>
                <div class="postright22">
                    <img onclick="clickvideo(this)" class="clickvideo" src="../img/image/video.svg">
                    <input type="text" class="episode_name part" name="episode_name[]"
                        placeholder="Tên bài">
                </div>
            </div>
            <div class="csspostright4 thepostright">
                <ul class="postright41">
                    <li class="upvideo activeli1" onclick="upvideo(this)">Upload video</li>
                    <li class="upfile" onclick="upfile(this)">Upload tài liệu</li>
                </ul>
                <div class="upvideo1">
                    <input type="file" class="video" name="video" >
                    <label onclick="clickVideo2(this)">CHỌN FILE</label>
                    <span class="vsp">Chỉ được up file mp4</span>
                </div>
                <div class="upfile1">
                    <input type="file" class="document" name="document" >
                    <label onclick="clickDoc2(this)">CHỌN FILE</label>
                    <span class="lsp">Chỉ được up file pdf</span>
                </div>
            </div>
            <p class="xclear" onclick="clears(this)">X</p>
        </div>
    `;
    $(e).prev().append(html);
}

function clickvideo(e){
    if ($(e).parent().parent().next().css('display') == 'none') {
        var n = $(e).parents(".postright").height() + 179;
        $(e).parents(".postright").animate({
            'height': n,
            });
    }else if ($(e).parent().parent().next().css('display') == 'block'){
        var n = $(e).parents(".postright").height() - 100;
        $(e).parents(".postright").animate({
            'height': n,
        });
    }
    $(e).parent().parent().next().toggle("shower");
}
function clears(e) {
    // console.log($(e).parents(".postright").outerHeight());
    var n = $(e).parents(".postright").outerHeight() - 46;
    $(e).parents(".postright").css('height', n);
    $(e).parent().remove();
}
function upvideo(e){
    $(e).parent().next().css('display','block');
    $(e).addClass("activeli1");
    $(e).parent().next().next().css('display','none');
    $(e).next().removeClass("activeli1");
}

function upfile(e){
    $(e).parent().next().css('display','none');
    $(e).prev().removeClass("activeli1");
    $(e).parent().next().next().css('display','block');
    $(e).addClass("activeli1");
}