<?php

class Pagg {

    public static function pagging_top($requestgrid, $totalreturned, $ajaxclick, $colsm = array(4,6,2)) {
        global $key;
        if (is_array($requestgrid)) {
            extract($requestgrid);
        }

        if (chk($fw_all) != 1) {
            if (chk($page) == chk($limit)) {
                $page = $page - 1;
            }
            ?>
            <div class="modal-header">
                <div class="col-xs-12 col-sm-<?php echo $colsm[0] ?>"> 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span >
                                <?php echo lbl('Papar') ?>
                            </span>
                        </div>
                        <select class="custom-select form-control" name="perpage" onChange="<?php echo $ajaxclick ?>">
                            <option <?php if (@$bilrow == '10') { ?> selected="selected" <?php } ?> value="10">10</option>
                            <option <?php if (@$bilrow == '100') { ?> selected="selected" <?php } ?> value="100">100</option>
                            <option <?php if (@$bilrow == '1000') { ?> selected="selected" <?php } ?> value="1000">1000</option>
                            <option <?php if (@$bilrow == '10000') { ?> selected="selected" <?php } ?> value="10000">10000</option>
                        </select>
                        <div class="input-group-addon">
                            <span>
                                <?php echo lbl('dari').' '.$totalreturned.' '.lbl('rekod'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-<?php echo $colsm[1] ?>">    
                    <div class="input-group">
                        <?php $placeholder = lbl('Carian'); ?>
                        <input type="text" name="cari" id="cari" value="<?php echo chk($cari) ?>" class="form-control" placeholder="<?php echo $placeholder ?>" onchange="<?php echo $ajaxclick ?>" onkeypress="return event.keyCode != 13;" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary" onclick="<?php echo $ajaxclick ?>" >
                                <i class="fa fa-search icon-on-right bigger-110"></i>
                                <?php echo lbl('Cari') ?>
                            </button>
                        </span>
                    </div>                               
                </div>
                <div class="col-xs-12 col-sm-<?php echo $colsm[2] ?>">    
                    <div class="input-group">
                        <div class="input-group-addon"> 
                            <span><?php echo lbl('Halaman') ?></span>
                        </div>
                        <select class="custom-select form-control" name="page" onChange="<?php echo $ajaxclick ?>">
                            <?php
                            for ($x = 0; $x < $limit; $x++) {
                                $kira = $x + 1;
                                ?>
                                <option <?php if ($kira == @$page + 1) { ?> selected="selected" <?php } ?> value="<?php echo $x ?>"><?php echo @$kira ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public static function pagging_bottom($request, $totalreturned, $divajax, $urlajax) {
        global $key;
        if (is_array($request)) {
            extract($request);
        }

        if (chk($fw_all) != 1) {
            if (chk($page) == chk($limit)) {
                $page = $page - 1;
            }

            if ($totalreturned < (@$bilrow * (@$page + 1))) {
                $hingga = $totalreturned;
            } else {
                $hingga = @$bilrow * (@$page + 1);
            }

            if ($totalreturned != 0) {
                $dari = @$bilrow * @$page + 1;
            } else {
                $dari = 0;
            }
            ?>


            <div class="modal-footer">
                <div class="col-xs-12 col-sm-9">    
                    <div class="input-group">
                        <div class="input-group-addon"> 
                            <span>Paparan <?php echo $dari; ?> hingga <?php echo @$hingga //@$bilrow*(@$page+1)    ?> daripada <?php echo $totalreturned; ?> rekod                    </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2">    
                    <div class="input-group">
                        <div class="input-group-addon"> 
                            <span>Halaman :</span>
                        </div>
                        <select class="custom-select form-control" name="page" onChange="ajaxAll(this.form, '<?php echo $divajax ?>', '<?php echo $urlajax ?>')">
                            <?php
                            for ($x = 0; $x < $limit; $x++) {
                                $kira = $x + 1;
                                ?>
                                <option <?php if ($kira == @$page + 1) { ?> selected="selected" <?php } ?> value="<?php echo $x ?>"><?php echo @$kira ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div> 

            <?php
        }
    }
    
    public static function pagging_top_tab($requestgrid, $totalreturned, $ajaxclick, $cari_tab='', $colsm = array(4,6,2)) {
        global $key;
        if (is_array($requestgrid)) {
            extract($requestgrid);
        }
        
        $requestgrid['perpage'.$cari_tab] = @$requestgrid[${'perpage'.$cari_tab}];
        $requestgrid['cari'.$cari_tab] = @$requestgrid[${'cari'.$cari_tab}];        
        
        if (chk($fw_all) != 1) {
            if (chk($page) == chk($limit)) {
                $page = $page - 1;
            }
            ?>
            <div class="modal-header">
                <div class="col-xs-12 col-sm-<?php echo $colsm[0] ?>"> 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span >
                                <?php echo lbl('Papar') ?>
                            </span>
                        </div>
                        <input type="text" name="perpage<?php echo $cari_tab ?>" id="perpage<?php echo $cari_tab ?>" value="<?php echo @$bilrow ?>" title="<?php echo @$bilrow ?>" class="form-control" onchange="<?php echo $ajaxclick ?>" />
                        <div class="input-group-addon">
                            <span>
                                <?php echo lbl('dari').' '.$totalreturned.' '.lbl('rekod'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-<?php echo $colsm[1] ?>">    
                    <div class="input-group">
                        <?php $placeholder = lbl('Carian'); ?>
                        <input type="text" name="cari<?php echo $cari_tab ?>" id="cari<?php echo $cari_tab ?>" value="<?php echo chk(${'cari'.$cari_tab}) ?>" class="form-control" placeholder="<?php echo $placeholder ?>" onchange="<?php echo $ajaxclick ?>" onkeypress="return event.keyCode != 13;" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary" onclick="<?php echo $ajaxclick ?>" >
                                <i class="fa fa-search icon-on-right bigger-110"></i>
                                <?php echo lbl('Cari') ?>
                            </button>
                        </span>
                    </div>                               
                </div>
                <div class="col-xs-12 col-sm-<?php echo $colsm[2] ?>">    
                    <div class="input-group">
                        <div class="input-group-addon"> 
                            <span><?php echo lbl('Halaman') ?></span>
                        </div>
                        <select class="custom-select form-control" name="page<?php echo $cari_tab ?>" onChange="<?php echo $ajaxclick ?>">
                            <?php
                            for ($x = 0; $x < $limit; $x++) {
                                $kira = $x + 1;
                                ?>
                                <option <?php if ($kira == @$page + 1) { ?> selected="selected" <?php } ?> value="<?php echo $x ?>"><?php echo @$kira ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}
?>