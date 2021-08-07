<div class="templatemo-sidebar">
    <header class="templatemo-site-header">
        <h1>Admin khóa học timviec365.com</h1>
    </header>
    <div class="profile-photo-container">
        <div class="profile-photo-overlay"></div>
    </div>
    <div class="mobile-menu-icon">
        <i class="fa fa-bars"></i>
    </div>
    <nav class="templatemo-left-nav">
        <ul>
            <li class="admin-nav"><a href="index.php" id="v_dashboard">Dashboard</a></li>
            <?
                $dbmod = new db_query("SELECT * FROM admin_modules WHERE module_parent = 0");
                while ($rowmod = mysql_fetch_array($dbmod->result)) {
                    $dbper = new db_query("SELECT * FROM admin_permission WHERE adm_id = $adm_id AND module_id = ".$rowmod['module_id']);
                    if (mysql_num_rows($dbper->result)) {
                        $none = "";
                        $rowper = mysql_fetch_array($dbper->result);
                        if ($rowper['permis_create'] == 0) {
                            $none1 = "display:none;";
                        } else {
                            $none1 = "";
                        }
                    } else {
                        $none = "display:none;";
                        $none1 = "";
                    } ?>
            <li class="admin-nav" style="<?=$none?> <?=$important?>" onclick="v_action_list(<?=$rowmod['module_id']?>)">
                <a><?=$rowmod['module_name']?></a>
            </li>
            <ul id="action<?=$rowmod['module_id']?>" class="v_list-action">
                <li id="list_<?=$rowmod['module_id']?>"><a href="<?=$rowmod['module_link']?>">Danh sách</a></li>
                <?php
                    $dbmod1 = new db_query("SELECT * FROM admin_modules WHERE module_parent =".$rowmod['module_id']);
                    while ($rowmod1 = mysql_fetch_array($dbmod1->result)) {
                        ?>
                <li style="<?=$none1?> <?=$important?>" id="create_<?=$rowmod['module_id']?>"><a
                        href="<?=$rowmod1['module_link']?>"><?=$rowmod1['module_name']?></a>
                </li>
                <?php
                    } ?>
            </ul>
            <?php
                }
                ?>
        </ul>
        </ul>
    </nav>
</div>