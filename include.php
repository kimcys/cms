<?php
require_once __DIR__ .'/admin.php';
require_once __DIR__ .'/framework/class/class.dbpdo.php';
require_once __DIR__ .'/framework/func.php';
require_once __DIR__ .'/framework/label.php';
require_once __DIR__ .'/framework/plugin/tcpdf/tcpdf.php';
require_once __DIR__ .'/framework/plugin/highchart/class.chart.php';

# require framework class
$dirclass = __DIR__ .'/framework/class';
if (file_exists($dirclass)) {
    $filesclass = scandir($dirclass);
    if (is_array($filesclass)) {
        foreach ($filesclass as $row => $file) {
            $file = str_replace('..', '', $file);
            if (file_exists("$dirclass/$file") and $row >= '2') {
                require_once "$dirclass/$file";
            }
        }
    }
}

# require user class
$diruserclass = __DIR__ .'/class';
if (file_exists($diruserclass)) {
    $filesclass = scandir($diruserclass);
    if (is_array($filesclass)) {
        foreach ($filesclass as $row => $file) {
            if(is_dir("$diruserclass/$file") and $row >= '2'){
                $filesclassfolder = scandir("$diruserclass/$file");
                if (is_array($filesclassfolder)) {
                    foreach ($filesclassfolder as $rowfolder => $filefolder) {
                         if (file_exists("$diruserclass/$file/$filefolder") and $rowfolder >= '2') {
                            require_once "$diruserclass/$file/$filefolder";
                        }
                    }
                }
            }
            else if(file_exists("$diruserclass/$file") and $row >= '2') {
                require_once "$diruserclass/$file";
            }
        }
    }
}

# require user view
$diruserview = __DIR__ .'/v';
if (file_exists($diruserview)) {
    $filesclass = scandir($diruserview);
    if (is_array($filesclass)) {
        foreach ($filesclass as $row => $file) {
            if(is_dir("$diruserview/$file") and $row >= '2'){
                $filesviewfolder = scandir("$diruserview/$file");
                if (is_array($filesviewfolder)) {
                    foreach ($filesviewfolder as $rowfolder => $filefolder) {
                        if (file_exists("$diruserview/$file/$filefolder") and $rowfolder >= '2') {
                            require_once "$diruserview/$file/$filefolder";
                        }
                    }
                }
            }
            else if (file_exists("$diruserview/$file") and $row >= '2') {
                require_once "$diruserview/$file";
            }
        }
    }
}        