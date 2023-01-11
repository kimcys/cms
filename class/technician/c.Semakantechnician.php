<?php

class SemakanTechnician {

    public static function ajaxclick($get = '') {
        $idform = 'SemakanTechnician';
        $divajax = 'divSemakanTechnician';
        $urlajax = Db::CFAjax('SemakanTechnician', 'process');
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