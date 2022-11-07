<?php

class ViewFwChgUser {

    public static function borang($request) {
        ?>
        <div class="col-md-12">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-5" data-init="true">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title"><?php echo lbl('Switch User') ?></h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php
                        $placeholder = lbl('Email address');
                        ?>
                        <input type="text" name="username" class="form-control" placeholder="<?php echo $placeholder ?>">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary m-r-5"><?php echo lbl('Login') ?></button>
                </div>
            </div>
        </div>
        <?php
    }

}
