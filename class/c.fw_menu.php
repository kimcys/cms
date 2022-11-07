<?php

class FwMenu {

    public static function ajaxclick($get = '') {
        $idform = 'fwmenu';
        $divajax = 'divMenu';
        $urlajax = Db::CFAjax('FwMenu', 'process');
        return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            $table = 'fw_menu';
            # susunan atas bawah
            if (isset($btnup) or isset($btndown)) {
                if (@$sm_id != '') {
                    if (@$btnup == 1) {
                        Db::goup('sm_id', $sm_id, 'fw_submenu', 'sm_susunan', "sm_m_id='$m_id'");
                    }
                    if (@$btndown == 1) {
                        Db::godown('sm_id', $sm_id, 'fw_submenu', 'sm_susunan', "sm_m_id='$m_id'");
                    }
                } else {
                    if (@$btnup == 1) {
                        Db::goup('m_id', $m_id, 'fw_menu', 'm_susunan', "1=1");
                    }
                    if (@$btndown == 1) {
                        Db::godown('m_id', $m_id, 'fw_menu', 'm_susunan', "1=1");
                    }
                }
            }
            # end susunan atas bawah

            if (@$save == 1) {
                $data['m_susunan'] = Db::chkmax($table, 'm_susunan') + 1;
                Db::insert_all($table, $data, 'Y');
                unset($data);
            }
            if (isset($data['update'])) {
                $condition = "fa_m_id='" . $data['update'] . "' AND fa_sm_id=0 ";
                Db::delete('fw_akses', $condition);
                if (!isset($data['fw_akses'])) {
                    $data['fw_akses'] = array();
                }

                $condition = "m_id='" . $data['update'] . "'";
                Db::update_all($table, $data, $condition, 'Y');
            }
            if (isset($data['del'])) {
                $condition = "fa_m_id='" . $data['del'] . "'";
                Db::delete('fw_akses', $condition);

                $condition = "m_id='" . $data['del'] . "'";
                Db::delete($table, $condition, 'Y');
            }
            if (isset($data['m_status'])) {
                if ($data['m_status'] == 'A') {
                    $data['m_status'] = 'TA';
                    $data['sm_status'] = 'TA';
                } else {
                    $data['m_status'] = 'A';
                    $data['sm_status'] = 'A';
                }
                $condition = "m_id='" . $data['m_id'] . "'";
                $sts = Db::update_all('fw_menu', $data, $condition);

                if ($sts == '1') {
                    $condition = "sm_m_id='" . $data['m_id'] . "'";
                    Db::update_all('fw_submenu', $data, $condition, 'Y');
                }
            }
            if (isset($data['sm_status'])) {
                if ($data['sm_status'] == 'A') {
                    $data['sm_status'] = 'TA';
                } else {
                    $data['sm_status'] = 'A';
                }
                $condition = "sm_id='" . @$data['sm_id'] . "'";
                Db::update_all('fw_submenu', $data, $condition, 'Y');
            }

            $table = 'fw_submenu';
            if (@$savesub == 1 and @ $sm_m_id != '') {
                $data['sm_susunan'] = Db::chkmax($table, 'sm_susunan') + 1;
                Db::insert_all($table, $data, 'Y');
                unset($data);
            }
            if (isset($data['updatesub'])) {
                $condition = "fa_sm_id='" . $data['updatesub'] . "'";
                Db::delete('fw_akses', $condition);
                if (!isset($data['fw_akses'])) {
                    $data['fw_akses'] = array();
                }

                $condition = "sm_id='" . $data['updatesub'] . "'";
                Db::update_all($table, $data, $condition, 'Y');
            }
            if (isset($data['delsub'])) {
                $condition = "fa_sm_id='" . $data['delsub'] . "'";
                Db::delete('fw_akses', $condition);

                $condition = "sm_id='" . $data['delsub'] . "'";
                Db::delete($table, $condition, 'Y');
            }

            if (isset($data['fa_rr_id'])) {
                $table = 'fw_akses';
                if (@$fa_sm_id == '') {
                        $fa_sm_id = 0;
                    }
                if ($data['valakses'] == 1) {
                    $data_akses = array('fa_m_id' => $fa_m_id, 'fa_sm_id' => $fa_sm_id, 'fa_rr_id' => $fa_rr_id, 'fa_insertby' => $_SESSION[$GLOBALS['fw_sistem']]['username']);
                    Db::insert_all($table, $data_akses,'Y');
                } else {
                    Db::delete($table, "fa_m_id='$fa_m_id' AND fa_sm_id='$fa_sm_id' AND fa_rr_id='$fa_rr_id'",'Y');
                }
            }
        }

        ViewFwMenu::formmenu(@$data);
    }

    public static function sql_menu() {
        $table = 'fw_menu';
        $field = 'm_id,m_keterangan,m_submenu,m_href,m_class,m_susunan,m_status,m_gen_code,m_status';
        $condition = "1=1 ORDER BY m_susunan ASC";

        return Db::data_list($table, $field, $condition);
    }

    public static function sql_submenu($m_id) {
        $table = 'fw_submenu';
        $field = 'sm_id,sm_m_id,sm_keterangan,sm_href,sm_class,sm_susunan,sm_status,sm_gen_code,sm_status';
        $condition = "sm_m_id='$m_id' ORDER BY sm_susunan ASC";

        return Db::data_list($table, $field, $condition);
    }

    public static function insert_akses($fa_m_id, $fa_sm_id = 0, $fw_akses = '') {
        if ($fw_akses == '') {
            $fw_akses = array();
            $all_akses = Db::data_list('ref_role', 'rr_id');
            foreach ($all_akses as $r => $v) {
                $fw_akses[$r] = $v['rr_id'];
            }
        }
        if (is_array($fw_akses)) {
            foreach ($fw_akses as $fa_rr_id) {
                if ($fa_sm_id == '') {
                    $fa_sm_id = 0;
                }
                $data_akses = array('fa_m_id' => $fa_m_id, 'fa_sm_id' => $fa_sm_id, 'fa_rr_id' => $fa_rr_id, 'fa_insertby' => $_SESSION[$GLOBALS['fw_sistem']]['username']);
                Db::insert_all('fw_akses', $data_akses);
            }
        }
    }

    public static function list_akses($m_id, $sm_id = 0, $fa_rr_id) {
        $table = 'fw_akses a LEFT JOIN ref_role b ON a.fa_rr_id = b.rr_id';
        $field = 'a.fa_rr_id, b.rr_description';
        $condition = "a.fa_m_id='$m_id' AND fa_sm_id='$sm_id' AND a.fa_rr_id='$fa_rr_id' ORDER BY b.rr_description";

        $data = Db::data_list($table, $field, $condition);

        $list['fa_rr_id'] = array();
        $list['rr_description'] = array();
        if (is_array($data)) {
            foreach ($data as $r => $v) {
                array_push($list['fa_rr_id'], $v['fa_rr_id']);
                array_push($list['rr_description'], $v['rr_description']);
            }
        }

        return $list;
    }

    public static function click_generate($get = '', $echo = 'Y') {
        $idform = 'fwmenu';
        $divajax = 'divMenu';
        $urlajax = Db::CFAjax('FwMenu', 'generate');
        if ($echo == 'Y') {
            echo "ajaxAll('$idform', '$divajax', '$urlajax$get')";
        } else if ($echo == 'N') {
            return "ajaxAll('$idform', '$divajax', '$urlajax$get')";
        }
    }

    public static function generate($request) {
        //pr($request);
        if (@$request['upd'] == 1) {
            if (@$request['sm_id'] != '') {
                $table = 'fw_submenu';
                $field = 'sm_gen_code';
                $condition = "sm_m_id='" . $request['m_id'] . "' AND sm_id='" . $request['sm_id'] . "'";
            } else {
                $table = 'fw_menu';
                $field = 'm_gen_code';
                $condition = "m_id='" . $request['m_id'] . "'";
            }
            $chkJSON = Db::chkval($table, $field, $condition);
            $request = array_merge($request, json_decode($chkJSON, true));
        }

        if (@$request['save'] == 1) {
            FwAutocreate::create($request);
        }
        ViewFwMenu::formgenerator($request);
    }

}
