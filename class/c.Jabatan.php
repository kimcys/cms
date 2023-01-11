<?php

class Jabatan {

    public static function ajaxclick($get = '') {
        $idform = 'Jabatan';
        $divajax = 'divJabatan';
        $urlajax = Db::CFAjax('Jabatan', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'department';
            $semak = chkwajib($_POST, 'dept_name');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "dept_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "dept_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewJabatan::form_Jabatan(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'department';
        $field = 'dept_id,dept_name';
        $condition = "1=1";
            $order = 'dept_name';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>