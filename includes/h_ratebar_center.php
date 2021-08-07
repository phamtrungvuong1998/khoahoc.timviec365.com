<div class="hailong">
    <div class="spanhailong">
        <span class="udiem-mucdo">Mức độ hài lòng</span>
    </div>
    <div class="all-mucdo">
        <?
        $qrcount = new db_query("SELECT Count(*) as total FROM rate_center WHERE center_id = $center_id");
        $rowcount = mysql_fetch_array($qrcount->result);
        $numrate = $rowcount['total'];
        //echo $numrate;
        $qrsum = new db_query("SELECT sum(place_class),sum(infrastructure),sum(teacher),sum(student_number),sum(enviroment),sum(student_care),sum(practice),sum(pround_price),sum(self_improvement),sum(ready_introduct)
                                    FROM rate_center WHERE center_id = $center_id");
        $rowsum = mysql_fetch_array($qrsum->result);
        if ($numrate == 0) {
            $sumplace = 0;
            $suminfras = 0;
            $sumteacher = 0;
            $sumstdnum = 0;
            $sumenviro = 0;
            $sumstdcare = 0;
            $sumpractice = 0;
            $sumpround = 0;
            $sumself = 0;
            $sumready = 0;

            $teacher1 = '';
            $teacher2 = 0;
            $place_class1 = '';
            $place_class2 = 0;
            $infrastructure1 = '';
            $infrastructure2 = 0;
            $student_number1 = '';
            $student_number2 = 0;
            $enviroment1 = '';
            $enviroment2 = 0;
            $student_care1 = '';
            $student_care2 = 0;
            $practice1 = '';
            $practice2 = 0;
            $self_improvement1 = '';
            $self_improvement2 = 0;
            $pround_price1 = '';
            $pround_price2 = 0;
            $ready_introduct1 = '';
            $ready_introduct2 = 0;
        } else {
            $sumplace = $rowsum['sum(place_class)'] / $numrate;
            $suminfras = $rowsum['sum(infrastructure)'] / $numrate;
            $sumteacher = $rowsum['sum(teacher)'] / $numrate;
            $sumstdnum = $rowsum['sum(student_number)'] / $numrate;
            $sumenviro = $rowsum['sum(enviroment)'] / $numrate;
            $sumstdcare = $rowsum['sum(student_care)'] / $numrate;
            $sumpractice = $rowsum['sum(practice)'] / $numrate;
            $sumpround = $rowsum['sum(pround_price)'] / $numrate;
            $sumself = $rowsum['sum(self_improvement)'] / $numrate;
            $sumready = $rowsum['sum(ready_introduct)'] / $numrate;
        }
        if ($sumteacher < 2 && $sumteacher >= 1) {
            $teacher1 = 'rate-1';
            $teacher2 = '20%';
        } elseif ($sumteacher < 3 && $sumteacher >= 2) {
            $teacher1 = 'rate-2';
            $teacher2 = '40%';
        } elseif ($sumteacher < 4 && $sumteacher >= 3) {
            $teacher1 = 'rate-3';
            $teacher2 = '60%';
        } elseif ($sumteacher < 5 && $sumteacher >= 4) {
            $teacher1 = 'rate-4';
            $teacher2 = '80%';
        } elseif ($sumteacher == 5) {
            $teacher1 = 'rate-5';
            $teacher2 = '100%';
        } else {
            $teacher1 = '';
            $teacher2 = 0;
        }

        if ($sumplace < 2 && $sumplace >= 1) {
            $place_class1 = 'rate-1';
            $place_class2 = '20%';
        } elseif ($sumplace < 3 && $sumplace >= 2) {
            $place_class1 = 'rate-2';
            $place_class2 = '40%';
        } elseif ($sumplace < 4 && $sumplace >= 3) {
            $place_class1 = 'rate-3';
            $place_class2 = '60%';
        } elseif ($sumplace < 5 && $sumplace >= 4) {
            $place_class1 = 'rate-4';
            $place_class2 = '80%';
        } elseif ($sumplace == 5) {
            $place_class1 = 'rate-5';
            $place_class2 = '100%';
        } else {
            $place_class1 = '';
            $place_class2 = 0;
        }

        if ($suminfras < 2 && $suminfras >= 1) {
            $infrastructure1 = 'rate-1';
            $infrastructure2 = '20%';
        } elseif ($suminfras < 3 && $suminfras >= 2) {
            $infrastructure1 = 'rate-2';
            $infrastructure2 = '40%';
        } elseif ($suminfras < 4 && $suminfras >= 3) {
            $infrastructure1 = 'rate-3';
            $infrastructure2 = '60%';
        } elseif ($suminfras < 5 && $suminfras >= 4) {
            $infrastructure1 = 'rate-4';
            $infrastructure2 = '80%';
        } elseif ($suminfras == 5) {
            $infrastructure1 = 'rate-5';
            $infrastructure2 = '100%';
        } else {
            $infrastructure1 = '';
            $infrastructure2 = 0;
        }

        if ($sumstdnum  < 2 && $sumstdnum >= 1) {
            $student_number1 = 'rate-1';
            $student_number2 = '20%';
        } elseif ($sumstdnum  < 3 && $sumstdnum >= 2) {
            $student_number1 = 'rate-2';
            $student_number2 = '40%';
        } elseif ($sumstdnum  < 4 && $sumstdnum >= 3) {
            $student_number1 = 'rate-3';
            $student_number2 = '60%';
        } elseif ($sumstdnum  < 5 && $sumstdnum >= 4) {
            $student_number1 = 'rate-4';
            $student_number2 = '80%';
        } elseif ($sumstdnum == 5) {
            $student_number1 = 'rate-5';
            $student_number2 = '100%';
        } else {
            $student_number1 = '';
            $student_number2 = 0;
        }

        if ($sumenviro < 2 && $sumenviro >= 1) {
            $enviroment1 = 'rate-1';
            $enviroment2 = '20%';
        } elseif ($sumenviro < 3 && $sumenviro >= 2) {
            $enviroment1 = 'rate-2';
            $enviroment2 = '40%';
        } elseif ($sumenviro < 4 && $sumenviro >= 3) {
            $enviroment1 = 'rate-3';
            $enviroment2 = '60%';
        } elseif ($sumenviro < 5 && $sumenviro >= 4) {
            $enviroment1 = 'rate-4';
            $enviroment2 = '80%';
        } elseif ($sumenviro == 5) {
            $enviroment1 = 'rate-5';
            $enviroment2 = '100%';
        } else {
            $enviroment1 = '';
            $enviroment2 = 0;
        }

        if ($sumstdcare < 2 && $sumstdcare >= 1) {
            $student_care1 = 'rate-1';
            $student_care2 = '20%';
        } elseif ($sumstdcare < 3 && $sumstdcare >= 2) {
            $student_care1 = 'rate-2';
            $student_care2 = '40%';
        } elseif ($sumstdcare < 4 && $sumstdcare >= 3) {
            $student_care1 = 'rate-3';
            $student_care2 = '60%';
        } elseif ($sumstdcare < 5 && $sumstdcare >= 4) {
            $student_care1 = 'rate-4';
            $student_care2 = '80%';
        } elseif ($sumstdcare == 5) {
            $student_care1 = 'rate-5';
            $student_care2 = '100%';
        } else {
            $student_care1 = '';
            $student_care2 = 0;
        }

        if ($sumpractice < 2 && $sumpractice >= 1) {
            $practice1 = 'rate-1';
            $practice2 = '20%';
        } elseif ($sumpractice < 3 && $sumpractice >= 2) {
            $practice1 = 'rate-2';
            $practice2 = '40%';
        } elseif ($sumpractice < 4 && $sumpractice >= 3) {
            $practice1 = 'rate-3';
            $practice2 = '60%';
        } elseif ($sumpractice < 5 && $sumpractice >= 4) {
            $practice1 = 'rate-4';
            $practice2 = '80%';
        } elseif ($sumpractice == 5) {
            $practice1 = 'rate-5';
            $practice2 = '100%';
        } else {
            $practice1 = '';
            $practice2 = 0;
        }

        if ($sumself < 2 && $sumself >= 1) {
            $self_improvement1 = 'rate-1';
            $self_improvement2 = '20%';
        } elseif ($sumself < 3 && $sumself >= 2) {
            $self_improvement1 = 'rate-2';
            $self_improvement2 = '40%';
        } elseif ($sumself < 4 && $sumself >= 3) {
            $self_improvement1 = 'rate-3';
            $self_improvement2 = '60%';
        } elseif ($sumself < 5 && $sumself >= 4) {
            $self_improvement1 = 'rate-4';
            $self_improvement2 = '80%';
        } elseif ($sumself == 5) {
            $self_improvement1 = 'rate-5';
            $self_improvement2 = '100%';
        } else {
            $self_improvement1 = '';
            $self_improvement2 = 0;
        }

        if ($sumpround < 2 && $sumpround >= 1) {
            $pround_price1 = 'rate-1';
            $pround_price2 = '20%';
        } elseif ($sumpround < 3 && $sumpround >= 2) {
            $pround_price1 = 'rate-2';
            $pround_price2 = '40%';
        } elseif ($sumpround < 4 && $sumpround >= 3) {
            $pround_price1 = 'rate-3';
            $pround_price2 = '60%';
        } elseif ($sumpround < 5 && $sumpround >= 4) {
            $pround_price1 = 'rate-4';
            $pround_price2 = '80%';
        } elseif ($sumpround == 5) {
            $pround_price1 = 'rate-5';
            $pround_price2 = '100%';
        } else {
            $pround_price1 = '';
            $pround_price2 = 0;
        }

        if ($sumready < 2 && $sumready >= 1) {
            $ready_introduct1 = 'rate-1';
            $ready_introduct2 = '20%';
        } elseif ($sumready < 3 && $sumready >= 2) {
            $ready_introduct1 = 'rate-2';
            $ready_introduct2 = '40%';
        } elseif ($sumready < 4 && $sumready >= 3) {
            $ready_introduct1 = 'rate-3';
            $ready_introduct2 = '60%';
        } elseif ($sumready < 5 && $sumready >= 4) {
            $ready_introduct1 = 'rate-4';
            $ready_introduct2 = '80%';
        } elseif ($sumready == 5) {
            $ready_introduct1 = 'rate-5';
            $ready_introduct2 = '100%';
        } else {
            $ready_introduct1 = '';
            $ready_introduct2 = 0;
        }

        ?>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $teacher1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Giáo viên</span></div>
                <div class="span2"><span><?= $teacher2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $place_class1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Tư vấn xếp lớp</span></div>
                <div class="span2"><span><?= $place_class2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $infrastructure1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Cơ sở vật chất</span></div>
                <div class="span2"><span><?= $infrastructure2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $student_number1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Số lượng học viên</span></div>
                <div class="span2"><span><?= $student_number2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $enviroment1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Môi trường HT</span></div>
                <div class="span2"><span><?= $enviroment2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $student_care1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Quan tâm học viên</span></div>
                <div class="span2"><span><?= $student_care2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $practice1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Thực hành kỹ năng</span></div>
                <div class="span2"><span><?= $practice2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $pround_price1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Hài lòng về học phí</span></div>
                <div class="span2"><span><?= $pround_price2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $self_improvement1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Tiến độ bản thân</span></div>
                <div class="span2"><span><?= $self_improvement2 ?></span></div>
            </div>
        </div>
        <div class="mucdo1">
            <div class="rate-side">
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-rate" id="<?= $ready_introduct1 ?>"></div>
                    </div>
                </div>
            </div>
            <div class="number-side">
                <div class="span1"><span>Sẵn sàng giới thiệu</span></div>
                <div class="span2"><span><?= $ready_introduct2 ?></span></div>
            </div>
        </div>
        <?

        ?>
    </div>
</div>