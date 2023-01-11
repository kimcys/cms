<?php

class Pengguna {

    public static function ajaxclick($get = '') {
        $idform = 'Pengguna';
        $divajax = 'divPengguna';
        $urlajax = Db::CFAjax('Pengguna', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'users';
            $semak = chkwajib($_POST, 'u_upm_id,u_name,u_email,u_rr_id');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "u_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "u_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewPengguna::form_Pengguna(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'users';
        $field = 'u_id,u_upm_id,u_name,u_email,u_rr_id';
        $condition = "1=1";
            $order = 'u_upm_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>