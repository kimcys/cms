<?php

class lokasi {

    public static function ajaxclick($get = '') {
        $idform = 'lokasi';
        $divajax = 'divLokasi';
        $urlajax = Db::CFAjax('lokasi', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'location';
            $semak = chkwajib($_POST, 'block,level,wing,room,dept_id');

            

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "l_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "l_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewLokasi::form_lokasi(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'location';
        $field = 'l_id,block,level,wing,room,dept_id';
        $condition = "1=1";
            $order = 'block';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

    public static function dldept($name, $select, $onchange, $class, $other='')
    {
        $sql = "select dept_id, dept_name from department order by dept_id asc";
        Db::droplistchange($sql, $name, 'dept_id', 'dept_name', $select, $class, $onchange, $other, '-- Please Select --');
    }

}
?>