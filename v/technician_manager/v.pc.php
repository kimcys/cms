<?php

class ViewPc {

    public static function form_Pc($request) {
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
        <img src="assets/img/specpc.gif" alt="logo" width="250" height="250"
            style="vertical-align:middle; margin:auto; border-radius: 50%;">
    </div>
    <main class="main-container">
        <div class="main-cards">
            <?php
             $dataall = Pc::sql_listgrid($request);
            foreach ($dataall['fw_senarai'] AS $row => $value) {
            extract($value);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">Department</p>
                            <span class="material-icons-outlined text-blue">computer</span>
                        </div>
                        <p class="text-primary"><?php echo Db::chkval('department','dept_name',"dept_id='$dept_id'")?>
                        </p>

                        <a href="?do=<?php echo emenu($keymenu, 'm/m.pc2') ?>&menu=PC&deptId=<?php echo $dept_id ?>"
                            <?php echo $dept_name  ?> class="btn btn-primary stretched-link">Check Computer</a>
                        </a>
                    </div>
                </div>
            </div>
            <?php 
             } 
             ?>
        </div>
    </main>

</div>
<?php         
    }
        }
?>