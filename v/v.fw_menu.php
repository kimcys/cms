<?php

class ViewFwMenu {

    public static function formmenu($request) {
        global $url_local;
        global $url;
        $allakses = Db::data_list('ref_role', 'rr_id, rr_description', "1=1 ORDER BY rr_description");
        ?>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('List of menu') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th width="5%"></th>
                                    <th width="40%">Menu</th>
                                    <th width="15%">HREF</th>
                                    <th width="15%">Class</th>
                                    <th width="15%">
                                        <?php
                                        if (!isset($request['edit'])) {
                                            ?>
                                            <button type="button" class="btn btn-xs btn-success" onclick="<?php echo FwMenu::ajaxclick("&add=1") ?>">
                                                <i class="fa fa-plus-circle"></i> <?php echo lbl('ADD NEW') ?>
                                            </button> 
                                        <?php } ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                    ?>
                                    <tr><td>&nbsp;</td>
                                        <td>
                                            <input name="m_keterangan" value="<?php echo @$request['m_keterangan'] ?>" placeholder="New menu" class="form-control">
                                        </td>
                                        <td>
                                            <select name="m_submenu" id="m_submenu" class="form-control" onchange="<?php echo FwMenu::ajaxclick("&add=1") ?>">
                                                <option value="">Have sub menu?</option>
                                                <option <?php
                                                if (@$request['m_submenu'] == 'Y') {
                                                    echo "selected='selected'";
                                                }
                                                ?> value="Y">Yes</option>
                                                <option <?php
                                                if (@$request['m_submenu'] == 'N') {
                                                    echo "selected='selected'";
                                                }
                                                ?> value="N">No</option>
                                            </select>
                                            <?php
                                            if (@$request['m_submenu'] == 'N') {
                                                ?>
                                                <input name="m_href" type="text" class="form-control" placeholder="Cth : m/m.ruj_peranan" value="<?php echo @$request['m_href'] ?>">
                                                <?php
                                            } else {
                                                ?>
                                                <input type = "hidden" name = "m_href" value = "#" />    
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td colspan="2">
                                            <input name="m_class" type="text" class="form-control"  value="<?php echo @$request['m_class'] ?>" placeholder="CSS Class">
                                        </td>
                                        <td>
                                            <a onclick="<?php echo FwMenu::ajaxclick("&save=1") ?>;" class="btn btn-primary m-r-5"><i class="fa fa-save"></i> Save</a>
                                        </td>
                                    </tr>    
                                    <?php
                                }
                                $dataall = FwMenu::sql_menu();
                                if (is_array(@$dataall)) {
                                    foreach ($dataall AS $row => $value) {
                                        extract($value);
                                        $submenu = FwMenu::sql_submenu(@$m_id);

                                        if ($m_status == 'A') {
                                            $cls = 'btn-success';
                                            $m_sts = 'Active';
                                        } else {
                                            $cls = 'btn-warning';
                                            $m_sts = 'Inactive';
                                        }
                                        ?>    
                                        <tr class="info">
                                            <?php
                                            if (@$request['edit'] == $m_id) {
                                                ?><td>&nbsp;</td>
                                                <td><input name="m_keterangan" value="<?php echo @$m_keterangan ?>" class="form-control">                                                </td>
                                                <td><input name="m_href" value="<?php echo @$m_href ?>" class="form-control"></td>
                                                <td><input name="m_class" value="<?php echo @$m_class ?>" class="form-control"></td>
                                                <?php
                                                $cls_icon = 'fa-save';
                                                $cls_btn = 'btn-primary';
                                                $btn_act = 'update';
                                            } else {
                                                ?>
                                                <td><button type="button" class="btn btn-xs btn-primary" onclick="<?php echo FwMenu::ajaxclick("&btnup=1&m_id=$m_id") ?>">
                                                        <i class="fa fa-arrow-up bigger-120"></i>
                                                    </button>
                                                    <button class="btn btn-xs btn-warning" type="button" title="susun ke bawah" onclick="<?php echo FwMenu::ajaxclick("&btndown=1&m_id=$m_id") ?>">
                                                        <i class="fa fa-arrow-down bigger-120"></i>
                                                    </button></td>
                                                <td><button type="button" class="btn btn-inverse btn-icon btn- btn-sm">
                                                        <i class="fa <?php
                                                        if (count($submenu) > 0) {
                                                            echo 'fa-plus';
                                                        } else {
                                                            echo 'fa-angle-double-right';
                                                        }
                                                        ?>"></i></button>
                                                        <?php echo $m_keterangan; ?>
                                                    <br><span class="border border-primary">
                                                        <i><b><u>Akses</u></b></i><br>
                                                        <?php
                                                        foreach ($allakses as $r => $v) {
                                                            $data_akses = FwMenu::list_akses($m_id, 0, $v['rr_id'])['rr_description'];
                                                            if (!empty($data_akses)) {
                                                                $checked = 'checked';
                                                                $val_akses = 0;
                                                            } else {
                                                                $val_akses = 1;
                                                            }
                                                            ?>
                                                            <div class="checkbox checkbox-css checkbox-success col-md-6" onclick="<?php echo FwMenu::ajaxclick("&fa_m_id=$m_id&fa_rr_id={$v['rr_id']}&valakses=$val_akses") ?>">
                                                                <input type="checkbox" <?php echo @$checked ?>/>
                                                                <label>
                                                                    <?php echo $v['rr_description'] ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                            unset($checked);
                                                        }
                                                        ?>
                                                    </span>
                                                </td>
                                                <td><?php
                                                    if (@$m_submenu == 'Y') {
                                                        ?>
                                                        <button type="button" class="btn btn-xs btn-success" onclick="<?php echo FwMenu::ajaxclick("&addsub=1&sm_m_id=$m_id") ?>">
                                                            <i class="fa fa-plus-circle"></i> <?php echo lbl('NEW SUBMENU') ?>
                                                        </button>     
                                                        <?php
                                                    } else {
                                                        echo $m_href;
                                                        if (!file_exists($m_href . '.php')) {
                                                            ?>
                                                            <button type="button" class="btn btn-xs btn-primary" onclick="<?php FwMenu::click_generate("&m_id=$m_id") ?>">
                                                                <i class="fa fa-code"></i> <?php echo lbl('GENERATE CODE') ?>
                                                            </button>      
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $m_class ?></td> 
                                                <?php
                                                $cls_icon = 'fa-pencil';
                                                $cls_btn = 'btn-info';
                                                $btn_act = 'edit';
                                            }
                                            ?>
                                            <td>
                                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo FwMenu::ajaxclick("&$btn_act=$m_id") ?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php $lblmsj = lbl('Anda pasti?'); ?>
                                                <button type="button" class="btn btn-xs btn-danger" onclick="if (confirm('<?php echo $lblmsj ?>'))<?php echo FwMenu::ajaxclick("&del=$m_id") ?>">
                                                    <i class="fa fa-trash bigger-120"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs <?php echo $cls ?>" onclick="<?php echo FwMenu::ajaxclick("&m_id=$m_id&m_status=$m_status") ?>" title="Status: <?php echo $m_sts ?>">
                                                    <i class="fa fa-flag bigger-120"></i>
                                                </button>
                                                <?php
                                                if (@$m_gen_code != '') {
                                                    ?>
                                                    <button type="button" class="btn btn-xs btn-primary" onclick="<?php FwMenu::click_generate("&m_id=$m_id&upd=1") ?>" title="Regenerate Code">
                                                        <i class="fa fa-code bigger-120"></i>
                                                    </button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        if (@$request['addsub'] == 1 and @ $request['sm_m_id'] == $m_id) {
                                            ?>
                                            <tr><td>&nbsp;</td>
                                                <td>
                                                    <input name="sm_keterangan" value="<?php echo @$request['sm_keterangan'] ?>" placeholder="New submenu" class="form-control">
                                                </td>
                                                <td>
                                                    <input name="sm_href" type="text" class="form-control" placeholder="Cth : m/m.ruj_peranan" value="<?php echo @$request['sm_href'] ?>">
                                                </td>
                                                <td colspan="2">
                                                    <input name="sm_class" type="text" class="form-control"  value="<?php echo @$request['sm_class'] ?>" placeholder="CSS Class">
                                                </td>
                                                <td>
                                                    <a onclick="<?php echo FwMenu::ajaxclick("&savesub=1&sm_m_id=$m_id") ?>;" class="btn btn-primary m-r-5"><i class="fa fa-save"></i> Save</a>
                                                </td>
                                            </tr>    
                                            <?php
                                        }

                                        if (is_array($submenu)) {
                                            foreach ($submenu as $k => $v) {
                                                if (is_array($v)) {
                                                    extract($v);

                                                    if (@$sm_status == 'A') {
                                                        $cls = 'btn-success';
                                                        $sm_sts = 'Active';
                                                    } else {
                                                        $cls = 'btn-warning';
                                                        $sm_sts = 'Inactive';
                                                    }
                                                    ?>
                                                    <tr style="display: show;">
                                                        <?php
                                                        if (@$request['editsub'] == $sm_id) {
                                                            ?><td>&nbsp;</td>
                                                            <td><input name="sm_keterangan" value="<?php echo @$sm_keterangan ?>" class="form-control">
                                                            </td>
                                                            <td><input name="sm_href" value="<?php echo @$sm_href ?>" class="form-control"></td>
                                                            <td><input name="sm_class" value="<?php echo @$sm_class ?>" class="form-control"></td>
                                                            <?php
                                                            $cls_icon = 'fa-save';
                                                            $cls_btn = 'btn-primary';
                                                            $btn_act = 'updatesub';
                                                        } else {
                                                            ?><td>&nbsp;</td>
                                                            <td><div class="col-md-2">
                                                                    <button type="button" class="btn btn-xs btn-primary" onclick="<?php echo FwMenu::ajaxclick("&btnup=1&m_id=$m_id&sm_id=$sm_id") ?>">
                                                                        <i class="fa fa-arrow-up bigger-120"></i>
                                                                    </button>
                                                                    <button class="btn btn-xs btn-warning" type="button" title="susun ke bawah" onclick="<?php echo FwMenu::ajaxclick("&btndown=1&m_id=$m_id&sm_id=$sm_id") ?>">
                                                                        <i class="fa fa-arrow-down bigger-120"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <i class="fa fa-minus"></i>
                                                                    <?php echo $sm_keterangan ?>
                                                                    <br><i><b><u>Akses</u></b></i><br>
                                                                    <?php
                                                                    foreach ($allakses as $rsub => $vsub) {
                                                                        $data_akses_sub = FwMenu::list_akses($m_id, $sm_id, $vsub['rr_id'])['rr_description'];

                                                                        if (!empty($data_akses_sub)) {
                                                                            $checked = 'checked';
                                                                            $val_akses_sub = 0;
                                                                        } else {
                                                                            $val_akses_sub = 1;
                                                                        }
                                                                        ?>
                                                                        <div class="checkbox checkbox-css checkbox-success col-md-6" onclick="<?php echo FwMenu::ajaxclick("&fa_m_id=$m_id&fa_sm_id=$sm_id&fa_rr_id={$vsub['rr_id']}&valakses=$val_akses_sub") ?>">
                                                                            <input type="checkbox" <?php echo @$checked ?> />
                                                                            <label>
                                                                                <?php echo $vsub['rr_description'] ?>
                                                                            </label>
                                                                        </div>
                                                                        <?php
                                                                        unset($checked);
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                            <td><?php
                                                                echo $sm_href;
                                                                if (!file_exists($sm_href . '.php')) {
                                                                    ?><br>
                                                                    <button type="button" class="btn btn-xs btn-primary" onclick="<?php FwMenu::click_generate("&m_id=$m_id&sm_id=$sm_id") ?>" title="Generate Code">
                                                                        <i class="fa fa-code"> <?php echo lbl('GENERATE CODE') ?></i>
                                                                    </button>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $sm_class ?></td>    
                                                            <?php
                                                            $cls_icon = 'fa-pencil';
                                                            $cls_btn = 'btn-info';
                                                            $btn_act = 'editsub';
                                                        }
                                                        ?>
                                                        <td>
                                                            <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo FwMenu::ajaxclick("&$btn_act=$sm_id&m_id=$m_id") ?>">
                                                                <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                            </button>
                                                            <?php $lblmsj = lbl('Anda pasti?'); ?>
                                                            <button type="button" class="btn btn-xs btn-danger" onclick="if (confirm('<?php echo $lblmsj ?>'))<?php echo FwMenu::ajaxclick("&delsub=$sm_id") ?>">
                                                                <i class="fa fa-trash bigger-120"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-xs <?php echo $cls ?>" onclick="<?php echo FwMenu::ajaxclick("&sm_id=$sm_id&sm_status=$sm_status") ?>" title="Status: <?php echo $sm_sts ?>">
                                                                <i class="fa fa-flag bigger-120"></i>
                                                            </button>
                                                            <?php
                                                            if (@$sm_gen_code != '') {
                                                                ?>
                                                                <button type="button" class="btn btn-xs btn-primary" onclick="<?php FwMenu::click_generate("&m_id=$m_id&sm_id=$sm_id&upd=1") ?>" title="Regenerate Code">
                                                                    <i class="fa fa-code bigger-120"></i>
                                                                </button>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>    
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function formgenerator($request) {
        if (is_array($request)) {
            extract($request);
        }
        //pr($request);
        ?>
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Generate Page') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="inline">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo lbl('Class Name') ?></label>
                                <div class="col-md-10">
                                    <input type="text" name="modul" class="form-control" value="<?php echo @$modul ?>" placeholder="Cth : SenaraiStaf">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo lbl('Table') ?></label>
                                <div class="col-md-10">
                                    <?php
                                    global $dbname;
                                    global $dbdata;

                                    switch ($dbdata[$dbname]['dbtype']) {
                                        case 'mysql':
                                            $dbschema = $dbdata[$dbname]['database'];
                                            break;
                                        case 'pgsql':
                                            if (@$dbschema == '') {
                                                $dbschema = $dbdata[$dbname]['schema'];
                                            }
                                            $sql = "SELECT schema_name 
                                            FROM information_schema.schemata";
                                            $name = "dbschema";
                                            $value = "schema_name";
                                            $display = "schema_name";
                                            $select = @$dbschema;
                                            $class = 'form-control';
                                            $onchange = FwMenu::click_generate("&m_id=$m_id&sm_id=" . @$sm_id . "&dbschema=" . @$dbschema . "&resettbl=1", 'N');
                                            $others = 'data-size="10" data-live-search="true" data-style="btn-white"';
                                            Db::droplistchange($sql, $name, $value, $display, $select, $class, $onchange, $others, 'Pilih Schema');
                                            break;
                                        default:
                                            $dbschema = $dbdata[$dbname]['schema'];
                                    }
                                    $sql = "SELECT TABLE_NAME AS sen_table 
                                            FROM INFORMATION_SCHEMA.TABLES 
                                            WHERE TABLE_SCHEMA = '$dbschema'";
                                    $name = "tabledb";
                                    $value = "sen_table";
                                    $display = "sen_table";
                                    $select = @$tabledb;
                                    $class = 'form-control';
                                    $onchange = FwMenu::click_generate("&m_id=$m_id&sm_id=" . @$sm_id . "&table=" . @$tabledb . "", 'N');
                                    $others = 'data-size="10" data-live-search="true" data-style="btn-white"';

                                    Db::droplistchange($sql, $name, $value, $display, $select, $class, $onchange, $others, 'Pilih Table');
                                    ?>
                                </div>
                            </div>
                            <?php
                            if (@$tabledb != '' and @ $resettbl == '') {
                                if ($dbdata[$dbname]['dbtype'] == 'Pg') {
                                    $tabledb = $dbschema . '.' . $tabledb;
                                }
                                ?>
                                <div class="form-group">
                                    <label class="col-md-2"></label>
                                    <label class="col-md-4"><?php echo lbl('Field Name (PK = Primary Key)') ?></label>
                                    <label class="col-md-4"><?php echo lbl('Field Type') ?></label>
                                    <label class="col-md-2" style="text-align:center"><?php echo lbl('Compulsory') ?></label>
                                    <?php
                                    $sqlfield = Db::query("SELECT * FROM $tabledb LIMIT 1")[0];
                                    $arrfield = array();

                                    $i = Db::num_fields($sqlfield);
                                    for ($j = 0; $j < $i; $j++) {
                                        $fieldname = Db::field_name($sqlfield, $j);
                                        if (is_array(@$fieldtype)) {
                                            $fieldtype[$fieldname] = Db::field_type($sqlfield, $j);
                                            $fieldtype = array_change_key_case($fieldtype, CASE_LOWER);
                                        }
                                        array_push($arrfield, strtolower($fieldname));
                                    }

                                    $arrfields = array();

                                    if (is_array(@$order) and @ $tabledb == @$table) {
                                        asort($order);
                                        foreach ($order as $f => $o) {
                                            array_push($arrfields, $f);
                                        }
                                    } else {
                                        foreach ($arrfield as $r => $f) {
                                            array_push($arrfields, $f);
                                        }
                                    }

                                    $chkbeza = array_diff($arrfield, $arrfields);

                                    $arrfields = array_merge($arrfields, $chkbeza);

                                    foreach ($arrfields as $r => $field_name) {
                                        if (is_array(@$fields)) {
                                            if (in_array($field_name, @$fields)) {
                                                $checked_field = "checked='checked'";
                                                if (is_array(@$compulsory)) {
                                                    if (in_array($field_name, @$compulsory)) {
                                                        $checked_compulsory = "checked='checked'";
                                                    }
                                                }
                                            }
                                        } else {
                                            $fields = array();
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-2 control-label">
                                                <?php
                                                if (in_array($field_name, @$fields)) {
                                                    ?>
                                                    <select name="order[<?php echo $field_name ?>]" onchange="<?php echo $onchange ?>">
                                                        <?php
                                                        $susunan = $order[$field_name];
                                                        if ($susunan == '') {
                                                            $susunan = $r;
                                                        }

                                                        for ($x = 0; $x < count($fields); $x++) {
                                                            $lbl = $x;
                                                            if ($lbl == 0) {
                                                                $lbl = 'PK';
                                                            }
                                                            if ($susunan == $x) {
                                                                echo "<option selected='selected' value='$x'>$lbl</option>";
                                                            } else {
                                                                echo "<option value='$x'>$lbl</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="fields[]" type="checkbox" <?php echo @$checked_field ?> value="<?php echo $field_name ?>" onchange="<?php echo $onchange ?>" /><?php echo $field_name ?>
                                                    </label>
                                                    <?php
                                                    if (@$typeselection[$field_name] == 'dl') {
                                                        ?>
                                                    <br><b><u>Db::chkval</u></b><br>
                                                    <b>Table</b> : <input type="text" name="typeselection[dtbl][<?php echo $field_name ?>]" class="form-control" placeholder="Cth : ref_role" value="<?php echo @$typeselection[dtbl][$field_name] ?>">
                                                    <b>Field</b> : <input type="text" name="typeselection[dfield][<?php echo $field_name ?>]" class="form-control" placeholder="Cth : rr_description" value="<?php echo @$typeselection[dfield][$field_name] ?>">
                                                    <b>Condition</b> : <input type="text" name="typeselection[dcond][<?php echo $field_name ?>]" class="form-control" placeholder="Cth : rr_id=" value="<?php echo @$typeselection[dcond][$field_name] ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                </div>  
                                            </div>
                                            <div class="col-md-4">
                                                <?php
                                                if (@$susunan != 0 and @ $fields[$susunan] == $field_name) {
                                                    ?>
                                                    <select name="typeselection[<?php echo $field_name ?>]" onchange="<?php echo $onchange ?>">
                                                        <option value="" <?php if (@$typeselection[$field_name] == '') { ?> selected="selected" <?php } ?>></option>
                                                        <option value="tf" <?php if (@$typeselection[$field_name] == 'tf') { ?> selected="selected" <?php } ?>>Text Field</option>
                                                        <option value="ta" <?php if (@$typeselection[$field_name] == 'ta') { ?> selected="selected" <?php } ?>>Text Area</option>
                                                        <option value="te" <?php if (@$typeselection[$field_name] == 'te') { ?> selected="selected" <?php } ?>>Text Editor</option>
                                                        <option value="dt" <?php if (@$typeselection[$field_name] == 'dt') { ?> selected="selected" <?php } ?>>Date Picker</option>
                                                        <option value="dl" <?php if (@$typeselection[$field_name] == 'dl') { ?> selected="selected" <?php } ?>>Droplist</option>
                                                    </select>
                                                    <?php
                                                    if (@$typeselection[$field_name] == 'dl') {
                                                        ?>
                                                <br><b>Sql</b> :<br><textarea class="form-control" name="typeselection[sql][<?php echo $field_name ?>]" placeholder="Cth : SELECT rr_id, rr_description FROM ref_role"><?php echo @$typeselection[sql][$field_name] ?></textarea>
                                                <b>Field Value</b> : <input type="text" name="typeselection[fvalue][<?php echo $field_name ?>]" class="form-control" placeholder="Cth : rr_id" value="<?php echo @$typeselection[fvalue][$field_name] ?>">
                                                <b>Field Display</b> : <input type="text" name="typeselection[fdisplay][<?php echo $field_name ?>]" class="form-control" placeholder="Cth : rr_description" value="<?php echo @$typeselection[fdisplay][$field_name] ?>">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="checkbox">
                                                    <center>
                                                        <label>
                                                            <?php
                                                            if (@$susunan != 0) {
                                                                ?>
                                                                <input name="compulsory[]" type="checkbox" <?php echo @$checked_compulsory ?> value="<?php echo $field_name ?>" onchange="<?php echo $onchange ?>"/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </label>
                                                    </center>
                                                </div>  
                                            </div>
                                        </div>
                                        <?php
                                        unset($checked_field);
                                        unset($checked_compulsory);
                                    }
                                    ?>

                                </div>    
                                <?php
                            }
                            if (@$tabledb != '') {
                                ?>
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><?php echo lbl('Data Style') ?></label>
                                    <div class="col-md-4">
                                        <select name="data_style" class="form-control">
                                            <option value="dl" <?php if (@$data_style == 'dl') { ?> selected="selected" <?php } ?>>Data List</option>
                                            <option value="dlg" <?php if (@$data_style == 'dlg') { ?> selected="selected" <?php } ?>>Data List Grid</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label"><?php echo lbl('Form Style') ?></label>
                                    <div class="col-md-4">
                                        <select name="form_style" class="form-control">
                                            <option value="rt" <?php if (@$form_style == 'rt') { ?> selected="selected" <?php } ?>>Row table</option>
                                            <option value="df" <?php if (@$form_style == 'df') { ?> selected="selected" <?php } ?>>Div form</option>
                                        </select>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <center>
                                    <button type="button" onclick="<?php echo FwMenu::ajaxclick() ?>" class="btn btn-warning">Back</button>
                                    <button type="button" onclick="<?php FwMenu::click_generate("&m_id=$m_id&sm_id=" . @$sm_id . "&save=1") ?>" class="btn btn-primary">Generate</button>
                                </center>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
        <?php
    }

}
