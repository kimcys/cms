<?php

class Pcstaff2 {

    public static function ajaxclick($get = '') {
        $idform = 'PcStaff2';
        $divajax = 'divPcStaff2';
        $urlajax = Db::CFAjax('PcStaff2', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {
        $table = 'pc';
        $field = 'pc_id,serialnum,u_id,dept_id,block,level,wing,room';
        $condition = "pc_id = pc.pc_id";
            $order = 'serialnum';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>