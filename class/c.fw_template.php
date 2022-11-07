<?php

class FwTemplate {

    public static function datetimepicker1() {
        ?>
        <div class="input-group date datetimepicker1">
            <input type="text" class="form-control datetimepicker1" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>    
        <?php
    }

    public static function datetimepicker2() {
        ?>
        <div class="input-group date datetimepicker2">
            <input type="text" class="form-control datetimepicker2" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>   
        <?php
    }
    
    public static function datepicker_autoClose() {
        ?>
        <div class="input-group date datepicker-autoClose">
            <input type="text" class="form-control datepicker-autoClose" />
            <span class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </span>
        </div>   
        <?php
    }

}
?>