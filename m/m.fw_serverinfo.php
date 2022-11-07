<div id="wizard">
    <ol>
        <li>
            <?php echo lbl('PHP Info') ?> 
            <small><?php echo lbl('Info berkaitan server dan info apache') ?>.</small>
        </li>
        <li>
            <?php echo lbl('Log Error') ?> 
            <small><?php echo lbl('Senarai log error pada server') ?>.</small>
        </li>
        <li>
            <?php echo lbl('Audit Trail') ?> 
            <small><?php echo lbl('Paparan pemantauan audit trail') ?>.</small>
        </li>
        <li>
            <?php echo lbl('Pangkalan Data') ?> 
            <small><?php echo lbl('Info berkaitan pangkalan data yang terlibat') ?>.</small>
        </li>
    </ol>
    <!-- begin wizard step-1 -->
    <div>
        <fieldset>
            <legend class="pull-left width-full"><?php echo lbl('PHP Info') ?> </legend>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <iframe width="100%" height="400" src="framework/phpinfo.php"></iframe>
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </fieldset>
    </div>
    <!-- end wizard step-1 -->
    <!-- begin wizard step-2 -->
    <div>
        <fieldset>
            <legend class="pull-left width-full"><?php echo lbl('Log Error') ?> </legend>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <?php
                    if (file_exists('/var/log/apache2/error.log')) {
                        echo file_get_contents('/var/log/apache2/error.log');
                    }

                    $output = shell_exec('sudo tail -f /var/log/apache2/error.log');
                    echo "<pre>$output</pre>";
                    ?>
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </fieldset>
    </div>
    <!-- end wizard step-2 -->
    <!-- begin wizard step-3 -->
    <div>
        <fieldset>
            <form name="audit_trail" id="audit_trail" method="post">
                <legend class="pull-left width-full"><?php echo lbl('Audit Trail') ?> </legend>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12" id="divAudit">
                        <?php ViewServerInfo::list_audit_trail($_REQUEST); ?>
                    </div>
                    <div id="fade_loading"></div>
                    <div id="modal_loading">
                        <img id="loader" src="assets/images/processing.gif" />
                    </div>
                    <!-- end col-12 -->
                </div>
            </form>
            <!-- end row -->
        </fieldset>
    </div>
    <!-- end wizard step-3 -->
    <!-- begin wizard step-4 -->
    <div>
        <fieldset>
            <legend class="pull-left width-full"><?php echo lbl('Pangkalan Data') ?> </legend>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin coming-soon -->
                    <div class="coming-soon">
                        <div class="coming-soon-header">
                            <div class="bg-cover"></div>
                            <div class="brand">
                                <span class="logo"><i class="ion-cloud"></i></span> <b>Color</b> Admin
                            </div>
                            <div class="timer">
                                <div id="timer"></div>
                            </div>
                            <div class="desc">
                                Our website is almost there and it’s rebuilt from scratch! A lot of great new features <br />and improvements are coming.
                            </div>
                        </div>
                        <div class="coming-soon-content">
                            <div class="desc">
                                We are launching a closed <b>beta</b> soon!<br /> Sign up to try it before others and be the first to know when we <b>launch</b>.
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email Address" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary">Notify Me</button>
                                </div>
                            </div>
                            <p class="help-block m-b-25"><i>We don't spam. Your email address is secure with us.</i></p>
                            <p>
                                Follow us on 
                                <a href="#"><i class="fa fa-twitter fa-fw"></i> Twitter</a> and 
                                <a href="#"><i class="fa fa-facebook fa-fw"></i> Facebook</a>
                            </p>
                        </div>
                    </div>
                    <!-- end coming-soon -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </fieldset>
    </div>
</div>
    <!-- end wizard step-4 -->
