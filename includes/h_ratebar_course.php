<div class="student-rating">
    <div class="title">
        <hr>
        <h2>ĐÁNH GIÁ TỪ HỌC VIÊN</h2>
    </div>
    <div class="the-rate">
        <ul class="the-rate1">
            <li>
                <h1>
                    <?
                        if($rowc['course_type'] == 2){
                            echo 3;
                        }elseif($rowc['course_type']==1){
                            echo 2;
                        }
                    ?>
                </h1>
            </li>
            <li class="rate_star">
                <?php
                    $qrrate = new db_query("SELECT Count(*) as total FROM rate_course WHERE course_id = $course_id");
                    $rowcount=mysql_fetch_array($qrrate->result);
                    $numrate = $rowcount['total'];
                    $star = '<img width="20px" height="20px" class="lazyload" src="/img/load.gif" data-src="../img/image/star.svg">';
                    $star1 = '<img width="20px" height="20px" class="lazyload" src="/img/load.gif" data-src="../img/image/star1.svg">';

                    if ($numrate>0) {
                        if ($rowc['course_type'] == 2) {
                            $qrsum = new db_query("SELECT sum(lesson),sum(video),sum(teacher),(sum(lesson)+sum(video)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                            $rowsum = mysql_fetch_array($qrsum->result);
                            $sumlesson =  $rowsum['sum(lesson)']/$numrate;
                            $sumteacher =  $rowsum['sum(teacher)']/$numrate;
                            $sumvideo =  $rowsum['sum(video)']/$numrate;
                            $total_rate = ($rowsum['(sum(lesson)+sum(video)+sum(teacher))']/3)/$numrate;
                            if ($sumvideo <2 && $sumvideo >=1) {
                                $video1 = 'rate-1';
                                $video2 = '20%';
                            } elseif ($sumvideo <3 && $sumvideo >=2) {
                                $video1 = 'rate-2';
                                $video2 = '40%';
                            } elseif ($sumvideo <4 && $sumvideo >=3) {
                                $video1 = 'rate-3';
                                $video2 = '60%';
                            } elseif ($sumvideo <5 && $sumvideo >=4) {
                                $video1 = 'rate-4';
                                $video2 = '80%';
                            } elseif ($sumvideo ==5) {
                                $video1 = 'rate-5';
                                $video2 = '100%';
                            } else {
                                $video1 = '';
                                $video2 = 0;
                            }
                        } elseif ($rowc['course_type'] == 1) {
                            $qrsum = new db_query("SELECT sum(lesson),sum(teacher),(sum(lesson)+sum(teacher)) FROM `rate_course` WHERE course_id = $course_id");
                            $rowsum = mysql_fetch_array($qrsum->result);
                            $sumlesson =  $rowsum['sum(lesson)']/$numrate;
                            $sumteacher =  $rowsum['sum(teacher)']/$numrate;
                            $total_rate = ($rowsum['(sum(lesson)+sum(teacher))']/2)/$numrate;
                        }

                        if ($sumlesson <2 && $sumlesson >=1) {
                            $lesson1 = 'rate-1';
                            $lesson2 = '20%';
                        } elseif ($sumlesson <3 && $sumlesson >=2) {
                            $lesson1 = 'rate-2';
                            $lesson2 = '40%';
                        } elseif ($sumlesson <4 && $sumlesson >=3) {
                            $lesson1 = 'rate-3';
                            $lesson2 = '60%';
                        } elseif ($sumlesson <5 && $sumlesson >=4) {
                            $lesson1 = 'rate-4';
                            $lesson2 = '80%';
                        } elseif ($sumlesson==5) {
                            $lesson1 = 'rate-5';
                            $lesson2 = '100%';
                        } else {
                            $lesson1 = '';
                            $lesson2 = 0;
                        }

                        if ($sumteacher <2 && $sumteacher >=1) {
                            $teacher1 = 'rate-1';
                            $teacher2 = '20%';
                        } elseif ($sumteacher <3 && $sumteacher >=2) {
                            $teacher1 = 'rate-2';
                            $teacher2 = '40%';
                        } elseif ($sumteacher <4 && $sumteacher >=3) {
                            $teacher1 = 'rate-3';
                            $teacher2 = '60%';
                        } elseif ($sumteacher <5 && $sumteacher >=4) {
                            $teacher1 = 'rate-4';
                            $teacher2 = '80%';
                        } elseif ($sumteacher==5) {
                            $teacher1 = 'rate-5';
                            $teacher2 = '100%';
                        } else {
                            $teacher1 = '';
                            $teacher2 = 0;
                        }
                    }else{
                        $sumlesson = $sumvideo =$sumteacher =$total_rate = 0;
                    }

                    if ($total_rate == 5) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                    } elseif ($total_rate < 5 && $total_rate >= 4) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                    } elseif ($total_rate < 4 && $total_rate >= 3) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                    } elseif ($total_rate < 3 && $total_rate >= 2) {
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    } elseif ($total_rate < 2 && $total_rate >= 1) {
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    } elseif ($total_rate < 1 && $total_rate >= 0) {
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }else {
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }
                ?>
            </li>
            <li id="v_count_rate"><span>( <?=$numrate;?> đánh giá )</span></li>
        </ul>
        <div class="the-rate2">
            <div class="rate-side" id="rate_side_lesson">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?php if(isset($lesson1)){
                            echo $lesson1;
                        }else{ echo 0;}?>"></div>
                    </div>
                </div>
                <span><?php if(isset($lesson2)){
                            echo $lesson2;
                        }else{ echo 0;}?></span>
                <?php
                    if ($sumlesson <2 && $sumlesson >=1) {
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    } elseif ($sumlesson <3 && $sumlesson >=2) {
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    } elseif ($sumlesson <4 && $sumlesson >=3) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                    } elseif ($sumlesson <5 && $sumlesson >=4) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                    } elseif ($sumlesson==5) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                    } else {
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }
                ?>
            </div>
            <?
                if($rowc['course_type'] == 2){
            ?>
            <div class="rate-side" id="rate_side_video">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?=$video1?>"></div>
                    </div>
                </div>
                <span><?php if(isset($video2)){
                            echo $video2;
                        }else{ echo 0;}?></span>
                <?php
                    if ($sumvideo <2 && $sumvideo >=1) {
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    } elseif ($sumvideo <3 && $sumvideo >=2) {
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    } elseif ($sumvideo <4 && $sumvideo >=3) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                    } elseif ($sumvideo <5 && $sumvideo >=4) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                    } elseif ($sumvideo ==5) {
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                    } else {
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }
                ?>
            </div>
            <?
                }
                ?>
            <div class="rate-side" id="rate_side_teacher">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?=$teacher1?>"></div>
                    </div>
                </div>
                <span><?php if(isset($teacher2)){
                            echo $teacher2;
                        }else{ echo 0;}?></span>
                <?php
                    if($sumteacher <2 && $sumteacher >=1){
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }elseif($sumteacher <3 && $sumteacher >=2){
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }elseif($sumteacher <4 && $sumteacher >=3){
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                        echo $star1;
                    }elseif($sumteacher <5 && $sumteacher >=4){
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star1;
                    }elseif($sumteacher==5){
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                        echo $star;
                    }else{
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                        echo $star1;
                    }
                ?>
            </div>
        </div>
    </div>
</div>