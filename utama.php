<?php
//pr($_SESSION[$GLOBALS['fw_sistem']]);
if ($_SESSION[$GLOBALS['fw_sistem']]['peranan']=='1'||$_SESSION[$GLOBALS['fw_sistem']]['peranan']=='4' ){

    $keymenu = $_SESSION['keybefore'];

    ?>
<?php
$new = Db::chkval('maintenance',"COUNT(pc_id)","status='1'");
$pending = Db::chkval('maintenance',"COUNT(pc_id)","status='2'");
$overdue = Db::chkval('maintenance',"COUNT(pc_id)","status='3'");
$completed = Db::chkval('maintenance',"COUNT(pc_id)","status='4'");

$dataPoints = array( 
	array("y" => $new,"label" => "New" ),
	array("y" => $pending,"label" => "Pending" ),
	array("y" => $overdue,"label" => "Overdue" ),
	array("y" => $completed,"label" => "Completed" ),
);

$diet = Db::chkval('pc',"COUNT(pc_id)","dept_id='3'");
$farmasi = Db::chkval('pc',"COUNT(pc_id)","dept_id='4'");
$ict = Db::chkval('pc',"COUNT(pc_id)","dept_id='1'");
$medic = Db::chkval('pc',"COUNT(pc_id)","dept_id='6'");
$osh = Db::chkval('pc',"COUNT(pc_id)","dept_id='5'");
$vet = Db::chkval('pc',"COUNT(pc_id)","dept_id='2'");

$dataPoints2 = array( 
	array("y" => $diet,"label" => "DIETETIC" ),
	array("y" => $farmasi,"label" => "PHARMACY" ),
	array("y" => $medic,"label" => "MEDIC" ),
	array("y" => $ict,"label" => "ICT" ),
    array("y" => $osh,"label" => "OSH" ),
	array("y" => $vet,"label" => "VET" ),
);

?>

<script type="text/javascript">
window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {},
        axisY: {
            includeZero: true,
        },
        data: [{
            type: "bar",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

}
</script>

<script type="text/javascript">
window.onload = function() {

    var chart2 = new CanvasJS.Chart("cc2", {
        animationEnabled: true,
        title: {},
        axisY: {
            includeZero: true,
        },
        data: [{
            type: "bar",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart2.render();

}
</script>

<main class="main-container">
    <div class="main-title">
        <h1 class="font-weight-bold">DASHBOARD</h1>
    </div>

    <div class="main-cards">

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">NEW</p>
                <span class="material-icons-outlined text-blue">add_circle</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $new ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>&status=1"
                class="btn btn-primary stretched-link">New Computer List</a>
        </div>
        <div class="card">
            <div class="card-inner">
                <p class="text-primary">PENDING</p>
                <span class="material-icons-outlined text-orange">timelapse</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $pending ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>&status=2>"
                class="btn btn-warning stretched-link">Pending Computer List</a>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">OVERDUE</p>
                <span class="material-icons-outlined text-red">running_with_errors</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $overdue ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>&status=3"
                class="btn btn-danger stretched-link">Overdue Computer List</a>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">COMPLETED</p>
                <span class="material-icons-outlined text-green">check_circle</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $completed ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>&status=4"
                class="btn btn-success stretched-link">Completed Computer List</a>
        </div>
    </div>


    <div class="charts">
        <div class="charts-card">
            <p class="chart-title">Department</p>
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">DIETETIC</p>
                    <span class="material-icons-outlined text-blue">fitness_center</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $diet ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=3"
                    class="btn btn-warning stretched-link">View Dietetic List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">PHARMACY</p>
                    <span class="material-icons-outlined text-orange">local_pharmacy</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $farmasi ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=4"
                    class="btn btn-danger stretched-link">View Pharmacy List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">MEDIC</p>
                    <span class="material-icons-outlined text-red">medical_services</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $medic ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=6"
                    class="btn btn-success stretched-link">View Medic List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">ICT</p>
                    <span class="material-icons-outlined text-green">computer</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $ict ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=1"
                    class="btn btn-primary stretched-link">View ICT List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">OSH</p>
                    <span class="material-icons-outlined text-green">health_and_safety</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $osh ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=5"
                    class="btn btn-danger stretched-link">View OSH List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">VET</p>
                    <span class="material-icons-outlined text-green">pets</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $vet ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=2"
                    class="btn btn-info stretched-link">View Vet List</a>
            </div>
        </div>

        <div class="charts-card">
            <p class="chart-title">Number of PC</p>
            <div id="cc2" style="height: 90%; width: 90%;"></div>
        </div>
    </div>
</main>
<?php
}

elseif ($_SESSION[$GLOBALS['fw_sistem']]['peranan']=='2') {
   
    $keymenu = $_SESSION['keybefore'];

    ?>
<?php
$new = Db::chkval('maintenance',"COUNT(pc_id)","status='1' AND assigned_to={$_SESSION[$GLOBALS['fw_sistem']]['u_id']}");
$pending = Db::chkval('maintenance',"COUNT(pc_id)","status='2' AND assigned_to={$_SESSION[$GLOBALS['fw_sistem']]['u_id']}");
$overdue = Db::chkval('maintenance',"COUNT(pc_id)","status='3' AND assigned_to={$_SESSION[$GLOBALS['fw_sistem']]['u_id']}");
$completed = Db::chkval('maintenance',"COUNT(pc_id)","status='4' AND assigned_to={$_SESSION[$GLOBALS['fw_sistem']]['u_id']}");

$dataPoints = array( 
	array("y" => $new,"label" => "New" ),
	array("y" => $pending,"label" => "Pending" ),
	array("y" => $overdue,"label" => "Overdue" ),
	array("y" => $completed,"label" => "Completed" ),
);

$diet = Db::chkval('pc',"COUNT(pc_id)","dept_id='3'");
$farmasi = Db::chkval('pc',"COUNT(pc_id)","dept_id='4'");
$ict = Db::chkval('pc',"COUNT(pc_id)","dept_id='1'");
$medic = Db::chkval('pc',"COUNT(pc_id)","dept_id='6'");
$osh = Db::chkval('pc',"COUNT(pc_id)","dept_id='5'");
$vet = Db::chkval('pc',"COUNT(pc_id)","dept_id='2'");

$dataPoints2 = array( 
	array("y" => $diet,"label" => "DIETETIC" ),
	array("y" => $farmasi,"label" => "PHARMACY" ),
	array("y" => $medic,"label" => "MEDIC" ),
	array("y" => $ict,"label" => "ICT" ),
    array("y" => $osh,"label" => "OSH" ),
	array("y" => $vet,"label" => "VET" ),
);

?>

<script type="text/javascript">
window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {},
        axisY: {
            includeZero: true,
        },
        data: [{
            type: "bar",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

}
</script>

<script type="text/javascript">
window.onload = function() {

    var chart2 = new CanvasJS.Chart("cc2", {
        animationEnabled: true,
        title: {},
        axisY: {
            includeZero: true,
        },
        data: [{
            type: "bar",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart2.render();

}
</script>

<main class="main-container">
    <div class="main-title">
        <h1 class="font-weight-bold">My Work</h1>
    </div>

    <div class="main-cards">

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">NEW</p>
                <span class="material-icons-outlined text-blue">add_circle</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $new ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>
            &status=1 AND assigned_to=<?php {$_SESSION[$GLOBALS['fw_sistem']]['u_id'];}?>"
                class="btn btn-primary stretched-link">New Computer List</a>
        </div>
        <div class="card">
            <div class="card-inner">
                <p class="text-primary">PENDING</p>
                <span class="material-icons-outlined text-orange">timelapse</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $pending ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>
            &status=2 AND assigned_to=<?php {$_SESSION[$GLOBALS['fw_sistem']]['u_id'];}?>"
                class="btn btn-warning stretched-link">Pending Computer List</a>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">OVERDUE</p>
                <span class="material-icons-outlined text-red">running_with_errors</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $overdue ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>
            &status=3 AND assigned_to=<?php {$_SESSION[$GLOBALS['fw_sistem']]['u_id'];}?>"
                class="btn btn-danger stretched-link">Overdue Computer List</a>
        </div>

        <div class="card">
            <div class="card-inner">
                <p class="text-primary">COMPLETED</p>
                <span class="material-icons-outlined text-green">check_circle</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $completed ?></span>
            <a href="?do=<?php echo emenu($keymenu, 'm/m.penyelenggaraandashboard') ?>
            &status=4&AND assigned_to=<?php {$_SESSION[$GLOBALS['fw_sistem']]['u_id'];}?>"
                class="btn btn-success stretched-link">Completed Computer List</a>
        </div>
    </div>


    <div class="charts">
        <div class="charts-card">
            <p class="chart-title">Department</p>
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">DIETETIC</p>
                    <span class="material-icons-outlined text-blue">fitness_center</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $diet ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=3"
                    class="btn btn-warning stretched-link">View Dietetic List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">PHARMACY</p>
                    <span class="material-icons-outlined text-orange">local_pharmacy</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $farmasi ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=4"
                    class="btn btn-danger stretched-link">View Pharmacy List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">MEDIC</p>
                    <span class="material-icons-outlined text-red">medical_services</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $medic ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=6"
                    class="btn btn-success stretched-link">View Medic List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">ICT</p>
                    <span class="material-icons-outlined text-green">computer</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $ict ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=1"
                    class="btn btn-primary stretched-link">View ICT List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">OSH</p>
                    <span class="material-icons-outlined text-green">health_and_safety</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $osh ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=5"
                    class="btn btn-danger stretched-link">View OSH List</a>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">VET</p>
                    <span class="material-icons-outlined text-green">pets</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $vet ?></span>
                <a href="?do=<?php echo emenu($keymenu, 'm/m.pcdashboards') ?>&deptId=2"
                    class="btn btn-info stretched-link">View Vet List</a>
            </div>
        </div>

        <div class="charts-card">
            <p class="chart-title">Number of PC</p>
            <div id="cc2" style="height: 90%; width: 90%;"></div>
        </div>
    </div>
</main>
<?php
}

elseif ($_SESSION[$GLOBALS['fw_sistem']]['peranan']=='3') {
    ?>
<div class="col-md-12">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a onclick="<?php echo PenyelenggaraanStaff::ajaxclick()?>;"
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
                            $dataall = PenyelenggaraanStaffDashboard::sql_listgrid($request);
                            Pagg::pagging_top(@$dataall['requestgrid'], @$dataall['totalreturned'], PenyelenggaraanStaffDashboard::ajaxclick(), array(4, 6, 2));
                            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo lbl('No.') ?></th>
                            <th><?php echo lbl('Serial Number') ?></th>
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
                                        ?>
                        <tr>
                            <td><?php echo $fw_bil ?></td>
                            <td><?php echo Db::chkval('pc','serialnum',"pc_id='$pc_id'")?></td>
                            <td><?php echo $start_date ?></td>
                            <td><?php echo $end_date ?></td>
                            <td><?php echo  Db::chkval('users','u_name',"u_id='$assigned_to'")?></td>
                            <td><?php echo  Db::chkval('status','status',"s_id='$status'")?></td>
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
    ?>