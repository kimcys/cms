<?php

class ViewSemakanTechnician {

    public static function form_SemakanTechnician($request) {
        global $today;
        $keymenu = $_SESSION['keybefore']; // use this if want to link to other page

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
                <a onclick="<?php echo SemakanTechnician::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                <?php echo lbl('Senarai PC') ?>
            </h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                            $dataall = SemakanTechnician::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], SemakanTechnician::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('No.') ?></th>
                            <th><?php echo lbl('Department') ?></th>
                            <th><?php echo lbl('Total Cheklist PC') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                
                                if (is_array($dataall['fw_senarai'])) {
                                    foreach ($dataall['fw_senarai'] AS $row => $value) {
                                        extract($value);
                                        if (!is_array(@$semak)){ 
                                            if(is_array($request)){
                                            $request = array_merge($request, $value);
                                            }
                                        }
                                        ?>
                        <tr>

                            <td><?php echo $fw_bil ?></td>
                            <td>
                                <!-- link to another page -->
                                <a
                                    href="?do=<?php echo emenu($keymenu, 'm/m.semakan2technician') ?>&menu=Semakan&deptId=<?php echo $dept_id ?>">
                                    <?php echo $dept_name  ?>
                            </td>
                            <td>
                                <?php 
                                # to count total pc
                                echo Db::chkval('checklist',"COUNT(dept_id)","dept_id=$dept_id");
                                ?>
                            </td>
                            <?php
                                                }
                                                ?>
                        </tr>
                        <?php
                                    
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
                <a onclick="<?php echo SemakanTechnician::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo SemakanTechnician::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php
    }

}