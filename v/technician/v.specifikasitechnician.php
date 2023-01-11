<?php

class ViewSpesifikasiTechnician {

    public static function form_SpesifikasiTechnician($request) {
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
                <a onclick="<?php echo SpesifikasiTechnician::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                <?php echo lbl('Senarai Spesifikasi') ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php
                            $dataall = SpesifikasiTechnician::sql_listgrid($request);
                            ?>
            <?php
            if (!@$request['edit']){ ?>
            <button type="button" class="btn btn-xs btn-success"
                onclick="<?php echo SpesifikasiTechnician::ajaxclick("&add=1")?>">
                <i class="fa fa-plus-circle"></i> <?php echo lbl('TAMBAH') ?>
            </button>
            <?php } 
                
            
                                if (@$request['add'] == 1) {
                                    ?>
            <tr>
                <?php ViewSpesifikasiTechnician::form_add_edit(@$request); ?>

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
            <?php if (@$request['edit'] == @$f_id) { echo 'class="active"'; } 
            if (@$request['edit'] == @$f_id) {
            ViewSpesifikasiTechnician::form_add_edit(@$request); 
                                                } else {
                                                    ?>


            <div class="main-cards">
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Serial Number</p>
                        <span class="material-icons-outlined text-blue">computer</span>
                    </div>
                    <span
                        class="text-primary font-weight-bold"><?php echo Db::chkval('pc','serialnum',"pc_id='$pc_id'")?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">PC Owner</p>
                        <span class="material-icons-outlined text-blue">account_circle</span>
                    </div>
                    <span
                        class="text-primary font-weight-bold"><?php echo Db::chkval('users','u_name',"u_id='$u_id'")?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">CPU</p>
                        <span class="material-icons-outlined text-orange">developer_board</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $cpu?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">RAM</p>
                        <span class="material-icons-outlined text-red">memory</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $ram?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Hard Disk</p>
                        <span class="material-icons-outlined text-green">storage</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $hard_disk?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Mouse</p>
                        <span class="material-icons-outlined text-blue">mouse</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $mouse?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Monitor</p>
                        <span class="material-icons-outlined text-orange">monitor</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $monitor?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Antivirus</p>
                        <span class="material-icons-outlined text-red">security</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $antivirus?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Operating System</p>
                        <span class="material-icons-outlined text-red">android</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $operating_system?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Printer</p>
                        <span class="material-icons-outlined text-orange">printer</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $printer?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Keyboard</p>
                        <span class="material-icons-outlined text-orange">keyboard</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $keyboard?></span>
                </div>

            </div>
            <?php
                 }
             if (@$request['edit'] != @$f_id) {
            ?>
            <button type="button" class="btn btn-xs btn-info"
                onclick="<?php echo SpesifikasiTechnician::ajaxclick("&edit=$f_id")?>">
                <i class="fa fa-pencil bigger-120"></i> <?php echo lbl('KEMASKINI') ?>
            </button>
            <button type="button" class="btn btn-xs btn-danger"
                onclick="if(confirm('<?php echo $GLOBALS['fw_lbl_confirm'] ?>'))<?php echo SpesifikasiTechnician::ajaxclick("&del=$f_id")?>">
                <i class="fa fa-trash bigger-120"></i> <?php echo lbl('BUANG') ?>
            </button>
            <?php
                                } 
                                ?>
            <?php
                                }
                                }
                                ?>

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
<td colspan='12'>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Serial Number') ?></label>
        <div class="col-md-10">
            <?php $sql = "select pc_id, serialnum from pc;";
                    Db::droplist($sql, 'pc_id', 'pc_id', 'serialnum', @$pc_id, $class = 'form-control '.FwSemak::alert_semak(@$chk_pc_id), $others = '', $null = '');
                    ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('PC Owner') ?></label>
        <div class="col-md-10">
            <?php $sql = "select u_id, u_name from users;";
                    Db::droplist($sql, 'u_id', 'u_id', 'u_name', @$u_id, $class = 'form-control '.FwSemak::alert_semak(@$chk_u_id), $others = '', $null = '');
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
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Hard Disk') ?></label>
        <div class="col-md-10">
            <input name="hard_disk" value="<?php echo @$hard_disk ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Mouse') ?></label>
        <div class="col-md-10">
            <input name="mouse" value="<?php echo @$mouse ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Monitor') ?></label>
        <div class="col-md-10">
            <input name="monitor" value="<?php echo @$monitor ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Antivirus') ?></label>
        <div class="col-md-10">
            <input name="antivirus" value="<?php echo @$antivirus ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Operating System') ?></label>
        <div class="col-md-10">
            <input name="operating_system" value="<?php echo @$operating_system ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Printer') ?></label>
        <div class="col-md-10">
            <input name="printer" value="<?php echo @$printer ?>" class="form-control ">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo lbl('Keyboard') ?></label>
        <div class="col-md-10">
            <input name="keyboard" value="<?php echo @$keyboard ?>" class="form-control ">
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
                <a onclick="<?php echo SpesifikasiTechnician::ajaxclick($btn_act)?>;" class="btn btn-primary"><i
                        class="fa fa-save bigger-120"></i> <?php echo $lbl_act ?></a>
                <a onclick="<?php echo SpesifikasiTechnician::ajaxclick()?>;" class="btn btn-warning"><i
                        class="fa fa-times bigger-120"></i> Cancel</a>
            </center>
        </div>
    </div>
</td>
<?php
    }

}