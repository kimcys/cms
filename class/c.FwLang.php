<?php

class FwLang {

    public static function ajaxclick($get = '') {
        $idform = 'FwLang';
        $divajax = 'divFwLang';
        $urlajax = Db::CFAjax('FwLang', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'fw_lang';

            if (@$save || isset($data['update'])) {
                if (@$save) {
                    Db::insert_all($table, $data, 'Y');
                    unset($data);
                } else {
                    $condition = "fl_id='" . $data['update'] . "'";
                    Db::update_all($table, $data, $condition, 'Y');
                }
            }

            if (isset($data['del'])) {
                $condition = "fl_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewFwLang::form_FwLang(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'fw_lang';
        $field = 'fl_id,label,bm,bi';
        $condition = "1=1";
            $order = 'label';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>