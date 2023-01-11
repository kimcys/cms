<?php

class Pc2 {

    public static function ajaxclick($get = '') {
        $idform = 'Pc2';
        $divajax = 'divPc2';
        $urlajax = Db::CFAjax('Pc2', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'pc';
            $semak = chkwajib($_POST, 'serialnum,u_id,dept_id,block,level,wing,room');
            

            if (@$save || isset($data['update'])) {
                
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "pc_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "pc_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }
        ViewPc2::form_Pc2(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'pc';
        $field = 'pc_id,serialnum,u_id,dept_id,block,level,wing,room';
        $condition = "dept_id= dept_id";
        $order = 'serialnum';
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