<?php

class ViewFwFunc {

    public static function senarai() {
        ?>
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title="" data-init="true"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo lbl('Function Framework') ?></h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php
                    $class_methods = get_class_methods('FwFunc');

                    foreach ($class_methods as $nama_func) {
                        ?>
                        <div class="col-md-12">
                            <div class="note note-success">
                                <div class="alert alert-warning fade in m-b-15">
                                    <button class="btn btn-primary btn-default" type="button" data-clipboard-text='<?php echo FwFunc::{$nama_func}(4) ?>'><i title='<?php echo addslashes(FwFunc::{$nama_func}(3)) ?>' class="fa fa-clipboard"></i></button> 
                                    <b><?php echo FwFunc::{$nama_func}(1); ?></b>
                                </div>
                                <div class="alert alert-info fade in m-b-15">
                                    <strong>Return : </strong>
                                    <?php echo FwFunc::{$nama_func}(2); ?>
                                </div>
                                <div class="alert alert-danger fade in m-b-15">
                                    <strong>Info : </strong>
                                    <?php echo FwFunc::{$nama_func}(3); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>    
        <?php
    }

}
