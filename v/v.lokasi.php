<?php

class ViewLokasi {

    public static function form_lokasi($request) {
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
                <a onclick="<?php echo lokasi::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                <?php echo lbl('Senarai Lokasi') ?>
            </h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                            $dataall = Lokasi::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], Lokasi::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('No.') ?></th>
                            <th><?php echo lbl('Block') ?></th>
                            <th><?php echo lbl('Level') ?></th>
                            <th><?php echo lbl('Wing') ?></th>
                            <th><?php echo lbl('Room') ?></th>
                            <th><?php echo lbl('Department') ?></th>
                            <th width="10%">
                                <?php if (!@$request['edit']){ ?>
                                <button type="button" class="btn btn-xs btn-success"
                                    onclick="<?php echo Lokasi::ajaxclick("&add=1")?>">
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
                            <?php ViewLokasi::form_add_edit(@$request); ?>

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
                        <tr <?php if (@$request['edit'] == @$l_id) { echo 'class="active"'; } ?>>
                            <?php
                                                if (@$request['edit'] == @$l_id) {
                                                    ViewLokasi::form_add_edit(@$request); 
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                            <td><?php echo $fw_bil ?></td>
                            <td><?php echo $block ?></td>
                            <td><?php echo $level ?></td>
                            <td><?php echo $wing ?></td>
                            <td><?php echo $room ?></td>
                            <td><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'") ?></td>


                            <?php
                                                    $cls_icon = 'fa-pencil';
                                                    $cls_btn = 'btn-info';
                                                    $btn_act = 'edit';
                                                }
                                                ?>
                            <?php
                                if (@$request['edit'] != @$l_id) {
                                    ?>
                            <td>
                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>"
                                    onclick="<?php echo Lokasi::ajaxclick("&$btn_act=$l_id")?>">
                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger"
                                    onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo Lokasi::ajaxclick("&del=$l_id")?>">
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
<td colspan='5'>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Block') ?></label>
        <div class="col-md-10">
            <input name="block" value="<?php echo @$block ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Level') ?></label>
        <div class="col-md-10">
            <input name="level" value="<?php echo @$level ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Wing') ?></label>
        <div class="col-md-10">
            <input name="wing" value="<?php echo @$wing ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Room') ?></label>
        <div class="col-md-10">
            <input name="room" value="<?php echo @$room ?>" class="form-control ">
        </div>
    </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Department') ?></label>
        <div class="col-md-10">
            <?php $sql = "select dept_id, dept_name from department order by dept_id asc ;";
                    $onchange = lokasi::ajaxclick("&add=1");
                    $class = "form-control ";
                    lokasi::dldept('dept_id', $dept_id, $onchange, $class, $displyDisabled);
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
                <a onclick="<?php echo Lokasi::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo Lokasi::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php
    }

}