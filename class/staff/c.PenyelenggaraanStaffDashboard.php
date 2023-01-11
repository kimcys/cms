<?php

class PenyelenggaraanStaffDashboard{

    public static function ajaxclick($get = '') {
        $idform = 'PenyelenggaraanStaffDashboard';
        $divajax = 'divPenyelenggaraanStaffDashboard';
        $urlajax = Db::CFAjax('PenyelenggaraanStaffDashboard', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }


    public static function sql_listgrid($request) {
        $table = 'maintenance';
        $field = 'm_id,pc_id,u_id,dept_id,block,level,wing,room,start_date,end_date,assigned_to,status';
        $condition = "u_id = {$_SESSION[$GLOBALS['fw_sistem']]['u_id']} AND  status='1'";
            $order = 'pc_id';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>