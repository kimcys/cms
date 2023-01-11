<?php

class ViewPcDashboards {

    public static function form_PcDashboards($request) {
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
                <a onclick="<?php echo PcDashboards::ajaxclick()?>;" class="btn btn-xs btn-icon btn-circle btn-success"
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
                            $dataall = PcDashboards::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], PcDashboards::ajaxclick(), array(4, 6, 2));
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
                            <?php
                                                {
                                                    ?>
                            <td><?php echo $fw_bil ?></td>
                            <td>
                                <!-- link to another page -->
                                <a
                                    href="?do=<?php echo emenu($keymenu, 'm/m.specifikasi') ?>&menu=PC&pcId=<?php echo $pc_id ?>">
                                    <?php echo $serialnum  ?>
                                </a>
                            </td>
                            <td><?php echo $fw_bil?> </td>
                            <td><?php echo Db::chkval('users','u_name',"u_id='$u_id'")?></td>
                            <td><?php echo Db::chkval('location','block',"block='$block'") ?></td>
                            <td><?php echo Db::chkval('location','level',"level='$level'") ?></td>
                            <td><?php echo Db::chkval('location','wing',"wing='$wing'") ?></td>
                            <td><?php echo Db::chkval('location','room',"room='$room'") ?></td>
                            <td><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'") ?></td>
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
}