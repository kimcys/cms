<?php
require_once('setting.php');
global $url;
$_REQUEST['fw_print']=1;
extract($_REQUEST);
?>
    <head>
        <meta charset="utf-8">
            <!-- ================== BEGIN TEMPLATE CSS ================== -->
            <?php require_once 'allcss.php'; ?>
            <!-- ================== END TEMPLATE CSS ================== -->
    </head>    
<?php
$html = $class::{$func}($_REQUEST);
echo $html;
?>
    <!-- ================== BEGIN TEMPLATE JS ================== -->
            <?php require_once 'alljs.php'; ?>
    <!-- ================== END TEMPLATE JS ================== -->
<body onLoad="window.print()">