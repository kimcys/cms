<?php

class PenyelenggaraanDashboardTechnician {

    public static function ajaxclick($get = '') {
        $idform = 'PenyelenggaraanDashboardTechnician';
        $divajax = 'divPenyelenggaraanDashboardTechnician';
        $urlajax = Db::CFAjax('PenyelenggaraanDashboardTechnician', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {

        $table = 'maintenance';
        $field = 'm_id,pc_id,dept_id,block,level,room,wing,start_date,end_date,assigned_to,status';
        $condition = "status = maintenance.status AND status= {$request['status']}";
            $order = 'pc_id';
            
        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>