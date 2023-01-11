<?php

class ViewPenyelenggaraanDashboardTechnician {

    public static function form_PenyelenggaraanDashboardTechncian($request) {
        global $today;

        ?>
<div class="col-md-12">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a onclick="<?php echo PenyelenggaraanDashboardTechnician::ajaxclick()?>;"
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
                            $dataall = PenyelenggaraanDashboardTechnician::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], PenyelenggaraanDashboardTechnician::ajaxclick(), array(4, 6, 2));
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
                            <th><?php echo lbl('Assigned To') ?></th>
                            <th><?php echo lbl('Status') ?></th>
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
                            <td><?php echo $fw_bil?> </td>
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
?>