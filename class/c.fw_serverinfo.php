<?php

class FwServerInfo {
    public static function ajaxclick($get = '') {
        $idform = 'audit_trail';
        $divajax = 'divAudit';
        $urlajax = Db::CFAjax('FwServerInfo', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }
    
    public static function process($data) {
       ViewServerInfo::list_audit_trail($data);
    }
    
    public static function sql_listgrid($request) {        
        $table = "fw_audittrail";
        $field = "id,userx,sqlx,userinfo,tkhmasa";
        $condition = "1=1";
        $order = "id DESC";

        return Db::list_grid($request, $table, $field, $condition, $order);
    }
}