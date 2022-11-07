<?php

class FwAutocreate {

    public static function create($request) {
        global $today;
        extract($request);
        if (@$sm_id != '') {
            $table = 'fw_submenu';
            $field = 'sm_href AS href,sm_keterangan AS keterangan';
            $condition = "sm_m_id='$m_id' AND sm_id='$sm_id'";
        } else {
            $table = 'fw_menu';
            $field = 'm_href AS href,m_keterangan AS keterangan';
            $condition = "m_id='$m_id'";
        }

        $menu = Db::display($table, $field, $condition);

        if ($menu['href']!='') {

            $mfile = fopen($menu['href'] . ".php", "w") or die("Unable to open file!");
            fwrite($mfile, FwAutocreate::m($request));
            fclose($mfile);
            if (file_exists($menu['href'] . '.php')) {
                $sts = "Generate file " . $menu['href'] . ".php successfully <br>";
            }

            $chkfolder = substr($menu['href'], 2, strpos($menu['href'], '/m.') - 1);
            $fileview = substr($menu['href'], strpos($menu['href'], '.') + 1);
            $vlocation = 'v/' . $chkfolder . "v." . $fileview . ".php";
            $vfile = fopen($vlocation, "w") or die("Unable to open file!");
            fwrite($vfile, FwAutocreate::v($menu['keterangan'], $request));
            fclose($vfile);
            if (file_exists($vlocation)) {
                $sts = $sts . "Generate file " . $vlocation . " successfully <br>";
            }

            $fileclass = str_replace(' ', '', $request['modul']);
            $clocation = 'class/' . $chkfolder . "c." . $fileclass . ".php";
            $cfile = fopen($clocation, "w") or die("Unable to open file!");
            fwrite($cfile, FwAutocreate::c(str_replace(' ', '', $menu['keterangan']), $request));
            fclose($cfile);
            if (file_exists($clocation)) {
                $sts = $sts . "Generate file " . $clocation . " successfully";
            }
            alert($sts);

            $request = exclude($request, 'do,func,save');
            $myJSON = json_encode($request);

            if (@$sm_id != '') {
                $datagen = array('sm_gen_code' => $myJSON,
                    'sm_gen_by' => $_SESSION[$GLOBALS['fw_sistem']]['username'],
                    'sm_gen_date' => $today);
            } else {
                $datagen = array('m_gen_code' => $myJSON,
                    'm_gen_by' => $_SESSION[$GLOBALS['fw_sistem']]['username'],
                    'm_gen_date' => $today);
            }
            Db::update_all($table, $datagen, $condition);
        } else {
            alert('Please enter m file name.');
        }
    }

    public static function m($request) {
        $classname = str_replace(" ", "", $request["modul"]);
        $txt = '<form name="' . $classname . '" id="' . $classname . '" method="post" class="form-horizontal" onsubmit="return false">
                    <div id="div' . ucwords($classname) . '" class="row">    
                        <?php
                        View' . ucwords($classname) . '::form_' . $classname . '($_REQUEST);
                        ?>
                    </div>
                </form>';
        return $txt;
    }

    public static function v($keterangan, $request) {
        if (@$_SESSION['lang'] == 'bi') {
            $lbltambah = 'ADD';
            $lblcnfrm = 'Are you sure?';
            $lblsenarai = 'List Of';
        } elseif (@$_SESSION['lang'] == 'bm') {
            $lbltambah = 'TAMBAH';
            $lblcnfrm = 'Anda pasti?';
            $lblsenarai = 'Senarai';
        }

        $classname = str_replace(" ", "", $request["modul"]);
        if (is_array(@$request['fields'])) {
            $tblstart = '<table class="table table-hover">
                        ';
            $tbl_head = '<thead>
                            <tr>
                            ';
            
            if($request['form_style']=='df'){
                $rowaddedit = '<td colspan=\''.count($request['fields']).'\'>';
                $classdate = 'col-md-3';
            }
            foreach ($request['fields'] as $r => $v) {
                if ($r >= 1) {
                    $tbl_head = $tbl_head . '<th><?php echo lbl(\'' . field2label($v) . '\') ?></th>
                            ';

                    if (is_array(@$request['compulsory'])) {
                        if (in_array($v, $request['compulsory'])) {
                            $checked_compulsory = '<?php echo FwSemak::alert_semak(@$chk_' . $v . ') ?>';
                        }
                    }
                    switch (@$request['typeselection'][$v]) {
                        case 'tf' : 
                            $inputtype = '<input name="' . $v . '" value="<?php echo @$' . $v . ' ?>" class="form-control ' . @$checked_compulsory . '">';
                            break;
                        case 'ta' : 
                            $inputtype = '<textarea name="' . $v . '" class="form-control ' . @$checked_compulsory . '"><?php echo @$' . $v . ' ?></textarea>';
                            break;
                        case 'te' : 
                            $inputtype = '<textarea name="' . $v . '" class="wysihtml5 form-control ' . @$checked_compulsory . '"><?php echo @$' . $v . ' ?></textarea>';
                            break;
                        case 'dt' :
                            $inputtype = '<div class="input-group date datepicker-autoClose '.@$classdate.'">
                        <input name="' . $v . '" type="text" value="<?php echo tkh(@$' . $v . ') ?>" class="form-control datepicker-autoClose ' . @$checked_compulsory . '" />
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div> ';
                            break;
                        case 'dl' :
                            $inputtype = '<?php $sql = "'.$request['typeselection']['sql'][$v].'";
                    Db::droplist($sql, \'' . $v . '\', \''.$request['typeselection']['fvalue'][$v].'\', \''.$request['typeselection']['fdisplay'][$v].'\', @$' . $v . ', $class = \'form-control \'.FwSemak::alert_semak(@$chk_' . $v . '), $others = \'\', $null = \'\');
                    ?>';
                            break;
                    }
                
                switch($request['form_style']){
                    case 'rt' :
                        $rowaddedit = @$rowaddedit . '  <td>'.$inputtype.'</td>
        ';
                        break;
                    case 'df' :
                        $rowaddedit = @$rowaddedit . '
            <div class="form-group">
                <label class="col-md-2 control-label"><?php echo lbl(\'' . field2label($v) . '\') ?></label>
                <div class="col-md-10">
                    '.@$inputtype.'
                </div>
            </div>';    
                        break;
                }    
                
                        if($request['typeselection'][$v]=='dt'){
                            $rowdisplay = @$rowdisplay . '<td><?php echo tkh($' . $v . ') ?></td>
                                                            ';
                        } else if($request['typeselection'][$v]=='dl'){
                            $rowdisplay = @$rowdisplay . '<td><?php echo Db::chkval(\''.$request['typeselection']['dtbl'][$v].'\',\''.$request['typeselection']['dfield'][$v].'\',"'.$request['typeselection']['dcond'][$v].'\'$' . $v . '\'") ?></td>
                                                            ';
                        } else {
                            $rowdisplay = @$rowdisplay . '<td><?php echo $' . $v . ' ?></td>
                                                            ';
                        }   

                
                }
                unset($checked_compulsory);
            }
            if($request['form_style']=='df'){
                $rowaddedit = @$rowaddedit.'<div class="form-group">
                <div class="col-md-12">
                    <center>
                        <?php
                        if(@$edit!=\'\'){
                            $btn_act = \'&update=\'.$edit;
                            $lbl_act = \'Update\';
                        } else {
                            $btn_act = \'&save=1\';
                            $lbl_act = \'Save\';
                        }
                        ?>
                        <a onclick="<?php echo ' . ucwords($classname) . '::ajaxclick($btn_act)?>;" class="btn btn-primary"><i class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a> 
                        <a onclick="<?php echo ' . ucwords($classname) . '::ajaxclick()?>;" class="btn btn-warning"><i class="fa fa-times bigger-120"></i> Cancel</a>
                    </center>
                </div>
            </div>
        </td>';
                
                $btnaction = '<?php
                                if (@$request[\'edit\'] != @$' . $request["fields"][0] . ') {
                                    ?>
                                    <td>
                                        <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo ' . ucwords($classname) . '::ajaxclick("&$btn_act=$' . $request["fields"][0] . '")?>">
                                            <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm(\'<?php echo $GLOBALS[\'fw_lbl_confirm\'] ?>\'))<?php echo ' . ucwords($classname) . '::ajaxclick("&del=$' . $request["fields"][0] . '")?>">
                                            <i class="fa fa-trash bigger-120"></i>
                                        </button>
                                    </td>
                                    <?php
                                } 
                                ?>';
                
            } else if($request['form_style']=='rt'){
                $btnadd = ' <td>
                                            <a onclick="<?php echo ' . ucwords($classname) . '::ajaxclick("&save=1")?>;" class="btn btn-xs btn-primary"><i class="fa fa-save bigger-120"></i></a>
                                            <a onclick="<?php echo ' . ucwords($classname) . '::ajaxclick()?>;" class="btn btn-xs btn-warning"><i class="fa fa-times bigger-120"></i></a>
                                        </td>';
                
                $btnaction = '<td>
                                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo ' . ucwords($classname) . '::ajaxclick("&$btn_act=$' . $request["fields"][0] . '")?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php
                                                if (@$request[\'edit\'] == @$' . $request["fields"][0] . ') {
                                                    ?>
                                                    <button type="button" class="btn btn-xs btn-warning" onclick="<?php echo ' . ucwords($classname) . '::ajaxclick() ?>">
                                                        <i class="fa fa-close bigger-120"></i>
                                                    </button>
                                                    <?php
                                                } else { ?>
                                                <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm(\'<?php echo $GLOBALS[\'fw_lbl_confirm\'] ?>\'))<?php echo ' . ucwords($classname) . '::ajaxclick("&del=$' . $request["fields"][0] . '")?>">
                                                    <i class="fa fa-trash bigger-120"></i>
                                                </button>
                                                <?php
                                                }
                                                ?>
                                            </td>';
            }
            # data_style 
            if (@$request['data_style'] == 'dl') {
                $ds_pagg = '<?php
                            $dataall = ' . ucwords($classname) . '::sql_datalist($request);
                            ?>';
                $ds_array = '$dataall';
            } else if (@$request['data_style'] == 'dlg') {
                $ds_pagg = '<?php
                            $dataall = ' . ucwords($classname) . '::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall[\'requestgrid\'], @$dataall[\'totalreturned\'], ' . ucwords($classname) . '::ajaxclick(), array(4, 6, 2));
                            ?>';
                $ds_array = '$dataall[\'fw_senarai\']';
            }
            # end data style

            $tbl_head = $tbl_head . '<th width="10%">
                                <?php if (!@$request[\'edit\']){ ?>
                                <button type="button" class="btn btn-xs btn-success" onclick="<?php echo ' . ucwords($classname) . '::ajaxclick("&add=1")?>">
                                    <i class="fa fa-plus-circle"></i> <?php echo lbl(\'' . $lbltambah . '\') ?>
                                </button> 
                                <?php } ?>
                            </th>
                        ';
            $tbl_head = $tbl_head . '    </tr>
                        </thead>
                    ';

            $tblbody = '    <tbody>
                                <?php
                                if (@$request[\'add\'] == 1) {
                                    ?>
                                    <tr>
                                        <?php View' . ucwords($classname) . '::form_add_edit(@$request); ?>
                                        '.@$btnadd.'
                                    </tr>    
                                <?php
                                }
                                if (is_array(' . @$ds_array . ')) {
                                    foreach (' . @$ds_array . ' AS $row => $value) {
                                        extract($value);
                                        if (!is_array(@$semak)){ 
                                            if(is_array($request)){
                                            $request = array_merge($request, $value);
                                            }
                                        }
                                        ?>    
                                        <tr <?php if (@$request[\'edit\'] == @$' . $request["fields"][0] . ') { echo \'class="active"\'; } ?>>
                                                <?php
                                                if (@$request[\'edit\'] == @$' . $request["fields"][0] . ') {
                                                    View' . ucwords($classname) . '::form_add_edit(@$request); 
                                                    $cls_icon = \'fa-save\';
                                                    $cls_btn = \'btn-primary\';
                                                    $btn_act = \'update\';
                                                } else {
                                                    ?>
                                                    ' . @$rowdisplay . '
                                                    <?php
                                                    $cls_icon = \'fa-pencil\';
                                                    $cls_btn = \'btn-info\';
                                                    $btn_act = \'edit\';
                                                }
                                                ?>
                                            '.@$btnaction.'
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>    
                            </tbody> ';

            $tblend = '</table>';

            $tbl = $tblstart . $tbl_head . $tblbody . $tblend;
        }


        $txt = '<?php

class View' . ucwords($classname) . ' {

    public static function form_' . $classname . '($request) {
        global $today;

        $semak = FwSemak::semak(@$request[\'semak\'], @$request[\'save\'], @$request[\'update\']);
        if (is_array($semak)){
            $request = array_merge($request,$semak);
            extract($request);
            extract($semak);
        }
        ?>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo ' . $classname . '::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl(\'' . $lblsenarai . ' ' . $keterangan . '\') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    ' . @$ds_pagg . '
                    ' . @$tbl . ' 
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    public static function form_add_edit($data) {
        if (is_array($data)) {
            extract($data);
        }
        if (is_array(@$semak)){
            $data = array_merge($data,$semak);
            extract($data);
            extract($semak);
        }
        ?>
        '.$rowaddedit.'
        <?php
    }

}
';
        return $txt;
    }

    public static function c($keterangan, $request) {
        //pr($request);
        $classname = str_replace(" ", "", $request["modul"]);
        global $dbname;
        global $dbdata;
        if (@$request["dbschema"] != '' and @ $request["dbschema"] != $dbdata[$dbname]['schema']) {
            $request["tabledb"] = $request["dbschema"] . '.' . $request["tabledb"];
        }

        if (is_array(@$request['fields'])) {
            foreach ($request['fields'] as $v) {
                $fields = @$fields . $v . ',';
                if(@$request['typeselection'][$v]=='dt'){
                    $dateformat = '$data[\''.$v.'\'] = chgdate(\'Y-m-d\', $data[\''.$v.'\']);';
                }
            }
            $fields = substr($fields, 0, -1);

            if (is_array(@$request['compulsory'])) {
                foreach ($request['compulsory'] as $row => $value) {
                    $wajib = @$wajib . $value . ',';
                }
                $wajib = substr(@$wajib, 0, -1);
            }

            # data_style 
            if (@$request['data_style'] == 'dl') {
                $ds_func = 'sql_datalist()';
                $ds_cond = '$condition = "1=1 ORDER BY ' . @$request["fields"][1] . '";';
                $ds_return = 'Db::data_list($table, $field, $condition)';
            } else if (@$request['data_style'] == 'dlg') {
                $ds_func = 'sql_listgrid($request)';
                $ds_cond = '$condition = "1=1";
            $order = \'' . @$request["fields"][1] . '\'';
                $ds_return = 'Db::list_grid($request, $table, $field, $condition, $order)';
            }
            # end data style
            
            if(@$wajib!=''){
                $rowwajib = '$semak = chkwajib($_POST, \'' . $wajib . '\');';
            }

            $proses = '$table = \'' . $request["tabledb"] . '\';
            '.@$rowwajib.'

            if (@$save || isset($data[\'update\'])) {
                '.@$dateformat.'
                if (@$semak) {
                    sts_sql(\'0\', @$msjok, $GLOBALS[\'fw_lbl_msg_chkwajib\']);

                    $data = array_merge($data, array("semak" => $semak));
                } else {
                    if (@$save) {
                        Db::insert_all($table, $data, \'Y\');
                        unset($data);
                    } else {
                        $condition = "' . $request["fields"][0] . '=\'" . $data[\'update\'] . "\'";
                        Db::update_all($table, $data, $condition, \'Y\');
                    }
                }
            }

            if (isset($data[\'del\'])) {
                $condition = "' . $request["fields"][0] . '=\'" . $data[\'del\'] . "\'";
                Db::delete($table, $condition, \'Y\');
            }';

            $funclist = 'public static function ' . $ds_func . ' {
        $table = \'' . $request["tabledb"] . '\';
        $field = \'' . $fields . '\';
        ' . @$ds_cond . ';

        return ' . @$ds_return . ';
    }';
        }

        $txt = '<?php

class ' . $classname . ' {

    public static function ajaxclick($get = \'\') {
        $idform = \'' . $classname . '\';
        $divajax = \'div' . ucwords($classname) . '\';
        $urlajax = Db::CFAjax(\'' . $classname . '\', \'process\');
        return "ajaxAll(\'$idform\', \'$divajax\', \'$urlajax$get\')";
    }

    public static function process($data) {
        if (is_array($data)) {
            extract($data);
            
            ' . @$proses . '
        }

        View' . ucwords($classname) . '::form_' . $classname . '(@$data);
    }

    ' . @$funclist . '

}
?>';
        return $txt;
    }

}

?>