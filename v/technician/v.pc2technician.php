<?php

class ViewPc2Technician {

    public static function form_Pc2Technician($request) {
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
                <a onclick="<?php echo Pc2Technician::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
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
                            $dataall = Pc2Technician::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], Pc2Technician::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('No.') ?></th>
                            <th><?php echo lbl('Serial Number') ?></th>
                            <th><?php echo lbl('PC Owner') ?></th>
                            <th><?php echo lbl('Block') ?></th>
                            <th><?php echo lbl('Level') ?></th>
                            <th><?php echo lbl('Wing') ?></th>
                            <th><?php echo lbl('Room') ?></th>
                            <th><?php echo lbl('Department') ?></th>
                            <th width="10%">
                                <?php if (!@$request['edit']){ ?>
                                <button type="button" class="btn btn-xs btn-success"
                                    onclick="<?php echo Pc2::ajaxclick("&add=1")?>">
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
                            <?php ViewPc2Technician::form_add_edit(@$request); ?>

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
                                                    ViewPc2Technician::form_add_edit(@$request); 
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                            <td><?php echo $fw_bil ?></td>
                            <td>
                                <!-- link to another page -->
                                <a
                                    href="?do=<?php echo emenu($keymenu, 'm/m.specifikasi') ?>&menu=PC&pcId=<?php echo $pc_id ?>">
                                    <?php echo $serialnum  ?>
                                </a>
                            </td>
                            <td><?php echo Db::chkval('users','u_name',"u_id='$u_id'")?></td>
                            <td><?php echo Db::chkval('location','block',"block='$block'") ?></td>
                            <td><?php echo Db::chkval('location','level',"level='$level'") ?></td>
                            <td><?php echo Db::chkval('location','wing',"wing='$wing'") ?></td>
                            <td><?php echo Db::chkval('location','room',"room='$room'") ?></td>
                            <td><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'") ?></td>
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
                                    onclick="<?php echo Pc2Technician::ajaxclick("&$btn_act=$pc_id")?>">
                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger"
                                    onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo Pc2Technician::ajaxclick("&del=$dept_id")?>">
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
<td colspan='6'>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Serial Number') ?></label>
        <div class="col-md-10">
            <input name="serialnum" value="<?php echo @$serialnum ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('PC Owner') ?></label>
        <div class="col-md-10">
            <input name="P" value="<?php echo @$dept_name ?>"
                class="form-control <?php echo FwSemak::alert_semak(@$chk_dept_name) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Block') ?></label>
        <div class="col-md-10">
            <?php $sql = "select distinct block from location order by block asc ;";
                    $onchange = Pc2Technician::ajaxclick("&add=1");
                    $class = "form-control ";
                    Pc2Technician::dlblock('block', $block, $onchange, $class, $displyDisabled);
                    ?>
        </div>
    </div>
    <?php
if (!empty($block)){
?>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Level') ?></label>
        <div class="col-md-10">
            <?php $sql = "select distinct level from location order by level asc ;";
                   $onchange = Pc2Technician::ajaxclick("&add=1");
                   $class = "form-control ";
                   Pc2Technician::dllevel($block,'level', $level, $onchange, $class, $displyDisabled);
                   ?>
        </div>
    </div>
    <?php
   }
  if (!empty($level)){
   ?>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Wing') ?></label>
        <div class="col-md-10">
            <?php $sql = "select distinct wing from location order by wing asc ;";
                    $onchange = Pc2Technician::ajaxclick("&add=1");
                    $class = "form-control ";
                    Pc2Technician::dlwing($block, $level,'wing', $wing, $onchange, $class, $displyDisabled);
                    ?>
        </div>
    </div>
    <?php
    }
   if (!empty($wing)){
    ?>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Room') ?></label>
        <div class="col-md-10">
            <?php $sql = "select distinct room from location order by room asc ;";
                    $onchange = Pc2Technician::ajaxclick("&add=1");
                    $class = "form-control ";
                    Pc2Technician::dlroom($block, $level, $wing,'room', $room, $onchange, $class, $displyDisabled);
                    ?>
        </div>
    </div>
    <?php
    }
    ?>
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
                <a onclick="<?php echo Pc2Technician::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo Pc2Technician::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php
    }

}