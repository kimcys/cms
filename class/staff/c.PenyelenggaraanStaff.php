<?php

class PenyelenggaraanStaff {

    public static function ajaxclick($get = '') {
        $idform = 'PenyelenggaraanStaff';
        $divajax = 'divPenyelenggaraanStaff';
        $urlajax = Db::CFAjax('PenyelenggaraanStaff', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {
        $table = 'maintenance';
        $field = 'm_id,pc_id,u_id,dept_id,block,level,wing,room,start_date,end_date,assigned_to,status';
        $condition = "u_id = {$_SESSION[$GLOBALS['fw_sistem']]['u_id']}";
            $order = 'pc_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>