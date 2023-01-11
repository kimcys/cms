<?php

class ViewPccc {

    public static function form_Pccc($request) {
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
                <a onclick="<?php echo Pccc::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                <?php echo lbl('Senarai mmmmm') ?>
            </h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                            $dataall = Pc::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], Pccc::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('No.') ?></th>
                            <th><?php echo lbl('Department') ?></th>
                            <th><?php echo lbl('Total PC') ?></th>
                            <?php if (!@$request['edit']){ ?>
                            <button type="button" class="btn btn-xs btn-success"
                                onclick="<?php echo Pc::ajaxclick("&add=1")?>">
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
                            <?php ViewPccc::form_add_edit(@$request); ?>

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
                        <tr <?php if (@$request['edit'] == @$pc_id) { echo 'class="active"'; } ?>>
                            <?php
                                                if (@$request['edit'] == @$pc_id) {
                                                    ViewPccc::form_add_edit(@$request); 
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                            <td><?php echo $fw_bil ?></td>
                            <td>
                                <!-- link to another page -->
                                <a
                                    href="?do=<?php echo emenu($keymenu, 'm/m.pc2') ?>&menu=PC&deptId=<?php echo $dept_id ?>">
                                    <?php echo $dept_name  ?>
                                </a>
                            </td>
                            <td>
                                <?php 
                                # to count total pc
                                echo Db::chkval('pc',"COUNT(dept_id)","dept_id=$dept_id");
                                ?>
                            </td>

                            <?php
                                                    $cls_icon = 'fa-pencil';
                                                    $cls_btn = 'btn-info';
                                                    $btn_act = 'edit';
                                                }
                                                ?>
                            <?php
                                if (@$request['edit'] != @$pc_id) {
                                    ?>
                            <td>
                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>"
                                    onclick="<?php echo Pccc::ajaxclick("&$btn_act=$pc_id")?>">
                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger"
                                    onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo Pccc::ajaxclick("&del=$pc_id")?>">
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
<td colspan='8'>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Erialnum') ?></label>
        <div class="col-md-10">
            <input name="serialnum" value="<?php echo @$serialnum ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_serialnum) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Id') ?></label>
        <div class="col-md-10">
            <?php $sql = "select u_id, u_name from users;";
                    Db::droplist($sql, 'u_id', 'u_id', 'u_name', @$u_id, $class = 'form-control '.FwSemak::alert_semak(@$chk_u_id), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Id') ?></label>
        <div class="col-md-10">
            <?php $sql = "select dept_id, dept_name from department;";
                    Db::droplist($sql, 'dept_id', 'dept_id', 'dept_name', @$dept_id, $class = 'form-control '.FwSemak::alert_semak(@$chk_dept_id), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Lock') ?></label>
        <div class="col-md-10">
            <input name="block" value="<?php echo @$block ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_block) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Evel') ?></label>
        <div class="col-md-10">
            <input name="level" value="<?php echo @$level ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_level) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Ing') ?></label>
        <div class="col-md-10">
            <input name="wing" value="<?php echo @$wing ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_wing) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Oom') ?></label>
        <div class="col-md-10">
            <input name="room" value="<?php echo @$room ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_room) ?>">
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
                <a onclick="<?php echo Pccc::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo Pccc::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php
    }

}