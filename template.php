<?php
require_once 'setting.php';
?>    
<!-- ================== BEGIN TEMPLATE CSS ================== -->
<?php require_once 'allcss.php'; ?>
<!-- ================== END TEMPLATE CSS ================== -->

<!-- ================== BEGIN JQUERY JS ================== -->
<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="framework/plugin/tableExportMaster/xls.core.min.js"></script>
<script type="text/javascript" src="framework/plugin/tableExportMaster/Blob.min.js"></script>
<script type="text/javascript" src="framework/plugin/tableExportMaster/FileSaver.min.js"></script>
<script type="text/javascript" src="framework/plugin/tableExportMaster/tableexport.min.js"></script>
<!-- ================== END JQUERY JS ================== -->

<!-- ================== BEGIN SEAShell JS ================== -->
<script src="framework/js/fw.js"></script>
<!-- ================== END SEAShell JS ================== -->

<!-- ================== BEGIN Angular JS ================== -->
<script src="assets/js/angular.min.js"></script>
<!-- ================== END Angular JS ================== -->
<!-- begin page-header -->
<h1 class="page-header">Template <small><a href="https://drive.google.com/open?id=0B0QiVKWsVJsMLVBYTHQ1MTJPT2c" target="_blank">Download Template</a></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Bootstrap Date Time Picker</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">
                            Default Date Time</label>
                        <div class="col-md-8">
                            <?php echo FwTemplate::datetimepicker1() ?>
                        </div>
                        <label class="control-label col-md-2" onclick="ajaxFunction('datetimepicker1', 'datetimepicker1Div', '<?php echo Db::CFAjax("FwTemplate", "datetimepicker1") ?>')">AJAX</label>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" data-clipboard-text='<?php echo FwTemplate::datetimepicker1() ?>'><i title='<?php echo FwTemplate::datetimepicker1() ?>' class="fa fa-clipboard"></i></button>
                        </div>
                        <div class="col-md-8" id="datetimepicker1Div"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Custom Format</label>
                        <div class="col-md-8">
                            <?php echo FwTemplate::datetimepicker2() ?>
                        </div>
                        <label class="control-label col-md-2" onclick="ajaxFunction('datetimepicker2', 'datetimepicker2Div', '<?php echo Db::CFAjax("FwTemplate", "datetimepicker2") ?>')">AJAX</label>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" data-clipboard-text='<?php echo FwTemplate::datetimepicker2() ?>'><i title='<?php echo FwTemplate::datetimepicker2() ?>' class="fa fa-clipboard"></i></button>
                        </div>
                        <div class="col-md-8" id="datetimepicker2Div"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Linked Pickers</label>
                        <div class="col-md-8">
                            <div class="row row-space-10">
                                <div class="col-xs-6">
                                    <input type="text" class="form-control"  id="datetimepicker3" placeholder="Min Date" />
                                </div>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" id="datetimepicker4" placeholder="Max Date" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-2">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Bootstrap Date Range Picker</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Default Date Ranges</label>
                        <div class="col-md-8">
                            <div class="input-group" id="default-daterange">
                                <input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Advance Date Ranges</label>
                        <div class="col-md-8">
                            <div id="advance-daterange" class="btn btn-white btn-block">
                                <span></span>
                                <i class="fa fa-angle-down fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Select2</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Basic Select2</label>
                        <div class="col-md-8">
                            <select class="default-select2 form-control">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Multiple Selection</label>
                        <div class="col-md-8">
                            <select class="multiple-select2 form-control" multiple="multiple">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-4">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Datepicker</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Default Datepicker</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="datepicker-default" placeholder="Select Date" value="04/1/2014" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Inline Datepicker</label>
                        <div class="col-md-8">
                            <div id="datepicker-inline"><div></div></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Auto Close Datepicker</label>
                        <div class="col-md-8">
                            <?php echo FwTemplate::datepicker_autoClose() ?>
                        </div>
                        <label class="control-label col-md-2" onclick="ajaxFunction('datepicker_autoClose', 'datepicker_autoCloseDiv', '<?php echo Db::CFAjax("FwTemplate", "datepicker_autoClose") ?>')">AJAX</label>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button" data-clipboard-text='<?php echo FwTemplate::datepicker_autoClose() ?>'><i title='<?php echo FwTemplate::datepicker_autoClose() ?>' class="fa fa-clipboard"></i></button>
                        </div>
                        <div class="col-md-8" id="datepicker_autoCloseDiv"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Disabled Past Date</label>
                        <div class="col-md-8">
                            <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
                                <input type="text" class="form-control" placeholder="Select Date" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Range Datepicker</label>
                        <div class="col-md-8">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" name="start" placeholder="Date Start" />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="form-control" name="end" placeholder="Date End" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-5">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">jQuery Autocomplete</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Autocomplete</label>
                        <div class="col-md-8">
                            <input type="text" name="" id="jquery-autocomplete" class="form-control" placeholder="Try typing 'a' or 'b'." />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-6">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Bootstrap Combobox</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Bootstrap Combobox</label>
                        <div class="col-md-8">
                            <select class="combobox">
                                <option value="">Select Location</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="CT">Connecticut</option>
                                <option value="NY">New York</option>
                                <option value="MD">Maryland</option>
                                <option value="VA">Virginia</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-7">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Select with Search</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Default</label>
                        <div class="col-md-8">
                            <p>Convert this</p>
                            <select class="form-control">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                            <p></p>
                            <p>Become this</p>
                            <select class="form-control selectpicker" data-size="10" data-live-search="true">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme White</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme Inverse</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-inverse">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme Primary</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-primary">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme Info</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-info">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme Success</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-success">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme Warning</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-warning">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Theme Danger</label>
                        <div class="col-md-8">
                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-danger">
                                <option value="" selected>Select a Country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-8">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><span class="label label-success pull-left m-r-10">NEW</span> Bootstrap Show Password</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Show / Hide Password</label>
                        <div class="col-md-8">
                            <input data-toggle="password" data-placement="after" class="form-control" type="password" value="123" placeholder="password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Show / Hide Password</label>
                        <div class="col-md-8">
                            <input data-toggle="password" data-placement="before" class="form-control" type="password" value="123" placeholder="password" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-9">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Password Indicator</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password" id="password-indicator-default" class="form-control m-b-5" />
                            <div id="passwordStrengthDiv" class="is0 m-t-5"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Visible Password</label>
                        <div class="col-md-8">
                            <input type="text" name="password-visible" id="password-indicator-visible" class="form-control m-b-5" />
                            <div id="passwordStrengthDiv2" class="is0 m-t-5"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-10">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><span class="label label-success pull-left m-r-10">NEW</span> Bootstrap Color Palette</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Color Palette Dropdown</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input class="form-control" name="color_palatte_1" data-id="color-palette-1" />
                                <div class="input-group-btn">
                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tint"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><div id="color-palette-1"></div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Custom Color Palette</label>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" name="color_palatte_custom" data-id="color-palette-custom" />
                                </div>
                                <div class="col-md-6">
                                    <div id="color-palette-custom" class="m-t-5 p-t-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-11">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><span class="label label-success pull-left m-r-10">NEW</span> jQuery Simple Colorpicker</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Basic Usage</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <select name="jquery-simplecolorpicker">
                                    <option value="#7bd148">Green</option>
                                    <option value="#5484ed">Bold blue</option>
                                    <option value="#a4bdfc">Blue</option>
                                    <option value="#46d6db">Turquoise</option>
                                    <option value="#7ae7bf">Light green</option>
                                    <option value="#51b749">Bold green</option>
                                    <option value="#fbd75b">Yellow</option>
                                    <option value="#ffb878">Orange</option>
                                    <option value="#ff887c">Red</option>
                                    <option value="#dc2127">Bold red</option>
                                    <option value="#dbadff">Purple</option>
                                    <option value="#e1e1e1">Gray</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">FontAwesome Theme</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <select name="jquery-simplecolorpicker-fa">
                                    <option value="#7bd148">Green</option>
                                    <option value="#5484ed">Bold blue</option>
                                    <option value="#a4bdfc">Blue</option>
                                    <option value="#46d6db">Turquoise</option>
                                    <option value="#7ae7bf">Light green</option>
                                    <option value="#51b749">Bold green</option>
                                    <option value="#fbd75b">Yellow</option>
                                    <option value="#ffb878">Orange</option>
                                    <option value="#ff887c">Red</option>
                                    <option value="#dc2127">Bold red</option>
                                    <option value="#dbadff">Purple</option>
                                    <option value="#e1e1e1">Gray</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Dropdown Selection</label>
                        <div class="col-md-8">
                            <div class="input-group m-t-5 m-b-5">
                                <select name="colorpicker-picker-longlist">
                                    <option value="#ac725e">#ac725e</option>
                                    <option value="#d06b64">#d06b64</option>
                                    <option value="#f83a22">#f83a22</option>
                                    <option value="#fa573c">#fa573c</option>
                                    <option value="#ff7537">#ff7537</option>
                                    <option value="#ffad46">#ffad46</option>
                                    <option value="#42d692">#42d692</option>
                                    <option value="#16a765">#16a765</option>
                                    <option value="#7bd148">#7bd148</option>
                                    <option value="#b3dc6c">#b3dc6c</option>
                                    <option value="#fbe983">#fbe983</option>
                                    <option value="#fad165">#fad165</option>
                                    <option value="#92e1c0">#92e1c0</option>
                                    <option value="#9fe1e7">#9fe1e7</option>
                                    <option value="#9fc6e7">#9fc6e7</option>
                                    <option value="#4986e7">#4986e7</option>
                                    <option value="#9a9cff">#9a9cff</option>
                                    <option value="#b99aff">#b99aff</option>
                                    <option value="#c2c2c2">#c2c2c2</option>
                                    <option value="#cabdbf">#cabdbf</option>
                                    <option value="#cca6ac">#cca6ac</option>
                                    <option value="#f691b2">#f691b2</option>
                                    <option value="#cd74e6">#cd74e6</option>
                                    <option value="#a47ae2">#a47ae2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-12">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Colopicker & Timepicker</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Default Color Picker</label>
                        <div class="col-md-8">
                            <input type="text" value="#3498db" class="form-control" id="colorpicker" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Prepend Color Picker</label>
                        <div class="col-md-8">
                            <div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-prepend">
                                <input type="text" value="rgb(0, 0, 0)" readonly="" class="form-control" />
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">RGBA Color format</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="rgb(155,89,182,0.8)" id="colorpicker-rgba" data-color-format="rgba" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Default timepicker</label>
                        <div class="col-md-8">
                            <div class="input-group bootstrap-timepicker">
                                <input id="timepicker" type="text" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-13">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Ion Range Slider</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Default</label>
                        <div class="col-md-8">
                            <input type="text" id="default_rangeSlider" name="default_rangeSlider" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Custom Range</label>
                        <div class="col-md-8">
                            <input type="text" id="customRange_rangeSlider" name="default_rangeSlider" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Custom Values</label>
                        <div class="col-md-8">
                            <input type="text" id="customValue_rangeSlider" name="default_rangeSlider" value="" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-14">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Masked Input</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Date</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="masked-input-date" placeholder="dd/mm/yyyy" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Phone</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="masked-input-phone" placeholder="(999) 999-9999" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Tax ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="masked-input-tid" placeholder="99-9999999" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Product Key</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="masked-input-pkey" placeholder="a*-999-a999" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">SSN</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="masked-input-ssn" placeholder="999/99/9999" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">SSN</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="masked-input-pno" placeholder="AAA-9999-A" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-15">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">jQuery Tag It</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Default Tags Input with Autocomplete</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-default">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                            <p>Try to enter "c++, java, php" </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Inverse Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-inverse" class="inverse">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">White Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-white" class="white">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Primary Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-primary" class="primary">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Info Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-info" class="info">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Success Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-success" class="success">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Warning Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-warning" class="warning">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Danger Theme</label>
                        <div class="col-md-8">
                            <ul id="jquery-tagIt-danger" class="danger">
                                <li>Tag1</li>
                                <li>Tag2</li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-16">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><span class="label label-success pull-left m-r-10">NEW</span> Clipboard.js</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Default</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input id="clipboard-default" type="text" class="form-control" value="https://github.com/zenorocha/clipboard.js.git" />
                                <span class="input-group-btn">
                                    <button class="btn btn-inverse" type="button" data-clipboard-target="#clipboard-default"><i class="fa fa-clipboard"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Cut to copy</label>
                        <div class="col-md-8">
                            <textarea class="form-control m-b-10" id="clipboard-textarea" rows="7">Mussum ipsum cacilds...</textarea>
                            <button class="btn btn-inverse btn-sm" type="button" data-clipboard-target="#clipboard-textarea" data-clipboard-action="cut">Cut to clipboard</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">without Form</label>
                        <div class="col-md-8">
                            <button class="btn btn-inverse btn-sm" type="button" data-clipboard-text="Just because you can doesn't mean you should — clipboard.js">Click to copy</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Input Types</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Default Input</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Default input" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Disabled Input</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Disabled input" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select</label>
                        <div class="col-md-9">
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Select (multiple)</label>
                        <div class="col-md-9">
                            <select multiple class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Textarea</label>
                        <div class="col-md-9">
                            <textarea class="form-control" placeholder="Textarea" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Checkbox</label>
                        <div class="col-md-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" />
                                    Checkbox Label 1
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" />
                                    Checkbox Label 2
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Inline Checkbox</label>
                        <div class="col-md-9">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="" />
                                Checkbox Label 1
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value="" />
                                Checkbox Label 2
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Radio Button</label>
                        <div class="col-md-9">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="option1" checked />
                                    Radio option 1
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="option2" />
                                    Radio option 2
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Inline Radio Button</label>
                        <div class="col-md-9">
                            <label class="radio-inline">
                                <input type="radio" name="optionsRadios" value="option1" checked />
                                Radio option 1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optionsRadios" value="option2" />
                                Radio option 2
                            </label>
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-md-3 control-label">Input with Success</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" />
                            <span class="fa fa-check form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-warning has-feedback">
                        <label class="col-md-3 control-label">Input with Warning</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" />
                            <span class="fa fa-warning form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-error has-feedback">
                        <label class="col-md-3 control-label">Input with Error</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" />
                            <span class="fa fa-times form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Submit</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Submit Button</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">
    <!-- begin col-10 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">DataTable - Buttons</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td>Trident</td>
                            <td>Internet Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td>4</td>
                            <td>X</td>
                        </tr>
                        <tr class="even gradeC">
                            <td>Trident</td>
                            <td>Internet Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td>5</td>
                            <td>C</td>
                        </tr>
                        <tr class="odd gradeA">
                            <td>Trident</td>
                            <td>Internet Explorer 5.5</td>
                            <td>Win 95+</td>
                            <td>5.5</td>
                            <td>A</td>
                        </tr>
                        <tr class="even gradeA">
                            <td>Trident</td>
                            <td>Internet Explorer 6</td>
                            <td>Win 98+</td>
                            <td>6</td>
                            <td>A</td>
                        </tr>
                        <tr class="odd gradeA">
                            <td>Trident</td>
                            <td>Internet Explorer 7</td>
                            <td>Win XP SP2+</td>
                            <td>7</td>
                            <td>A</td>
                        </tr>
                        <tr class="even gradeA">
                            <td>Trident</td>
                            <td>AOL browser (AOL desktop)</td>
                            <td>Win XP</td>
                            <td>6</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Firefox 1.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.7</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Firefox 1.5</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Firefox 2.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Firefox 3.0</td>
                            <td>Win 2k+ / OSX.3+</td>
                            <td>1.9</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Camino 1.0</td>
                            <td>OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Camino 1.5</td>
                            <td>OSX.3+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Netscape 7.2</td>
                            <td>Win 95+ / Mac OS 8.6-9.2</td>
                            <td>1.7</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Netscape Browser 8</td>
                            <td>Win 98SE+</td>
                            <td>1.7</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Netscape Navigator 9</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.0</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.1</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.1</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.2</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.2</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.3</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.3</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.4</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.4</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.5</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.5</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.6</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.6</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.7</td>
                            <td>Win 98+ / OSX.1+</td>
                            <td>1.7</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Mozilla 1.8</td>
                            <td>Win 98+ / OSX.1+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Seamonkey 1.1</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Gecko</td>
                            <td>Epiphany 2.20</td>
                            <td>Gnome</td>
                            <td>1.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>Safari 1.2</td>
                            <td>OSX.3</td>
                            <td>125.5</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>Safari 1.3</td>
                            <td>OSX.3</td>
                            <td>312.8</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>Safari 2.0</td>
                            <td>OSX.4+</td>
                            <td>419.3</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>Safari 3.0</td>
                            <td>OSX.4+</td>
                            <td>522.1</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>OmniWeb 5.5</td>
                            <td>OSX.4+</td>
                            <td>420</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>iPod Touch / iPhone</td>
                            <td>iPod</td>
                            <td>420.1</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Webkit</td>
                            <td>S60</td>
                            <td>S60</td>
                            <td>413</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 7.0</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 7.5</td>
                            <td>Win 95+ / OSX.2+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 8.0</td>
                            <td>Win 95+ / OSX.2+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 8.5</td>
                            <td>Win 95+ / OSX.2+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 9.0</td>
                            <td>Win 95+ / OSX.3+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 9.2</td>
                            <td>Win 88+ / OSX.3+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera 9.5</td>
                            <td>Win 88+ / OSX.3+</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Opera for Wii</td>
                            <td>Wii</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Nokia N800</td>
                            <td>N800</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Presto</td>
                            <td>Nintendo DS browser</td>
                            <td>Nintendo DS</td>
                            <td>8.5</td>
                            <td>C/A<sup>1</sup></td>
                        </tr>
                        <tr class="gradeC">
                            <td>KHTML</td>
                            <td>Konqureror 3.1</td>
                            <td>KDE 3.1</td>
                            <td>3.1</td>
                            <td>C</td>
                        </tr>
                        <tr class="gradeA">
                            <td>KHTML</td>
                            <td>Konqureror 3.3</td>
                            <td>KDE 3.3</td>
                            <td>3.3</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeA">
                            <td>KHTML</td>
                            <td>Konqureror 3.5</td>
                            <td>KDE 3.5</td>
                            <td>3.5</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Tasman</td>
                            <td>Internet Explorer 4.5</td>
                            <td>Mac OS 8-9</td>
                            <td>-</td>
                            <td>X</td>
                        </tr>
                        <tr class="gradeC">
                            <td>Tasman</td>
                            <td>Internet Explorer 5.1</td>
                            <td>Mac OS 7.6-9</td>
                            <td>1</td>
                            <td>C</td>
                        </tr>
                        <tr class="gradeC">
                            <td>Tasman</td>
                            <td>Internet Explorer 5.2</td>
                            <td>Mac OS 8-X</td>
                            <td>1</td>
                            <td>C</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Misc</td>
                            <td>NetFront 3.1</td>
                            <td>Embedded devices</td>
                            <td>-</td>
                            <td>C</td>
                        </tr>
                        <tr class="gradeA">
                            <td>Misc</td>
                            <td>NetFront 3.4</td>
                            <td>Embedded devices</td>
                            <td>-</td>
                            <td>A</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Misc</td>
                            <td>Dillo 0.8</td>
                            <td>Embedded devices</td>
                            <td>-</td>
                            <td>X</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Misc</td>
                            <td>Links</td>
                            <td>Text only</td>
                            <td>-</td>
                            <td>X</td>
                        </tr>
                        <tr class="gradeX">
                            <td>Misc</td>
                            <td>Lynx</td>
                            <td>Text only</td>
                            <td>-</td>
                            <td>X</td>
                        </tr>
                        <tr class="gradeC">
                            <td>Misc</td>
                            <td>IE Mobile</td>
                            <td>Windows Mobile 6</td>
                            <td>-</td>
                            <td>C</td>
                        </tr>
                        <tr class="gradeC">
                            <td>Misc</td>
                            <td>PSP browser</td>
                            <td>PSP</td>
                            <td>-</td>
                            <td>C</td>
                        </tr>
                        <tr class="gradeU">
                            <td>Other browsers</td>
                            <td>All others</td>
                            <td>-</td>
                            <td>-</td>
                            <td>U</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Gritter Notifications</h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Demo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Add default notification.</td>
                            <td><a href="javascript:;" id="add-regular" class="btn btn-sm btn-inverse">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Add sticky notification</td>
                            <td><a href="javascript:;" id="add-sticky" class="btn btn-sm btn-primary">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Add notification without image</td>
                            <td><a href="javascript:;" id="add-without-image" class="btn btn-sm btn-info">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Add a white notification</td>
                            <td><a href="javascript:;" id="add-gritter-light" class="btn btn-sm btn-success">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Add notification (with callbacks)</td>
                            <td><a href="javascript:;" id="add-with-callbacks" class="btn btn-sm btn-warning">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Add a sticky notification (with callbacks)</td>
                            <td><a href="javascript:;" id="add-sticky-with-callbacks" class="btn btn-sm btn-danger">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Add notification with max of 3</td>
                            <td><a href="javascript:;" id="add-max" class="btn btn-sm btn-default">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Remove all notifications</td>
                            <td><a href="javascript:;" id="remove-all" class="btn btn-sm btn-white">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Remove all notifications (with callbacks)</td>
                            <td><a href="javascript:;" id="remove-all-with-callbacks" class="btn btn-sm btn-white">Demo</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col-6 -->

    <!-- begin col-6 -->
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Modal</h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Demo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Default Modal Dialog Box.</td>
                            <td><a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Modal Dialog Box with fade out animation.</td>
                            <td><a href="#modal-without-animation" class="btn btn-sm btn-default" data-toggle="modal">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Modal Dialog Box with full width white background.</td>
                            <td><a href="#modal-message" class="btn btn-sm btn-primary" data-toggle="modal">Demo</a></td>
                        </tr>
                        <tr>
                            <td>Modal Dialog Box with alert message.</td>
                            <td><a href="#modal-alert" class="btn btn-sm btn-danger" data-toggle="modal">Demo</a></td>
                        </tr>
                    </tbody>
                </table>
                <!-- #modal-dialog -->
                <div class="modal fade" id="modal-dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Modal Dialog</h4>
                            </div>
                            <div class="modal-body">
                                Modal body content here...
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                                <a href="javascript:;" class="btn btn-sm btn-success">Action</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #modal-without-animation -->
                <div class="modal" id="modal-without-animation">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Modal Without Animation</h4>
                            </div>
                            <div class="modal-body">
                                Modal body content here...
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #modal-message -->
                <div class="modal modal-message fade" id="modal-message">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Modal Message Header</h4>
                            </div>
                            <div class="modal-body">
                                <p>Text in a modal</p>
                                <p>Do you want to turn on location services so GPS can use your location ?</p>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                                <a href="javascript:;" class="btn btn-sm btn-primary">Save Changes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #modal-alert -->
                <div class="modal fade" id="modal-alert">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Alert Header</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger m-b-0">
                                    <h4><i class="fa fa-info-circle"></i> Alert Header</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                                <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Action</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Bootstrap SweetAlert <span class="label label-success">NEW</span></h4>
            </div>
            <div class="panel-body">
                <p class="lead m-b-10 text-inverse">
                    SweetAlert for Bootstrap. A beautiful replacement for JavaScript's "alert"
                </p>
                <hr />
                <p class="">
                    Try any of those!
                </p>
                <a href="#" data-click="swal-primary" class="btn btn-primary">Primary</a>
                <a href="#" data-click="swal-info" class="btn btn-info">Info</a>
                <a href="#" data-click="swal-success" class="btn btn-success">Success</a>
                <a href="#" data-click="swal-warning" class="btn btn-warning">Warning</a>
                <a href="#" data-click="swal-danger" class="btn btn-danger">Danger</a>
            </div>
        </div>
    </div>
    <!-- end col-6 -->
</div>
<!-- end row -->
<!-- ================== BEGIN TEMPLATE JS ================== -->
<?php require_once 'alljs.php'; ?>
<!-- ================== END TEMPLATE JS ================== -->