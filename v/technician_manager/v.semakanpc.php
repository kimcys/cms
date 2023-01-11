<?php

class ViewSemakanPc {

    public static function form_SemakanPc($request) {
        global $today;
        $keymenu = $_SESSION['keybefore']; // use this if want to link to other page

        $semak = FwSemak::semak(@$request['semak'], @$request['save'], @$request['update']);
        if (is_array($semak)){
            $request = array_merge($request,$semak);
            extract($request);
            extract($semak);
        }
        ?>
<div class="container-md">
    <div style="text-align: center;" class="form-group m-b-20">
        <img src="assets/img/specpc.jpg" alt="logo" width="250" height="250"
            style="vertical-align:middle; margin:auto; border-radius: 50%;">
    </div>
    <main class="main-container">
        <div class="main-title"></div>
        <?php
        $dataall = SemakanPc::sql_listgrid($request);
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
                <a href="?do=<?php echo emenu($keymenu,'m/m.semakan1')?>
                    &menu=Semakan&pcId=<?php echo $pc_id ?>" <?php echo $serialnum?>
                    class="btn btn-primary stretched-link">Check Computer</a>
            </div>
        </div>
    </main>
</div>
<?php          
        }
        }
?>