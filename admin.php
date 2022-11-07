<?php
        # nama sistem
        $GLOBALS['fw_sistem']='cms';
        $GLOBALS['fw_superadmin'] = array('hezrul@gmail.com','admin');
        $GLOBALS['fw_lang'] = 'bm';
       
        # server name

        $url_local="localhost";
        $url_development="php7.upm.edu.my";
        $url_live="seashell.upm.edu.my";

        /*
        Pangkalan data :
        Mysql , Pg, Oci, Mysqli
        Default connection dalam setting.php
        */
        $dbname = "seashellpg";
        
        /*
        Saiz Upload
        */
        $GLOBALS['max_upload'] = (int)filter_var(ini_get('upload_max_filesize'), FILTER_SANITIZE_NUMBER_INT);
        $GLOBALS['max_post'] = (int)filter_var(ini_get('post_max_size'), FILTER_SANITIZE_NUMBER_INT);
        $GLOBALS['memory_limit'] = (int)filter_var(ini_get('memory_limit'), FILTER_SANITIZE_NUMBER_INT);
        $GLOBALS['upload_mb'] = min($max_upload, $max_post, $memory_limit);   

        ?>