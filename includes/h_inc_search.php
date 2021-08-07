<div id="search-bg-img">
    <div class="title-search">
        <h1>TÌM KHÓA HỌC</h1>
    </div>
    <div class="search-main">
        <ul>
            <li id="hoc-online"
                class="<?php if(isset($actived) && $actived == "online"){echo 'activeli';}elseif(!isset($actived)){echo 'activeli';}else{echo '';}?>">
                HỌC ONLINE
            </li>
            <li id="hoc-offline" class="<?php if(isset($actived) && $actived == "offline"){echo 'activeli';}?>">HỌC
                OFFLINE</li>
        </ul>
        <div id="search-online" style="<?php if(isset($actived) && $actived == "online"){echo 'display: inline-block';}elseif(!isset($actived)){echo 'display:inline-block';}else{echo 'display:none';}?>">
            <form method="GET" action="../code_xu_ly/v_search.php" onsubmit="return searchSubmitON();">
                <div class="input-search search1">
                    <input type="text" id="keyword1" onkeyup="v_search(1,'online')" name="keyword1"
                        placeholder="Nhập tên khóa học..." autocomplete="off">
                </div>
                <div class="btn-search"><button name="btn_search_online" value="2"><img width="22px" height="22px"
                            class="lazyload" src="/img/load.gif" data-src="../img/webp/search.svg"></button>
                </div>
            </form>
        </div>
        <div id="search-offline"
            style="<?php if(isset($actived) && $actived == "offline"){echo 'display: inline-block';}?>">
            <form method="GET" action="../code_xu_ly/v_search.php" onsubmit="return searchSubmitOFF();">
                <div class="input-search">
                    <input type="text" id="keyword2" name="keyword2" onkeyup="v_search(2,'offline')"
                        placeholder="Nhập tên khóa học..." autocomplete="off">
                </div>
                <div class="select-search">
                    <input type="text" id="keyword3" name="keyword3"
                        placeholder="Chọn tỉnh thành..." autocomplete="off" readonly>
                </div>
                <div class="btn-search"><button name="btn_search_offline" value="2" type="submit"><img class="lazyload"
                            width="22px" height="22px" src="/img/load.gif" data-src="../img/webp/search.svg"></button>
                </div>
            </form>
        </div>
        <div id="auto-online" class="auto-complete">
            <div class="v_del2">x</div>
            <div class="auto1">
                <div class="autoleft">
                    <ul id="ul-online">
                        <?php 
                    $qrCate = new db_query("SELECT * FROM categories");
                    while ($rowCate = mysql_fetch_array($qrCate->result)) {
                    ?>
                        <li class="v_li_cate1" onclick="v_cate(<?php echo $rowCate['cate_id']; ?>,2)"><?php echo $rowCate['cate_name']; ?>
                        </li>
                        <?php 
                    }
                    ?>
                    </ul>
                </div>
            </div>
            <div class="auto2">
                <div class="autoright">
                    <ul class="ul-autoright" id="ul-autoright-on">
                        <?php 
                        $qrTag = new db_query("SELECT * FROM tags");
                        while ($rowTag = mysql_fetch_array($qrTag->result)) {
                        ?>
                        <li class="v_li_tag1" onclick="v_autoright1(<?php echo $rowTag['tag_id']; ?>)"><?php echo $rowTag['tag_name']; ?>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="auto-offline" class="auto-complete">
            <div class="v_del2">x</div>
            <div class="auto1">
                <div class="autoleft">
                    <ul id="ul-offline">
                        <?php 
                        $qrCate2 = new db_query("SELECT * FROM categories");
                        while ($rowCate = mysql_fetch_array($qrCate2->result)) {
                        ?>
                        <li class="v_li_cate2" onclick="v_cate(<?php echo $rowCate['cate_id']; ?>,1)"><?php echo $rowCate['cate_name']; ?>
                        </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="auto2">
                <div class="autoright">
                    <ul class="ul-autoright" id="ul-autoright-off">
                        <?php 
                        $qrTag2 = new db_query("SELECT * FROM tags");
                        while ($rowTag = mysql_fetch_array($qrTag2->result)) {
                        ?>
                        <li class="v_li_tag2" onclick="v_autoright2(<?php echo $rowTag['tag_id']; ?>)"><?php echo $rowTag['tag_name']; ?>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="v_search_city"><input class="v_search_city_input" placeholder="Tìm kiếm tỉnh, thành phố" onkeyup="v_onkeyup()" type="text"></div>
        <div id="auto-city" class="auto-complete auto-city">
            <div class="v_del2">x</div>
            <ul id="ul-city">
                <?php
                    $qrCity = new db_query("SELECT cit_name, cit_id FROM city WHERE cit_parent = 0");
                    while ($rowCity = mysql_fetch_array($qrCity->result)) {
                ?>
                <li class="v_li_cit1" onclick="v_search_city(<?php echo $rowCity['cit_id']; ?>)"><?php echo $rowCity['cit_name']; ?></li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>