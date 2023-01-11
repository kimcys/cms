<?php

class ViewPenyelenggaraan1 {

    public static function form_Penyelenggaraan1($request) {
        global $today;

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)){
            $request = array_merge($request,$semak);
            extract($request);
            extract($semak);
        }
        ?>

<script>
$(document).ready(function() {
    $("#checkAll").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });

    $("input[type=checkbox]").click(function() {
        if (!$(this).prop("checked")) {
            $("#checkAll").prop("checked", false);
        }
    });
});
</script>

<div class="col-md-12">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a onclick="<?php echo Penyelenggaraan1::ajaxclick()?>;"
                    class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                <?php echo lbl('Senarai Penyelenggaraan') ?>
            </h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                            $dataall = penyelenggaraan1::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], Penyelenggaraan1::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('No.') ?></th>
                            <th><?php echo lbl('Serial Num') ?></th>
                            <th><?php echo lbl('Department') ?></th>
                            <th><?php echo lbl('Block') ?></th>
                            <th><?php echo lbl('Level') ?></th>
                            <th><?php echo lbl('Wing') ?></th>
                            <th><?php echo lbl('Room') ?></th>
                            <th><?php echo lbl('Start Date') ?></th>
                            <th><?php echo lbl('End Date') ?></th>
                            <th><?php echo lbl('AssignedTo') ?></th>
                            <th><?php echo lbl('Status') ?></th>
                            <th>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="checkAll">
                                    </label>
                                    <?php echo lbl('SELECT ALL') ?>
                                </div>
                            </th>
                            <th width="10%">
                                <?php if (!@$request['edit']){ ?>
                                <button type="button" class="btn btn-xs btn-success"
                                    onclick="<?php echo Penyelenggaraan1::ajaxclick("&add=1")?>">
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
                            <?php ViewPenyelenggaraan1::form_add_edit(@$request); ?>

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
                        <tr <?php if (@$request['edit'] == @$m_id) { echo 'class="active"'; } ?>>
                            <?php
                                                if (@$request['edit'] == @$m_id) {
                                                    ViewPenyelenggaraan1::form_add_edit(@$request); 
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                            <td><?php echo $fw_bil ?></td>
                            <td><?php echo Db::chkval('pc','serialnum',"pc_id='$pc_id'") ?></td>
                            <td><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'") ?></td>
                            <td><?php echo $block ?></td>
                            <td><?php echo $level ?></td>
                            <td><?php echo $room ?></td>
                            <td><?php echo $wing ?></td>
                            <td><?php echo tkh($start_date) ?></td>
                            <td><?php echo tkh($end_date) ?></td>
                            <td><?php echo Db::chkval('users','u_name',"u_id='$assigned_to'") ?></td>
                            <td><?php echo Db::chkval('status','status',"s_id='$status'") ?></td>
                            <td>
                                <?php echo $m_id ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="chkApprove" name="m_idR[]"
                                            id="m_idC<?php echo $row ?>" value="<?php echo $m_id ?>" />
                                    </label>
                                </div>
                            </td>
                            <?php
                                                    $cls_icon = 'fa-pencil';
                                                    $cls_btn = 'btn-info';
                                                    $btn_act = 'edit';
                                                }
                                                ?>
                            <?php
                                if (@$request['edit'] != @$m_id) {
                                    ?>
                            <td>
                                <button type="button" class="btn btn-xs <?php echo 'btn-success' ?>"
                                    onclick="<?php echo penyelenggaraan1::ajaxclick("&$btn_act=$m_id")?>">
                                    <i class="fa <?php echo 'fa-floppy-o'  ?> bigger-120"></i>
                                </button>

                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>"
                                    onclick="<?php echo penyelenggaraan1::ajaxclick("&$btn_act=$m_id")?>">
                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger"
                                    onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo Penyelenggaraan1::ajaxclick("&del=$m_id")?>">
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
                <div class="b">
                    <button type="button" class="btn btn-xs <?php echo 'btn-success' ?>"
                        onclick="<?php echo penyelenggaraan1::ajaxclick('&save=1')?>">
                        <i class="fa <?php echo 'fa-floppy-o'?> bigger-120"></i> <?php echo lbl('Approve') ?>
                    </button>
                </div>
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
<td colspan='11'>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Serial Number') ?></label>
        <div class="col-md-10">
            <?php $sql = "select pc_id, serialnum from pc order by pc_id;";
                    Db::droplist($sql, 'pc_id', 'pc_id', 'serialnum', @$pc_id, $class = 'form-control '.FwSemak::alert_semak(@$chk_pc_id), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Department') ?></label>
        <div class="col-md-10">
            <input name="dept_id" value="<?php echo @$dept_id ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_dept_id) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Block') ?></label>
        <div class="col-md-10">
            <input name="block" value="<?php echo @$block ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_block) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Level') ?></label>
        <div class="col-md-10">
            <input name="level" value="<?php echo @$level ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_level) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Wing') ?></label>
        <div class="col-md-10">
            <input name="wing" value="<?php echo @$wing ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_wing) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Room') ?></label>
        <div class="col-md-10">
            <input name="room" value="<?php echo @$room ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_room) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Start Date') ?></label>
        <div class="col-md-10">
            <div class="input-group date datepicker-autoClose col-md-3">
                <input name="start_date" type="text" value="<?php echo tkh(@$start_date) ?>"
                    class="form-control datepicker-autoClose <?php echo FwSemak::alert_semak(@$chk_start_date) ?>" />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('End Date') ?></label>
        <div class="col-md-10">
            <div class="input-group date datepicker-autoClose col-md-3">
                <input name="end_date" type="text" value="<?php echo tkh(@$end_date) ?>"
                    class="form-control datepicker-autoClose <?php echo FwSemak::alert_semak(@$chk_end_date) ?>" />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Assigned To') ?></label>
        <div class="col-md-10">
            <?php $sql = "select u_id, u_name from users where u_rr_id='2' order by u_id;";
                    Db::droplist($sql, 'assigned_to', 'u_id', 'u_name', @$assigned_to, $class = 'form-control '.FwSemak::alert_semak(@$chk_assigned_to), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Status') ?></label>
        <div class="col-md-10">
            <?php $sql = "select s_id, status from status order by s_id;";
                    Db::droplist($sql, 'status', 's_id', 'status', @$status, $class = 'form-control '.FwSemak::alert_semak(@$chk_status), $others = '', $null = '');
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
                <a onclick="<?php echo Penyelenggaraan1::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo penyelenggaraan1::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php

    }

}