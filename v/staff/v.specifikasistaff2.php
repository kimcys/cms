<?php

class ViewSpesifikasiStaff2 {

    public static function form_SpesifikasiStaff2($request) {               
?>
<div class="container-md">
    <div style="text-align: center;" class="form-group m-b-20">
        <img src="assets/img/girlcomputer.gif" alt="logo" width="250" height="250"
            style="vertical-align:middle; margin:auto; border-radius: 50%;">
    </div>
    <main class="main-container">
        <div class="main-title"></div>
        <?php
        $dataall = SpesifikasiStaff2::sql_listgrid($request);
        foreach ($dataall['fw_senarai'] AS $row => $value) {
            extract($value);}
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
    </main>
</div>
<?php          
        }
        }
?>