<?php

class PcDashboards {

    public static function ajaxclick($get = '') {
        $idform = 'PcDashboards';
        $divajax = 'divPcDashboards';
        $urlajax = Db::CFAjax('PcDashboards', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {

        $table = 'pc';
        $field = 'pc_id,serialnum,u_id,dept_id,block,level,wing,room';
        $condition = "dept_id=pc.dept_id  AND dept_id= {$request['deptId']}";
        $order = 'serialnum';
        return Db::list_grid($request, $table, $field, $condition, $order);
    }
}
?>