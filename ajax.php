<?php
require_once 'setting.php';

global $url;
$pos = strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']);

if ($pos !== false)
{
    extract($_REQUEST);
    $do = dmenu($url, $do);
    $do::{$func}($_REQUEST + $_FILES);
}
else
{
    echo 'Request bukan dari server ini.';
}
?>