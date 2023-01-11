<?php

class Semakan2Technician {

    public static function ajaxclick($get = '') {
        $idform = 'Semakan2Technician';
        $divajax = 'divSemakan2Technician';
        $urlajax = Db::CFAjax('Semakan2Technician', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            $table = 'checklist';
            $semak = chkwajib($_POST, 'pc_id,dept_id');

            if (@$save || isset($data['update'])) {
                $data['date_check'] = chgdate('Y-m-d', $data['date_check']);
                if (@$semak) {
                    sts_sql('0', @$msjok, $GLOBALS['fw_lbl_msg_chkwajib']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, 'Y');
                        unset($data);
                    } else {
                        $condition = "c_id='" . $data['update'] . "'";
                        Db::update_all($table, $data, $condition, 'Y');
                    }
                }
            }

            if (isset($data['del'])) {
                $condition = "c_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
        }

        ViewSemakan2Technician::form_Semakan2Technician(@$data);
    }

    public static function sql_listgrid($request) {
        $table = 'checklist';
        $field = 'c_id,pc_id,cpu,ram,operating_system,date_check,maintained_by,dept_id,antivirus,cd_dvd,mouse,keyboard,monitor,network_card,usb_port,display_card,audio_video,external_cleanup, serialnum';
        $condition = "dept_id = checklist.dept_id";
            $order = 'serialnum';

        return Db::list_grid($request, $table, $field, $condition, $order);
    }

}
?>