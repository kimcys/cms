<?php

class PcTechnician {

    public static function ajaxclick($get = '') {
        $idform = 'PcTechnician';
        $divajax = 'divPcTechnician';
        $urlajax = Db::CFAjax('PcTechnician', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
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