<?php
require_once 'setting.php';
session_destroy();
//Include google login configuration
include_once 'google_login.php';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>Computer Maintenance System</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/style.min.css" rel="stylesheet" />
    <link href="assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE CSS ================== -->
    <link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
    <!-- ================== END PAGE CSS ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <div class="login-cover">
        <div class="login-cover-image"><img src="assets/img/login-bg/black-bg.jpg" data-id="login-cover-image" alt="" />
        </div>
    </div>
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"><i class="ion-android-desktop"></i></span> CMS
                    <small>Computer Maintenance System</small>
                </div>
                <div class="icon">
                    <i class="ion-ios-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form action="action.check" method="POST" class="margin-bottom-0">
                    <div style="text-align: center;" class="form-group m-b-20">
                        <img src="assets/img/logo/LOGO.jpg" alt="logo" width="100" height="100"
                            style="vertical-align:middle; margin:auto; border-radius: 50%;">
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" name="user" class="form-control input-lg" placeholder="UPM-ID" required="">
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="pass" class="form-control input-lg" placeholder="Password"
                            required="">
                    </div>
                    <div class="form-group m-b-20">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign In</button>
                    </div>
                    <div style="text-align: center;" class="form-group m-b-20">
                        <img src="assets/img/upm/HPUPM.png" alt="HPUPM" width="300" height="80"
                            style="vertical-align:middle;margin:0px;">
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
    </div>

    <ul class="login-bg-list">
        <li class="active"><a href="#" data-click="change-bg"><img src="assets/img/login-bg/black-bg.jpg" alt="" /></a>
        </li>
        <li><a href="#" data-click="change-bg"><img src="assets/img/login-bg/black-bg-2.jpg" alt="" /></a></li>
    </ul>

    <!-- begin theme-panel -->
    <div class="theme-panel">
        <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i
                class="ion-ios-cog"></i></a>
        <div class="theme-panel-content">
            <h5 class="m-t-0">Color Theme</h5>
            <ul class="theme-list clearfix">
                <li class="active"><a href="javascript:;" class="bg-blue" data-theme="default"
                        data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                        data-title="Default">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector"
                        data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a>
                </li>
                <li><a href="javascript:;" class="bg-green" data-theme="green" data-click="theme-selector"
                        data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a>
                </li>
                <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector"
                        data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a>
                </li>
                <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector"
                        data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a>
                </li>
                <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector"
                        data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end theme-panel -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="assets/js/login-v2.demo.min.js"></script>
    <script src="assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
    $(document).ready(function() {
        App.init();
        LoginV2.init();
    });
    </script>
</body>

</html>