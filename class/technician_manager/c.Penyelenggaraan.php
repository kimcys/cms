<?php

class Penyelenggaraan {

    public static function ajaxclick($get = '') {
        $idform = 'Penyelenggaraan';
        $divajax = 'divPenyelenggaraan';
        $urlajax = Db::CFAjax('Penyelenggaraan', 'process');
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