<?php
require_once('setting.php');
global $url;
$_REQUEST['fw_print']=1;
extract($_REQUEST);

if(@$filename==''){
    $filename = @$class;
}
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");

$html = $class::{$func}($_REQUEST);
echo $html;
?>