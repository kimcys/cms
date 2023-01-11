<?php

class PcStaff {

    public static function ajaxclick($get = '') {
        $idform = 'PcStaff';
        $divajax = 'divPcStaff';
        $urlajax = Db::CFAjax('PcStaff', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {
        $table = 'pc';
        $field = 'pc_id,serialnum,u_id,dept_id,block,level,wing,room';
        $condition = "u_id = {$_SESSION[$GLOBALS['fw_sistem']]['u_id']}";
            $order = 'serialnum';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

    public static function dlblock($name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct block from location order by block";
        Db::droplistchange($sql, $name, 'block', 'block', $select, $class, $onchange, $other, '-- Please Select --');
    }

    public static function dlfloor($b, $name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct floor from location where block='$b' order by floor";
        Db::droplistchange($sql, $name, 'floor', 'floor', $select, $class, $onchange, $other, '-- Please Select --');
    }
    public static function dlroom($b, $c,$name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct room from location where block='$b' and floor ='$c' order by room";
        Db::droplistchange($sql, $name, 'room', 'room', $select, $class, $onchange, $other, '-- Please Select --');
    }
    public static function dluser($name, $select, $onchange, $class, $other='')
    {
        $sql = "select u_id from users where u_rr_id='3' order by u_id asc";
        Db::droplistchange($sql, $name, 'u_id', 'u_id', $select, $class, $onchange, $other, '-- Please Select --');
    }

    public static function dlname($e, $name, $select, $onchange, $class, $other='')
    {
        $sql = "select u_name from users where u_id='$e' order by u_id";
        Db::droplistchange($sql, $name, 'u_name', 'u_name', $select, $class, $onchange, $other, '-- Please Select --');
    }

}
?>