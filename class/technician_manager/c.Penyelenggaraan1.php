<?php

class Penyelenggaraan1 {

    public static function ajaxclick($get = '') {
        $idform = 'Penyelenggaraan1';
        $divajax = 'divPenyelenggaraan1';
        $urlajax = Db::CFAjax('Penyelenggaraan1', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);

            pr($data);
            
            $table = 'maintenance';
            $semak = chkwajib($_POST, 'pc_id,approval');

            if (@$save || isset($data['update'])) {
                $data['end_date'] = chgdate('Y-m-d', $data['end_date']);
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "m_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }
            
            if (@$approve || isset($data['approve'])) {
                        $condition = "m_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                
            

            if (isset($data['del'])) {
                $condition = "m_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewPenyelenggaraan1::form_Penyelenggaraan1(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'maintenance';
        $field = 'm_id,pc_id,dept_id,block,level,room,wing,start_date,end_date,assigned_to,status';
        $condition = "dept_id = maintenance.dept_id";
            $order = 'status';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>