<?php

class Peranan {

    public static function ajaxclick($get = '') {
        $idform = 'Peranan';
        $divajax = 'divPeranan';
        $urlajax = Db::CFAjax('Peranan', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'ref_role';
            $semak = chkwajib($_POST, 'rr_acronym,rr_description');

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "rr_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "rr_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewPeranan::form_Peranan(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'ref_role';
        $field = 'rr_id,rr_acronym,rr_description';
        $condition = "1=1";
            $order = 'rr_acronym';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>