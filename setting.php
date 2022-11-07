<?php
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
$today = date("Y-m-d H:i:s");

require_once "include.php";

$server = str_replace("www.", "", $_SERVER["SERVER_NAME"]);

if ($server == $url_local) {
    # localhost
    $dbmysql1 = array(
        "dbtype" => "mysql", //mysql , pgsql , oci
        "host" => "localhost",
        "user" => "root",
        "password" => "",
        "database" => "seashell4", // SID atau Service Name untuk Oracle
        "port" => "3306", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "");

    $dbdata["seashell"] = $dbmysql1;
    
    $dbpg1 = array(
        "dbtype" => "pgsql", //mysql , pgsql , oci
        "host" => "localhost",
        "user" => "kimcy",
        "password" => "abcd1234",
        "database" => "cms", // SID atau Service Name u1ntuk Oracle
        "port" => "5432", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "hpupm");

    $dbdata["seashellpg"] = $dbpg1;

    $url = $url_local;
} elseif ($server == $url_development) {
    # development
    $dbmysql1 = array(
        "dbtype" => "mysql", //mysql , pgsql , oci
        "host" => "172.16.99.150",
        "user" => "seashell4",
        "password" => "xs2seashell4",
        "database" => "seashell4", // SID atau Service Name untuk Oracle
        "port" => "3306", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "");

    $dbdata["seashell4"] = $dbmysql1;

} elseif ($server == $url_live) {
    # live
    $dbmysql1 = array(
        "dbtype" => "mysql", //mysql , pgsql , oci
        "host" => "localhost",
        "user" => "",
        "password" => "",
        "database" => "", // SID atau Service Name untuk Oracle
        "port" => "3306", // default port : Oracle=1521 ; Pg=5432 ; Mysql=3306
        "schema" => "");

    $dbdata["seashell4"] = $dbmysql1;

    $url = $url_live;
} else {
    echo "Tiada nama server yang sah!";
}

require_once "framework/status.php";

if ($dbname != "") {
    Db::$dbconn = $dbname;
    $conn = Db::conn_db($dbdata);
    Db::$conn = $conn;
    Db::autocreate_fw($dbdata[$dbname]);
} else {
    echo "Sila semak pilihan pangkalan data";
}

$mainpage = "utama";
?>
        