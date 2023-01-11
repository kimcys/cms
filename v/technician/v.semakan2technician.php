<?php

class ViewSemakan2Technician {

    public static function form_Semakan2Technician($request) {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
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
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a onclick="<?php echo Semakan2Technician::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                <?php echo lbl('Senarai Semakan') ?>
            </h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                            $dataall = Semakan2Technician::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], Semakan2Technician::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('Serial Number') ?></th>
                            <th><?php echo lbl('CPU') ?></th>
                            <th><?php echo lbl('RAM') ?></th>
                            <th><?php echo lbl('Operating System') ?></th>
                            <th><?php echo lbl('Department') ?></th>
                            <th><?php echo lbl('Antivirus') ?></th>
                            <th><?php echo lbl('Dvd') ?></th>
                            <th><?php echo lbl('Mouse') ?></th>
                            <th><?php echo lbl('Keyboard') ?></th>
                            <th><?php echo lbl('Monitor') ?></th>
                            <th><?php echo lbl('Network Card') ?></th>
                            <th><?php echo lbl('USB Port') ?></th>
                            <th><?php echo lbl('Display Card') ?></th>
                            <th><?php echo lbl('Audio Video') ?></th>
                            <th><?php echo lbl('External Cleanup') ?></th>
                            <th><?php echo lbl('Date Checked') ?></th>
                            <th><?php echo lbl('Maintained By') ?></th>
                            <th width="10%">
                                <?php if (!@$request['edit']){ ?>
                                <button type="button" class="btn btn-xs btn-success"
                                    onclick="<?php echo Semakan2Technician::ajaxclick("&add=1")?>">
                                    <i class="fa fa-plus-circle"></i> <?php echo lbl('TAMBAH') ?>
                                </button>
                                <?php } ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if (@$request['add'] == 1) {
                                    ?>
                        <tr>
                            <?php ViewSemakan2Technician::form_add_edit(@$request); ?>

                        </tr>
                        <?php
                                }
                                if (is_array($dataall['fw_senarai'])) {
                                    foreach ($dataall['fw_senarai'] AS $row => $value) {
                                        extract($value);
                                        if (!is_array(@$semak)){ 
                                            if(is_array($request)){
                                            $request = array_merge($request, $value);
                                            }
                                        }
                                        ?>
                        <tr <?php if (@$request['edit'] == @$c_id) { echo 'class="active"'; } ?>>
                            <?php
                                                if (@$request['edit'] == @$c_id) {
                                                    ViewSemakan2Technician::form_add_edit(@$request); 
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                            <td><?php echo Db::chkval('pc','serialnum',"pc_id='$pc_id'") ?></td>
                            <td><?php echo $cpu ?></td>
                            <td><?php echo $ram ?></td>
                            <td><?php echo $operating_system ?></td>
                            <td><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'") ?></td>
                            <td><?php echo $antivirus ?></td>
                            <td><?php echo $cd_dvd ?></td>
                            <td><?php echo $mouse ?></td>
                            <td><?php echo $keyboard ?></td>
                            <td><?php echo $monitor ?></td>
                            <td><?php echo $network_card ?></td>
                            <td><?php echo $usb_port ?></td>
                            <td><?php echo $display_card ?></td>
                            <td><?php echo $audio_video ?></td>
                            <td><?php echo $external_cleanup ?></td>
                            <td><?php echo tkh($date_check) ?></td>
                            <td><?php echo Db::chkval('users','u_name',"u_id='$maintained_by'") ?></td>
                            <?php
                                                    $cls_icon = 'fa-pencil';
                                                    $cls_btn = 'btn-info';
                                                    $btn_act = 'edit';
                                                }
                                                ?>
                            <?php
                                if (@$request['edit'] != @$c_id) {
                                    ?>
                            <td>
                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>"
                                    onclick="<?php echo Semakan2Technician::ajaxclick("&$btn_act=$c_id")?>">
                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger"
                                    onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo Semakan2Technician::ajaxclick("&del=$c_id")?>">
                                    <i class="fa fa-trash bigger-120"></i>
                                </button>
                            </td>
                            <?php
                                } 
                                ?>
                        </tr>
                        <?php
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
<td colspan='18'>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Serial Number') ?></label>
        <div class="col-md-10">
            <?php $sql = "select pc_id, serialnum from pc;";
                    Db::droplist($sql, 'pc_id', 'pc_id', 'serialnum', @$pc_id, $class = 'form-control '.FwSemak::alert_semak(@$chk_pc_id), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Serial Number') ?></label>
        <div class="col-md-10">
            <?php $sql = "select pc_id, serialnum from pc;";
                    Db::droplist($sql, 'serialnum', 'serialnum', 'serialnum', @$serialnum, $class = 'form-control '.FwSemak::alert_semak(@$chk_pc_id), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('CPU') ?></label>
        <div class="col-md-10">
            <input name="cpu" value="<?php echo @$cpu ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('RAM') ?></label>
        <div class="col-md-10">
            <input name="ram" value="<?php echo @$ram ?>" class="form-control ">
        </div>
    </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Operating System') ?></label>
        <div class="col-md-10">
            <input name="operating_system" value="<?php echo @$operating_system ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Department') ?></label>
        <div class="col-md-10">
            <input name="dept_id" value="<?php echo @$dept_id ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Antivirus') ?></label>
        <div class="form-group">
            <input type="radio" name="antivirus" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="antivirus" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('CD/DVD') ?></label>
        <div class="form-group">
            <input type="radio" name="cd_dvd" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="cd_dvd" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Mouse') ?></label>
        <div class="form-group">
            <input type="radio" name="mouse" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="mouse" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Keyboard') ?></label>
        <div class="form-group">
            <input type="radio" name="keyboard" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="keyboard" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Monitor') ?></label>
        <div class="form-group">
            <input type="radio" name="monitor" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="monitor" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Network Card') ?></label>
        <div class="form-group">
            <input type="radio" name="network_card" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="network_card" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('USB Port') ?></label>
        <div class="form-group">
            <input type="radio" name="usb_port" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="usb_port" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Display Card') ?></label>
        <div class="form-group">
            <input type="radio" name="display_card" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="display_card" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Audio Video') ?></label>
        <div class="form-group">
            <input type="radio" name="audio_video" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="audio_video" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('External Cleanup') ?></label>
        <div class="form-group">
            <input type="radio" name="external_cleanup" id="Maintained" value="Maintained">
              <label for="Maintained">Maintained</label>
            <input type="radio" name="external_cleanup" id="Not Maintained" value="Not Maintained">
              <label for="Not Maintained">Not Maintained</label><br>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Date Checked') ?></label>
        <div class="col-md-10">
            <div class="input-group date datepicker-autoClose col-md-3">
                <input name="date_check" type="text" value="<?php echo tkh(@$date_check) ?>"
                    class="form-control datepicker-autoClose " />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Maintained By') ?></label>
        <div class="col-md-10">
            <?php $sql = "select u_id, u_name from users where u_rr_id = '2';";
                    Db::droplist($sql, 'maintained_by', 'u_id', 'u_name', @$maintained_by, $class = 'form-control '.FwSemak::alert_semak(@$chk_maintained_by), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <center>
                <?php
                        if(@$edit!=''){
                            $btn_act = '&update='.$edit;
                            $lbl_act = 'Update';
                        } else {
                            $btn_act = '&save=1';
                            $lbl_act = 'Save';
                        }
                        ?>
                <a onclick="<?php echo Semakan2Technician::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo Semakan2Technician::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php
    }

}