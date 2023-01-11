<?php

class SemakanPc {

    public static function ajaxclick($get = '') {
        $idform = 'SemakanPc';
        $divajax = 'divSemakanPc';
        $urlajax = Db::CFAjax('SemakanPc', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {
        $table = 'pc';
        $field = 'pc_id,serialnum,u_id,dept_id,block,level,wing,room';
        $condition = "dept_id = {$request['deptId']} ";
            $order = 'serialnum';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>