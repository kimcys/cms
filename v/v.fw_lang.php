<?php

class ViewFwLang {

    public static function form_FwLang($request) {
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
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a onclick="<?php echo FwLang::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <?php echo lbl('Senarai Terjemahan') ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <?php
                            $dataall = FwLang::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], FwLang::ajaxclick(), array(4, 6, 2));
                            ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th><?php echo lbl('Label') ?></th>
                            <th><?php echo lbl('BM') ?></th>
                            <th><?php echo lbl('BI') ?></th>
                            <th width="10%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if (@$request['add'] == 1) {
                                    unset($request['label']);
                                    unset($request['bm']);
                                    unset($request['bi']);
                                    
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $label ?>
                                        </td>
                                        <td>
                                            <input name="bm" value="<?php echo @$request['bm'] ?>" class="form-control " onkeypress="return event.keyCode != 13;">
                                        </td>
                                        <td>
                                            <input name="bi" value="<?php echo @$request['bi'] ?>" class="form-control " onkeypress="return event.keyCode != 13;">
                                        </td>
                                        
                                        <td>
                                            <a onclick="<?php echo FwLang::ajaxclick("&save=1")?>;" class="btn btn-xs btn-primary"><i class="fa fa-save bigger-120"></i></a>
                                            <a onclick="<?php echo FwLang::ajaxclick()?>;" class="btn btn-xs btn-warning"><i class="fa fa-times bigger-120"></i></a>
                                        </td>
                                    </tr>    
                                <?php
                                }
                                if (is_array($dataall['fw_senarai'])) {
                                    foreach ($dataall['fw_senarai'] AS $row => $value) {
                                        extract($value);
                                        ?>    
                                        <tr>
                                                <?php
                                                if (@$request['edit'] == @$fl_id) {
                                                    ?>
                                                      <td><?php echo $label ?></td>
                                                      <td><input name="bm" value="<?php echo @$bm ?>" class="form-control " onkeypress="return event.keyCode != 13;"></td>
                                                      <td><input name="bi" value="<?php echo @$bi ?>" class="form-control " onkeypress="return event.keyCode != 13;"></td>
                                                    
                                                    <?php
                                                    $cls_icon = 'fa-save';
                                                    $cls_btn = 'btn-primary';
                                                    $btn_act = 'update';
                                                } else {
                                                    ?>
                                                    <td><?php echo $label ?></td>
                                                    <td><?php echo $bm ?></td>
                                                    <td><?php echo $bi ?></td>
                                                    
                                                    <?php
                                                    $cls_icon = 'fa-pencil';
                                                    $cls_btn = 'btn-info';
                                                    $btn_act = 'edit';
                                                }
                                                ?>
                                            <td>
                                                <button type="button" class="btn btn-xs <?php echo $cls_btn ?>" onclick="<?php echo FwLang::ajaxclick("&$btn_act=$fl_id")?>">
                                                    <i class="fa <?php echo $cls_icon ?> bigger-120"></i>
                                                </button>
                                                <?php $lblmsj = lbl("Anda pasti?"); ?>
                                                <button type="button" class="btn btn-xs btn-danger" onclick="if(confirm('<?php echo $lblmsj ?>'))<?php echo FwLang::ajaxclick("&del=$fl_id")?>">
                                                    <i class="fa fa-trash bigger-120"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>    
                            </tbody> </table> 
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
