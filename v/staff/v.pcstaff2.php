<?php
class ViewPcStaff2 {

    public static function form_PcStaff2($request) {
        
?>
<div class="container-md">
    <div style="text-align: center;" class="form-group m-b-20">
        <img src="assets/img/pcicon.jpg" alt="logo" width="250" height="250"
            style="vertical-align:middle; margin:auto; border-radius: 50%;">
    </div>
    <main class="main-container">
        <div class="main-title"></div>
        <?php
        $dataall = Pcstaff2::sql_listgrid($request);
        foreach ($dataall['fw_senarai'] AS $row => $value) {
            extract($value);}
            ?>
        <div class="main-cards">
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">Serial Number</p>
                    <span class="material-icons-outlined text-blue">123</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $serialnum?></span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">PC Owner</p>
                    <span class="material-icons-outlined text-red">account_circle</span>
                </div>
                <span
                    class="text-primary font-weight-bold"><?php echo Db::chkval('users','u_name',"u_id='$u_id'")?></span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">Department</p>
                    <span class="material-icons-outlined text-orange">diversity_1</span>
                </div>
                <span
                    class="text-primary font-weight-bold"><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'")?></span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">Block</p>
                    <span class="material-icons-outlined text-red">home</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $block?></span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">level</p>
                    <span class="material-icons-outlined text-green">trending_up</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $level?></span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">Wing</p>
                    <span class="material-icons-outlined text-blue">turn_slight_right</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $wing?></span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">Room</p>
                    <span class="material-icons-outlined text-orange">meeting_room</span>
                </div>
                <span class="text-primary font-weight-bold"><?php echo $room?></span>
            </div>

        </div>

</div>
</main>
</div>
<?php
            
        }
        }
?>