<?php

class FwHome {

    public static function navbar_user($do) {
        global $key;
        ?>
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <span class="user-image online">
                <img src="assets/img/default-user-profile.jpg" alt="" /> 
            </span>
            <span class="hidden-xs"><?php echo @$_SESSION[$GLOBALS['fw_sistem']]['nama'] ?></span> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu animated fadeInLeft">
            <li class="arrow"></li>
            <?php
            if ($_SESSION['lang'] == 'bi') {
                $lang = 'bm';
                $lbl = 'Bahasa Melayu';
                $icon = 'my';
            } elseif ($_SESSION['lang'] == 'bm') {
                $lang = 'bi';
                $lbl = 'English';
                $icon = 'gb';
            }
            ?>
            <li><a href="?ch=1&lang=<?php echo $lang ?>&do=<?php echo emenu($key, $do) ?>&<?php echo array2get($_REQUEST) ?>"><?php echo $lbl ?> <i class="flag-icon flag-icon-<?php echo $icon ?>"></i></a></li>
            <li class="divider"></li>
            <li><a href="logout.php"><?php echo lbl('Log Out') ?></a></li>
        </ul>    
        <?php
    }

    public static function theme_panel() {
        ?>
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="ion-ios-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-blue" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-green" data-theme="green" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control input-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="ion-refresh m-r-3"></i> Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div>    
        <?php
    }

    public static function dropdown_alert() {
        ?>
        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle icon">
            <i class="ion-ios-bell"></i>
            <span class="label">5</span>
        </a>
        <ul class="dropdown-menu media-list pull-right animated fadeInDown">
            <li class="dropdown-header">Notifications (5)</li>
            <li class="media">
                <a href="javascript:;">
                    <div class="media-left"><i class="ion-ios-close-empty media-object bg-red"></i></div>
                    <div class="media-body">
                        <h6 class="media-heading">Server Error Reports</h6>
                        <div class="text-muted f-s-11">3 minutes ago</div>
                    </div>
                </a>
            </li>
            <li class="media">
                <a href="javascript:;">
                    <div class="media-left"><img src="assets/img/user-1.jpg" class="media-object" alt="" /></div>
                    <div class="media-body">
                        <h6 class="media-heading">John Smith</h6>
                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                        <div class="text-muted f-s-11">25 minutes ago</div>
                    </div>
                </a>
            </li>
            <li class="media">
                <a href="javascript:;">
                    <div class="media-left"><img src="assets/img/user-2.jpg" class="media-object" alt="" /></div>
                    <div class="media-body">
                        <h6 class="media-heading">Olivia</h6>
                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                        <div class="text-muted f-s-11">35 minutes ago</div>
                    </div>
                </a>
            </li>
            <li class="media">
                <a href="javascript:;">
                    <div class="media-left"><i class="ion-ios-plus-empty media-object bg-blue"></i></div>
                    <div class="media-body">
                        <h6 class="media-heading"> New User Registered</h6>
                        <div class="text-muted f-s-11">1 hour ago</div>
                    </div>
                </a>
            </li>
            <li class="media">
                <a href="javascript:;">
                    <div class="media-left"><i class="ion-ios-email-outline media-object bg-blue"></i></div>
                    <div class="media-body">
                        <h6 class="media-heading"> New Email From John</h6>
                        <div class="text-muted f-s-11">2 hour ago</div>
                    </div>
                </a>
            </li>
            <li class="dropdown-footer text-center">
                <a href="javascript:;">View more</a>
            </li>
        </ul>    
        <?php
    }

    public static function user_session($do) {
        global $key;

        $user_session = Db::chkval('ref_role', 'rr_description', "rr_id='" . $_SESSION[$GLOBALS['fw_sistem']]['peranan'] . "'");
        //$list_role = Db::data_list('seashell4.user_role a INNER JOIN seashell4.ref_role b ON a.ur_rr_id=b.rr_id', 'b.rr_id,b.rr_description', "ur_u_email='" . $_SESSION[$GLOBALS['fw_sistem']]['username'] . "'");
        $list_role = array();
        ?>
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?php echo $user_session ?></span> 
            <?php
            if (count($list_role) > '1') {
                ?>
                <b class="caret"></b>
                <?php
            }
            ?>            
        </a>
        <?php
        if (count($list_role) > '1') {
            ?>
            <ul class="dropdown-menu animated fadeInLeft">
                <li class="arrow"></li>
                    <?php
                    foreach ($list_role as $r => $v) {
                        extract($v);

                        if ($rr_id == $_SESSION[$GLOBALS['fw_sistem']]['peranan']) {
                            $class_current_role = 'text-success';
                        }
                        ?>
                    <li>
                        <a href="?role=<?php echo $rr_id ?>&do=<?php echo emenu($key, $do) ?>"><i class="fa fa-check-square <?php echo @$class_current_role ?>"></i> <?php echo @$rr_description ?> </a>
                    </li>
                    <?php
                    unset($class_current_role);
                }
                ?>
            </ul>
            <?php
        }
    }

}
?>