<?php
$menu = @$_GET['menu'];
$submenu = @$_GET['submenu'];
?>

<ul class="nav">
    <?php
    if (in_array(@$_SESSION[$GLOBALS['fw_sistem']]['superadmin'], $GLOBALS['fw_superadmin'])) {
        ?>
        <li class="has-sub <?php
        if ($menu == 'Superadmin') {
            echo 'active';
        }
        ?>">
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="ion-settings bg-red-darker"></i>
                <span><?php echo lbl('Superadmin') ?></span> 
            </a>
            <ul class="sub-menu">
                <li class="<?php
                if ($submenu == 'Server Info') {
                    echo 'active';
                }
                ?>"><a href="?do=<?php echo emenu($key, 'm/m.fw_serverinfo') ?>&menu=Superadmin&submenu=Server Info"><?php echo lbl('Server Info') ?> <i class="fa fa-hdd-o text-theme m-l-5"></i></a></li>
                <li class="<?php
                if ($submenu == 'Switch User') {
                    echo 'active';
                }
                ?>"><a href="?do=<?php echo emenu($key, 'm/m.fw_chguser') ?>&menu=Superadmin&submenu=Switch User"><?php echo lbl('Switch User') ?> <i class="fa fa-exchange text-theme m-l-5"></i></a></li>
                <li class="<?php
                if ($submenu == 'Fw Function') {
                    echo 'active';
                }
                ?>"><a href="?do=<?php echo emenu($key, 'm/m.fw_func') ?>&menu=Superadmin&submenu=Fw Function"><?php echo lbl('Fw Function') ?> <i class="fa fa-navicon text-theme m-l-5"></i></a></li>
                <li class="<?php
                if ($submenu == 'Template') {
                    echo 'active';
                }
                ?>"><a target="_blank" href="template.php"><?php echo lbl('Template') ?> <i class="fa fa-puzzle-piece text-theme m-l-5"></i></a></li>
                <li class="<?php
                if ($submenu == 'HighChart') {
                    echo 'active';
                }
                ?>"><a href="?do=<?php echo emenu($key, 'm/m.fw_highchart') ?>&menu=Superadmin&submenu=HighChart"><?php echo lbl('HighChart') ?> <i class="fa fa-bar-chart text-theme m-l-5"></i></a></li>
                <li class="<?php
                if ($submenu == 'Local Storage') {
                    echo 'active';
                }
                ?>"><a href="?do=<?php echo emenu($key, 'm/m.fw_localstorage') ?>&menu=Superadmin&submenu=Local Storage"><?php echo lbl('Local Storage') ?> <i class="fa fa-database text-theme m-l-5"></i></a></li>
                <li class="<?php
                if ($submenu == 'Menu') {
                    echo 'active';
                }
                ?>">
                    <a href="?do=<?php echo emenu($key, 'm/m.fw_menu') ?>&menu=Superadmin&submenu=Menu"><?php echo lbl('Menu') ?> <i class="fa fa-tasks text-theme m-l-5"></i></a></li>
            </ul>
        </li>   
        <?php
    }

    $table = "fw_menu a INNER JOIN fw_akses b ON a.m_id = b.fa_m_id";
    $field = "DISTINCT a.m_id,a.m_keterangan,a.m_submenu,a.m_href,a.m_class,a.m_susunan";
    $condition = "a.m_status='A' AND b.fa_rr_id='" . $_SESSION[$GLOBALS['fw_sistem']]['peranan'] . "' ORDER BY a.m_susunan";

    $data = Db::data_list($table, $field, $condition);

    if (is_array($data)) {
        foreach ($data as $r => $v) {
            if (is_array($v)) {
                extract($v);
                $table = "fw_submenu a INNER JOIN fw_akses b ON a.sm_id = b.fa_sm_id AND b.fa_m_id='$m_id'";
                $field = "DISTINCT a.sm_id,a.sm_keterangan,a.sm_href,a.sm_class,a.sm_susunan";
                $condition = "a.sm_m_id='$m_id' AND a.sm_status='A'  AND b.fa_rr_id='" . $_SESSION[$GLOBALS['fw_sistem']]['peranan'] . "' ORDER BY a.sm_susunan";
                $chksub = Db::data_list($table, $field, $condition);
                ?>
                <li class="<?php
                if (is_array($chksub)) {
                    echo 'has-sub';
                }
                ?> <?php
                    if ($menu == $m_keterangan) {
                        echo 'active';
                    }
                    ?>">
                    <a href="<?php
                           if ($m_submenu == 'Y') {
                               echo $m_href;
                           } else {
                               echo "?do=" . emenu($key, $m_href) . "&menu=" . urlencode($m_keterangan);
                           }
                           ?>">
                    <?php
                    if (!empty($chksub)) {
                        echo '<b class="caret pull-right"></b>';
                    }
                    ?>
                        <i class="<?php echo $m_class ?>"></i>
                        <span><?php echo lbl($m_keterangan) ?> </span> 
                    </a>
                        <?php
                        if (is_array($chksub)) {
                            ?>
                        <ul class="sub-menu">
                <?php
                foreach ($chksub as $row => $value) {
                    if (is_array($value)) {
                        extract($value);
                        ?>
                                    <li class="<?php
                                    if ($submenu == $sm_keterangan) {
                                        echo 'active';
                                    }
                                    ?>">
                                        <a href="?do=<?php echo emenu($key, $sm_href) ?>&menu=<?php echo urlencode($m_keterangan) ?>&submenu=<?php echo urlencode($sm_keterangan) ?>"><?php echo lbl($sm_keterangan) ?> 
                                            <i class="<?php echo $sm_class ?>"></i>
                                        </a>
                                    </li>
                            <?php
                        }
                    }
                    ?>
                        </ul>
                <?php
            }
            ?>
                </li>
            <?php
        }
    }
}
?>

    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span><?php echo lbl('Collapse') ?></span></a></li>
    <!-- end sidebar minify button -->
</ul>    