<?php
require_once('setting.php');
require_once 'allcss.php';
function getTime() 
    { 
    $a = explode (' ',microtime()); 
    return(double) $a[0] + $a[1]; 
    } 
$Start = getTime(); 

if (@$_SESSION[$GLOBALS['fw_sistem']]['username'] == '') {
    gopage('index.php');
} else {
    require_once 'framework/emenudmenu.php';

    if (@$_REQUEST['ch'] == 1) {
        $_SESSION['lang'] = @$_REQUEST['lang'];
    }

    if (@$_REQUEST['role'] != '') {
        $chkrole = Db::chkval('user_role', 'ur_rr_id', "ur_u_email='" . $_SESSION[$GLOBALS['fw_sistem']]['username'] . "' AND ur_rr_id='" . $_REQUEST['role'] . "'");
        if ($chkrole == $_REQUEST['role']) {
            $_SESSION[$GLOBALS['fw_sistem']]['peranan'] = $chkrole;
            $_GET['do'] = '';
        }
    }
    
    $do = $_GET['do'];

    if ($do == '') {
        $do = emenu(chk($keybefore), chk($mainpage));
    }

    $do = dmenu($keybefore, $do);
    $_REQUEST = exclude($_REQUEST, 'do,lang,ch');
    ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>Computer Maintenance System <?php if (in_array(@$_SESSION[$GLOBALS['fw_sistem']]['superadmin'], $GLOBALS['fw_superadmin']) || $server == $url_local) {
        echo $do;
    } ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN TEMPLATE CSS ================== -->
    <?php require_once 'allcss.php'; ?>
    <!-- ================== END TEMPLATE CSS ================== -->

    <!-- ================== BEGIN JQUERY JS ================== -->
    <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="framework/plugin/tableExportMaster/xls.core.min.js"></script>
    <script type="text/javascript" src="framework/plugin/tableExportMaster/Blob.min.js"></script>
    <script type="text/javascript" src="framework/plugin/tableExportMaster/FileSaver.min.js"></script>
    <script type="text/javascript" src="framework/plugin/tableExportMaster/tableexport.min.js"></script>
    <!-- ================== END JQUERY JS ================== -->

    <!-- ================== BEGIN SEAShell JS ================== -->
    <script src="framework/js/fw.js"></script>
    <!-- ================== END SEAShell JS ================== -->

    <!-- ================== BEGIN Angular JS ================== -->
    <script src="assets/js/angular.min.js"></script>
    <!-- ================== END Angular JS ================== -->

    <!-- ===================== BEGIN loading for ajax process =========================== -->
    <style>
    #fade_loading {
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #ababab;
        z-index: 1001;
        -moz-opacity: 0.8;
        opacity: .70;
        filter: alpha(opacity=80);
    }

    #modal_loading {
        display: none;
        position: absolute;
        top: 40%;
        left: 30%;
        width: 350px;
        height: 150px;
        border-radius: 20px;
        z-index: 1002;
        text-align: center;
        overflow: auto;
    }
    </style>
    <!-- ===================== END loading for ajax process =========================== -->

</head>

<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a href="action.do" class="navbar-brand">
                        <div>
                            <p>
                                <img src="assets/img/logo/LOGO.jpg" alt="logo" width="40" height="40"
                                    style="vertical-align:middle; padding:auto; border-radius:50%;  border: 1px solid #555;">
                                <b>
                                    CMS
                                </b>
                            </p>
                        </div>
                    </a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end mobile sidebar expand / collapse button -->

                <!-- begin header navigation right -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <?php 
                                 FwHome::user_session($do);
                                ?>
                    </li>
                    <li class="dropdown">
                        <?php 
                                 FwHome::dropdown_alert();
                                ?>
                    </li>
                    <li class="dropdown navbar-user">
                        <?php 
                                 FwHome::navbar_user($do);
                                ?>
                    </li>
                </ul>
                <!-- end header navigation right -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href="javascript:;"><img src="assets/img/default-user-profile.jpg" alt="" /></a>
                        </div>
                        <div class="info">
                            <?php echo @$_SESSION[$GLOBALS['fw_sistem']]['nama'] ?>
                            <small>
                                <?php
                                        echo Db::chkval('ref_role', 'rr_description', "rr_id='" . @$_SESSION[$GLOBALS['fw_sistem']]['peranan'] . "'");
                                        ?>
                            </small>
                        </div>
                    </li>
                </ul>
                <!-- end sidebar user -->

                <!-- begin sidebar nav -->
                <?php
                        require 'menu.php';
                        ?>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->

        <!-- begin #content -->
        <div id="content" class="content">
            <?php
                    if (@$menu == 'dashboard') {
                        require_once 'allcss.php';
                        $menu = '';
                        ?>
            <?php
                }
                ?>
            <h1 class="page-header"><?php echo lbl($menu) ?> <small><?php echo lbl($submenu) ?></small></h1>
            <?php
            require_once 'allcss.php';
                    $fail = "$do.php";
                    if ($_SESSION[$GLOBALS['fw_sistem']]['username'] != '') {
                        if (file_exists($fail)) {
                            include("$fail");
                        } else {
                            alert("Refresh & back button is not allowed for security reason.");
                            gopage('error_404.html');
                        }
                    } else {
                        gopage('index.php');
                    }
                    ?>
            <div id="fade_loading"></div>
            <div id="modal_loading">
                <img id="loader" src="assets/images/processing.gif" />
            </div>
        </div>
        <!-- end #content -->

        <!-- begin theme-panel -->
        <?php FwHome::theme_panel(); ?>
        <!-- end theme-panel -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN TEMPLATE JS ================== -->
    <?php require_once 'alljs.php'; ?>
    <!-- ================== END TEMPLATE JS ================== -->

</body>

</html>
<?php
}
$End = getTime(); 
$masa=number_format(($End - $Start),2);
echo '<center>Page load in '.$masa.' seconds</center>';
//pr($_SESSION);
?>