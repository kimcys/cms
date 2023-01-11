<?php

class SpesifikasiStaff {

    public static function ajaxclick($get = '') {
        $idform = 'SpesifikasiStaff';
        $divajax = 'divSpesifikasiStaff';
        $urlajax = Db::CFAjax('SpesifikasiStaff', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'spec';
            $semak = chkwajib($_POST, 'pc_id,pc_owner,cpu');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "f_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "f_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewSpesifikasiStaff::form_SpesifikasiStaff(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'spec';
        $field = 'f_id,pc_id,cpu,ram,hard_disk,mouse,monitor,antivirus,operating_system,printer,keyboard,u_id, serialnum';
        $condition = "u_id = {$_SESSION[$GLOBALS['fw_sistem']]['u_id']}";
            $order = 'pc_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>