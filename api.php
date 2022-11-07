<?php
require_once 'setting.php';
global $url;
$url=str_replace('http://','',$url);
$_SERVER['HTTP_REFERER'] = $url;
$GLOBALS['API']=1;

$id = $_POST['upmid'];
$appkey = $_POST['appkey'];
$task = $_POST['task'];

if($appkey=='UcAs52t5qLUP4NBp' and $id!=''){
    if($task=='Dashboard')
    {
        require_once 'api/xyx.php';
        echo json_encode($output);
    }
    else if($task=='CutiRehat')
    {
        require_once 'api/xxx.php';
        echo json_encode($output);
    } 
    else {
        require_once 'api/yyy.php';
        echo json_encode($output);
    }
}
?>
