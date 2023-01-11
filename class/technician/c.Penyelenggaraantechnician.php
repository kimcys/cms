<?php

class PenyelenggaraanTechnician {

    public static function ajaxclick($get = '') {
        $idform = 'PenyelenggaraanTechnician';
        $divajax = 'divPenyelenggaraanTechnician';
        $urlajax = Db::CFAjax('PenyelenggaraanTechnician', 'process');
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