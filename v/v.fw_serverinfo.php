<?php

class ViewServerInfo {

    public static function list_audit_trail($request) {
        ?>
        <div class="table-responsive">
            <?php
            $dataall = FwServerInfo::sql_listgrid($request);
            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], FwServerInfo::ajaxclick(), array(4, 6, 2));
            if (is_array($dataall)) {
                extract($dataall);
            }
            ?>
            <table class="table table-hover">
                <thead>                    
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">userx</th>
                        <th width="55%">sqlx</th>
                        <th width="30%">tkhmasa</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <?php
                if (is_array($fw_senarai)) {
                    foreach ($fw_senarai as $r => $v) {
                        if (is_array($v)) {
                            extract($v);
                            ?>
                            <tr>
                                <td><?php echo $fw_bil ?></td>
                                <td><?php echo pr(json_decode(@$userx, true)); ?></td>
                                <td><?php echo @$sqlx ?></td>
                                <td><?php echo tkhmasa(@$tkhmasa) ?></td>
                            </tr>    
                            <?php
                        }
                    }
                }
                ?>
            </table>
        </div>    
        <?php
    }

}
