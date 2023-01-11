<?php

class Pccc {

    public static function ajaxclick($get = '') {
        $idform = 'Pccc';
        $divajax = 'divPccc';
        $urlajax = Db::CFAjax('Pccc', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'pc';
            $semak = chkwajib($_POST, 'serialnum,u_id,dept_id,block,level,wing,room');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "pc_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "pc_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewPccc::form_Pccc(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'pc';
        $field = 'pc_id,serialnum,u_id,dept_id,block,level,wing,room';
        $condition = "1=1";
            $order = 'serialnum';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>