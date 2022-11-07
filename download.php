<?php
require_once 'setting.php';

global $url;
$pos = strpos(@$_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']);

if ($pos !== false)
{
    $id_upload = dmenu($url, @$_GET['id']);
    if(chk($id_upload)!='' and is_numeric($id_upload))
    {
        $file = Db::chkval('fw_uploads', 'link', "id='".chk($id_upload)."'");
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
}
else
{
    require_once 'error_404.html';
}
?>
