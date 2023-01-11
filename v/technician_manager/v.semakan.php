<?php

class ViewSemakan {

    public static function form_Semakan($request) {
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
                <a onclick="<?php echo Semakan::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
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
                            $dataall = Semakan::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], Semakan::ajaxclick(), array(4, 6, 2));
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
                                <!-- link to another page m/m.pc2 -->
                                <a
                                    href="?do=<?php echo emenu($keymenu,'m/m.semakanpc')?>&menu=Semakan&deptId=<?php echo $dept_id ?>">
                                    <?php echo $dept_name  ?>
                                </a>
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

}