<?php

class FwFunc {
    

    public static function list_grid($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::list_grid($request, $table, $field, $condition, $order = '', $bilrow = 10, $dbg = 'N');<br>
                <?php
                break;
            case 2 :
                ?>
                return array('totalreturned' => $totalreturned, 'page_end' => $page_end, 'request' => $request, 'requestgrid' => $requestgrid, 'fw_senarai' => chk($datarow));
                <?php
                break;
            case 3 :
                ?>
                Function untuk senarai data dalam bentuk data grid.   
                <?php
                break;
            case 4 :
        ?>
$request = $_REQUEST;
$table = "";
$field = "";
$condition = "";
$order = "";

$data = Db::list_grid($request, $table, $field, $condition, $order);    
        
if (is_array($data)) {
    extract($data);
    if (is_array($fw_senarai)) {
        foreach ($fw_senarai as $r => $v) {
            if(is_array($v))
            {
                extract($v);
                // your looping here
            }
        }
    }
}<?php
            break;
        }
    }
    
    public static function data_list($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::data_list($table, $field, $condition, $dbg = 'N');    
                <?php
                break;
            case 2 :
                ?>
                return @$datarow;
                <?php
                break;
            case 3 :
                ?>
                Function untuk senarai data.   
                <?php
                break;
            case 4 :
        ?>
$table = "";
$field = "";
$condition = "";

$data = Db::data_list($table, $field, $condition);    
        
if (is_array($data)) {
        foreach ($data as $r => $v) {
            if(is_array($v))
            {
                extract($v);
                // your looping here
            }
        }
}<?php
            break;
        }
    }
    
    public static function insert_all($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::insert_all($table, $data, $showsts = 'N', $dbg = 'N');    
                <?php
                break;
            case 2 :
                ?>
                return $sts;
                <?php
                break;
            case 3 :
                ?>
                Function untuk masukkan data berdasarkan nama field dalam table. Pastikan key dalam array sama dengan nama field dalam table pada database. 
                $sts=1 jika proses simpan berjaya dan $sts=error jika tidak berjaya.
                <?php
                break;
            case 4 :
        ?>
$table = "";
Db::insert_all($table, $data, "Y");
            <?php
            break;
        }
    }
    
    public static function update_all($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::update_all($table, $data, $condition, $showsts = 'N', $dbg = 'N');    
                <?php
                break;
            case 2 :
                ?>
                return $sts;
                <?php
                break;
            case 3 :
                ?>
                Function untuk kemaskini data berdasarkan nama field dalam table. Pastikan key dalam array sama dengan nama field dalam table pada database.   
                $sts=1 jika proses kemaskini berjaya dan $sts=error jika tidak berjaya.
                <?php
                break;
            case 4 :
        ?>
$table = "";
$$condition = "";
Db::update_all($table, $data, $condition, "Y");
            <?php
            break;
        }
    }
    
    public static function display($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::display($table, $field, $condition, $dbg = 'N');    
                <?php
                break;
            case 2 :
                ?>
                return @$arrval;
                <?php
                break;
            case 3 :
                ?>
                Function untuk paparan 1 rekod.   
                <?php
                break;
            case 4 :
        ?>
$table = "";
$field = "";
$condition = "";

$data = Db::display($table, $field, $condition);   
if(is_array($data))
{
    extract($data);
}
            <?php
            break;
        }
    }
    
    public static function insert($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::insert($table, $field, $values, $showsts = 'N', $dbg = 'N');
                <?php
                break;
            case 2 :
                ?>
                return $sts;
                <?php
                break;
            case 3 :
                ?>
                Function untuk masukkan rekod. $sts=1 jika proses simpan berjaya dan $sts=error jika tidak berjaya.
                <?php
                break;
            case 4 :
        ?>
$table = "";
$field = "";
$values = "";

Db::insert($table, $field, $values, "Y");   
            <?php
            break;
        }
    }
    
    public static function update($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::update($table, $field, $condition, $showsts = 'N', $dbg = 'N');
                <?php
                break;
            case 2 :
                ?>
                return $sts;
                <?php
                break;
            case 3 :
                ?>
                Function untuk kemaskini rekod. $sts=1 jika proses kemaskini berjaya dan $sts=error jika tidak berjaya.
                <?php
                break;
            case 4 :
        ?>
$table = "";
$field = "";
$condition = "";

Db::update($table, $field, $condition, "Y");   
            <?php
            break;
        }
    }
    
    public static function delete($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::delete($table, $condition, $showsts = 'N', $dbg = 'N');
                <?php
                break;
            case 2 :
                ?>
                return $sts;
                <?php
                break;
            case 3 :
                ?>
                Function untuk hapus rekod. $sts=1 jika proses hapus berjaya dan $sts=error jika tidak berjaya.
                <?php
                break;
            case 4 :
        ?>
$table = "";
$condition = "";

Db::delete($table, $condition, "Y");   
            <?php
            break;
        }
    }
    
    public static function chkval($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::chkval($table, $field, $condition, $dbg = 'N');
                <?php
                break;
            case 2 :
                ?>
                return @$val;
                <?php
                break;
            case 3 :
                ?>
                Function untuk dapatkan satu rekod daripada sql.
                <?php
                break;
            case 4 :
        ?>
$table = "";
$field = "";
$condition = "";

$val = Db::chkval($table, $field, $condition);   
            <?php
            break;
        }
    }
    
    public static function droplist($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::droplist($sql, $name, $value, $display, $select, $class = 'form-control', $others = '', $null = '');
                <?php
                break;
            case 2 :
                ?>
                Droplist akan dipaparkan.
                <?php
                break;
            case 3 :
                ?>
                Function untuk generate droplist. Untuk dapatkan select dengan carian bagi variable $others masukkan 'data-size="10" data-live-search="true" data-style="btn-white"'.
                <?php
                break;
            case 4 :
        ?>
$sql = "";
$name = "";
$value = "";
$display = "";
$select = "";

Db::droplist($sql, $name, $value, $display, $select);   
            <?php
            break;
        }
    }
    
    public static function droplistchange($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::droplistchange($sql, $name, $value, $display, $select, $class, $onchange, $others = '', $null = '');
                <?php
                break;
            case 2 :
                ?>
                Droplist akan dipaparkan dan arahan $onchange akan dilaksanakan selepas pilihan dibuat.
                <?php
                break;
            case 3 :
                ?>
                Function untuk generate droplist dan arahan $onchange akan dilaksanakan selepas pilihan dibuat.
                <?php
                break;
            case 4 :
        ?>
$sql = "";
$name = "";
$value = "";
$display = "";
$select = "";
$class = "";
$onchange = "";

Db::droplistchange($sql, $name, $value, $display, $select, $class, $onchange);   
            <?php
            break;
        }
    }
    
    public static function saveUploadv2($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::saveUploadv2($user, $dataupload, $file, $upload_dir = '', $sizefile = '', $allowedExts = '');
                <?php
                break;
            case 2 :
                ?>
                return array("sts" => $sts, "id_upload" => $id_upl, "saiz" => @$_FILES["$file"]["size"], "ext" => $extension, "link" => $filename, "name" => $nama);
                <?php
                break;
            case 3 :
                ?>
                Function untuk simpan maklumat fail yang diupload dalam table fw_uploads. sts=1 upload berjaya dan id upload akan diberikan.<br>
                <b>Default value</b><br>
                    $upload_dir = "upload/";<br>
                    $allowedExts = array("jpg", "jpeg", "gif", "png", "pdf", "docx", "doc", "xls", "xlsx");<br>
                    $sizefile = $GLOBALS["upload_mb"];<br>
                    $sizefile = $sizefile * 1024 * 1024;
                <?php
                break;
            case 4 :
        ?>
$user = $_SESSION[$GLOBALS["fw_sistem"]]["username"];
$dataupload = "";
$file = "";

$upload = Db::saveUploadv2($user, $dataupload, $file);
            <?php
            break;
        }
    }
    
    public static function delete_upload_file($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::delete_upload_file($id_upload, $dbg = 'N');
                <?php
                break;
            case 2 :
                ?>
                return $sts;
                <?php
                break;
            case 3 :
                ?>
                Function untuk hapus rekod upload dan delete fail yang pernah diupload. $sts=1 jika proses hapus berjaya dan $sts=error jika tidak berjaya.
                <?php
                break;
            case 4 :
        ?>
$id_upload = "";

Db::delete_upload_file($id_upload);   
            <?php
            break;
        }
    }
    
    public static function num_rows($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::num_rows($table, $field, $condition, $dbg = 'N');
                <?php
                break;
            case 2 :
                ?>
                return $row;
                <?php
                break;
            case 3 :
                ?>
                Function untuk bilangan row rekod.
                <?php
                break;
            case 4 :
        ?>
$table = "";
$field = "";
$condition = "";

$row = Db::num_rows($table, $field, $condition);   
            <?php
            break;
        }
    }
    
    public static function array2get($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::array2get($arr);
                <?php
                break;
            case 2 :
                ?>
                return $getlist;
                <?php
                break;
            case 3 :
                ?>
                Function untuk tukarkan array ke get variable. Digunakan jika value post hendak ditukarkan ke value get.
                <?php
                break;
            case 4 :
        ?>
$arr = "";

$getlist = Db::array2get($arr);   
            <?php
            break;
        }
    }
    
    public static function change_db($x) {
        switch ($x)
        {
            case 1 :
                ?>
                Db::change_db($db);
                <?php
                break;
            case 2 :
                ?>
                tukar connection
                <?php
                break;
            case 3 :
                ?>
                Function untuk tukar connection pangkalan data. Perlu ikut nama db yang telah ditetapkan di dalam setting.php
                <?php
                break;
            case 4 :
        ?>
$db = "";

Db::change_db($db);   
            <?php
            break;
        }
    }
}   