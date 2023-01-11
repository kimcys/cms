<?php

class Pc {

    public static function ajaxclick($get = '') {
        $idform = 'Pc';
        $divajax = 'divPc';
        $urlajax = Db::CFAjax('Pc', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function sql_listgrid($request) {
        $table = 'department';
        $field = 'dept_id,dept_name';
        $condition = "1=1";
        $order = 'dept_name';
        return Db::list_grid($request, $table, $field, $condition, $order);
    }

    public static function dlname($e, $name, $select, $onchange, $class, $other='')
    {
        $sql = "select u_name from users where u_id='$e' order by u_id";
        Db::droplistchange($sql, $name, 'u_name', 'u_name', $select, $class, $onchange, $other, '-- Please Select --');
    }

    public static function dlblock($a, $name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct block from location where dept_id='$a' order by block";
        Db::droplistchange($sql, $name, 'block', 'block', $select, $class, $onchange, $other, '-- Please Select --');
    }

    public static function dllevel($a, $b, $name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct level from location where dept_id='$a' and  block='$b' order by level";
        Db::droplistchange($sql, $name, 'level', 'level', $select, $class, $onchange, $other, '-- Please Select --');
    }

    public static function dlwing($a, $b, $c, $name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct wing from location where dept_id='$a' and block='$b' and level='$c' order by wing";
        Db::droplistchange($sql, $name, 'wing', 'wing', $select, $class, $onchange, $other, '-- Please Select --');
    }
    public static function dlroom($a, $b, $c, $d,$name, $select, $onchange, $class, $other='')
    {
        $sql = "select distinct room from location where dept_id='$a' and block='$b' and level ='$c' and wing='$d'  order by room";
        Db::droplistchange($sql, $name, 'room', 'room', $select, $class, $onchange, $other, '-- Please Select --');
    }

    public static function dldept($name, $select, $onchange, $class, $other='')
    {
        $sql = "select dept_id, dept_name from department order by dept_id asc";
        Db::droplistchange($sql, $name, 'dept_id', 'dept_name', $select, $class, $onchange, $other, '-- Please Select --');
    }

}
?>