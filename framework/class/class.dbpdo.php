<?php

class Db {

    public static $dbconn;
    public static $db;
    public static $schema;
    public static $conn;
    public static $sts;

    public static function conn_db($dbdata) {
        if (is_array($dbdata)) {
            extract($dbdata[Db::$dbconn]);
            Db::$db = @$dbtype;
            Db::$schema = @$schema;
        }
        # configuration if using oracle
        if ($dbtype == 'oci') {
            $tns = "(DESCRIPTION = 
                        (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $port)) )
                        (CONNECT_DATA = (SERVICE_NAME = $database) )
                     )";
        }

        try {
            if ($dbtype == 'oci'){
                $conn = new PDO("$dbtype:dbname=".$tns, $user, $password);
            }else{
                $conn = new PDO("$dbtype:host=$host; port=$port;dbname=$database", $user, $password);
            }

            if ($dbtype == 'pgsql') {
                $conn->exec("SET search_path TO $schema");
            }

            //$conn = new PDO("$dbtype:host=$host; port=$port;dbname=$database", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error Connect To DB: " . $e->getMessage();
        }

        return $conn;
    }

    public static function query($sql,$execute=1) {
        try {
            $stmt = Db::$conn->prepare($sql);
            if($execute==1){
                $stmt->execute();
            }
            $sts = 1;
        } catch (PDOException $e) {
            $sts = "Error Db::query: " . $e->getMessage();
        }
        return array($stmt, $sts);
    }

    public static function data_list($table, $field, $condition = '1=1', $dbg = 'N') {
        $sql = "SELECT $field FROM $table WHERE $condition";
        try {
            list($stmt, $sts) = Db::query($sql);

            if ($sts != '1') {
                $datarow[0] = $sts;
            } else {
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $datarow = $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        } elseif ($dbg == 'D') {
            echo "<br>DEBUG : " . $sql . "<br>";
            echo "<pre>";
            print_r($datarow);
            echo "</pre>";
        }

        return @$datarow;
    }

    public static function insert_all($table, $data, $showsts = 'N', $dbg = 'N') {
        global $url;
        $fields = '';
        $values = '';
        $sts = '';

        $pos = strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']);
          if ($pos !== false) {
        $stmt = Db::query("SELECT * FROM $table LIMIT 1")[0];
        $arrfield = array();

        $i = Db::num_fields($stmt);
        for ($j = 0; $j < $i; $j++) {
            $fieldname = Db::field_name($stmt, $j);
            $fieldtype[$fieldname] = Db::field_type($stmt, $j);
            $fieldtype = array_change_key_case($fieldtype, CASE_LOWER);
            array_push($arrfield, strtolower($fieldname));
        }
        $data = array_change_key_case($data, CASE_LOWER);

        foreach ($data as $field => $value) {

            if (is_int(array_search($field, $arrfield))) {
                $fields = $fields . $field . ",";
                $lblvalues = @$lblvalues . ':' . $field . ",";
            }
        }
        $fields = substr($fields, 0, - 1);
        $lblvalues = substr($lblvalues, 0, - 1);

        $bindparam = explode(',', $fields);

        $sql = "INSERT INTO $table($fields) VALUES($lblvalues)";
        try {
            list($stmt, $sts) = Db::query($sql,0);

            foreach ($bindparam as $r => $v) {
                $stmt->bindParam(':' . $v, $data[$v]);
            }
            $stmt->execute();
            $log = array('sql' => $sql, 'data' => $data);
            Db::showsql('insert_all', $sql);
            Db::audit_trail($log);
            $sts = 1;
        } catch (PDOException $e) {
            $sts = "Error DB::insert_all : " . $e->getMessage();
        }
        
        if ($dbg == 'Y') {
            echo "<br>########## START DEBUG INSERT ALL ##########";
            if(is_array(@$log)){
            pr($log);} else {
                echo $sts;
        }
            echo "########## END DEBUG INSERT ALL ########## <br>";
        }

          } else {
              $sts = 'Form bukan dari server ini.';
          }

        if ($showsts == 'Y') {
            $msjok = lbl($GLOBALS['fw_lbl_msg_insert_ok']);
            $msjko = lbl($GLOBALS['fw_lbl_msg_insert_ko']);
            sts_sql($sts, $msjok, $msjko);
        }

        return $sts;
    }
    
    public static function insert($table, $field, $values, $showsts = 'N', $dbg = 'N') {
        $sts = '';
        $sql = "INSERT INTO " . $table . "(" . $field . ")VALUES(" . $values . ")";

        Db::showsql('insert', $sql);
        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        }

        try {
            list($stmt, $sts) = Db::query($sql);
            Db::showsql('insert', $sql);
            Db::audit_trail($sql);
        } catch (PDOException $e) {
            echo "Error DB::insert : " . $e->getMessage();
        }

        if($showsts=='Y')
        {
            $msjok = lbl($GLOBALS['fw_lbl_msg_insert_ok']);
            $msjko = lbl($GLOBALS['fw_lbl_msg_insert_ko']);
            sts_sql($sts, $msjok, $msjko);
        }
        
        return $sts;
    }

    public static function num_fields($stmt) {
        //$stmt = Db::query($sql)[0];
        $colcount = $stmt->columnCount();
        return $colcount;
    }

    public static function field_type($stmt, $field) {
        //$stmt = Db::query($sql)[0];
        $type = $stmt->getColumnMeta($field)['native_type'];
        return $type;
    }

    public static function field_name($stmt, $field) {
        $name = $stmt->getColumnMeta($field)['name'];
        return $name;
    }

    public static function showsql($tajuk, $sql) {
        if (in_array(@$_SESSION[$GLOBALS['fw_sistem']]['superadmin'], $GLOBALS['fw_superadmin'])) {
            echo "<!-- ########### Db::" . $tajuk . " start ############# \n\n " . $sql . " \n\n ########### Db::" . $tajuk . " end ############# --> ";
        }
    }

    public static function audit_trail($sql) {
        $user = @$_SESSION[$GLOBALS['fw_sistem']];
        $table = 'fw_audittrail';
        $fields = 'userx,sqlx,userinfo';
        $data = array('userx' => json_encode($user),
            'sqlx' => $sql,
            'userinfo' => json_encode($_SERVER));

        try {
            $sqlinsert = "INSERT INTO fw_audittrail(userx,sqlx,userinfo) VALUES(:userx,:sqlx,:userinfo)";
            list($stmt, $sts) = Db::query($sqlinsert);

            $stmt->bindParam(':userx', $userx);
            $stmt->bindParam(':sqlx', $sqlx);
            $stmt->bindParam(':userinfo', $userinfo);

            $userx = json_encode($user);
            $sqlx = json_encode($sql);
            $userinfo = json_encode($_SERVER);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error Db::audit_trail : " . $e->getMessage();
        }
    }
    
    public static function update_all($table, $data, $condition, $showsts = 'N', $dbg = 'N') {
        global $url;
        $sts = '';

        $pos = strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']);

        if ($pos !== false) {
            $sqlfield = Db::query("SELECT * FROM $table LIMIT 1")[0];
            $arrfield = array();
            $i = Db::num_fields($sqlfield);
            for ($j = 0; $j < $i; $j++) {
                $fieldname = Db::field_name($sqlfield, $j);
                $fieldtype[$fieldname] = Db::field_type($sqlfield, $j);
                $fieldtype = array_change_key_case($fieldtype, CASE_LOWER);
                array_push($arrfield, strtolower($fieldname));
            }
            $data = array_change_key_case($data, CASE_LOWER);

            $fields = '';
            $dataupdate = array();
            foreach ($data as $field => $value) {
                if (is_int(array_search($field, $arrfield))) {
                   $fields = $fields . $field . "=:$field,";
                   $dataupdate[$field]=$value;
                }
            }
            $fields = substr($fields, 0, - 1);
            
            $sql = "UPDATE $table SET $fields WHERE $condition";

            try {
                list($stmt, $sts) = Db::query($sql,0);
                
                $stmt->execute($dataupdate);
                $log = array('sql' => $sql, 'data' => $dataupdate);
                Db::showsql('update_all', $sql);
                Db::audit_trail($log);
                $sts = 1;
            } catch (PDOException $e) {
                $sts = "Error DB::update_all : " . $e->getMessage();
            }

            if ($dbg == 'Y') {
                echo "<br>########## START DEBUG UPDATE ALL ##########";
                if(is_array($log)){
                pr($log);} else {
                    echo $sts;
            }
                echo "########## END DEBUG UPDATE ALL ########## <br>";
            }
            
        } else {
            $sts = 'Form bukan dari server ini.';
        }

        if($showsts=='Y')
        {
            $msjok = lbl($GLOBALS['fw_lbl_msg_update_ok']);
            $msjko = lbl($GLOBALS['fw_lbl_msg_update_ko']);
            sts_sql($sts, $msjok, $msjko);
        }
        
        return $sts;
    }
    
    public static function CFAjax($class, $func) {
        global $url;
        $urlAjax = "action.ajax?do=" . emenu($url, $class) . "&func=$func";
        return $urlAjax;
    }
    
    public static function array2condition($table, $array) {
        if ($table != '' and is_array($array)) {
            $sqlfield = Db::query("SELECT * FROM $table")[0];
            $arrfield = array();
            $i = Db::num_fields($sqlfield);
            for ($j = 0; $j < $i; $j++) {
                $fieldname = Db::field_name($sqlfield, $j);
                array_push($arrfield, strtolower($fieldname));
            }

            foreach ($array as $field => $value) {
                if (is_int(array_search($field, $arrfield))) {
                    $condition = @$condition . $field . "='" . $value . "' AND ";
                }
            }

            $condition = substr(@$condition, 0, -5);

            return @$condition;
        }
    }
    
    public static function array2get($arr) {
        if (is_array($arr)) {
            foreach ($arr as $label => $value) {
                $getlist = @$getlist . "&" . @$label . "=" . urlencode(@$value) . "";
            }
            $getlist = substr($getlist, 1);
            return $getlist;
        }
    }
    
    public static function change_db($db) {
        global $dbdata;
        if ($db != '') {
            Db::$dbconn = $db;
            Db::$db = $dbdata[$db]['dbtype'];
            $conn = Db::conn_db($dbdata);
            Db::$conn = $conn;
        } else {
            echo "Sila semak pilihan pangkalan data";
        }
    }
    
    public static function chkval($table, $field, $condition, $dbg = 'N') {
        $sql = "SELECT $field FROM $table WHERE $condition";

        Db::showsql('chkval', $sql);

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        }
        
        try {
            list($stmt, $sts) = Db::query($sql);

            if ($sts != '1') {
                $val = $sts;
            } else {
                $nama_field = Db::field_name($stmt, 0);
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetchAll();
                if (is_array($row)) {
                $val = @$row[0][strtolower($nama_field)];
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return @$val;
    }
    
    public static function chkmax($table, $field, $condition = '1=1', $dbg = 'N') {
        $sql = "SELECT MAX($field) as max FROM $table WHERE $condition";

        Db::showsql('chkmax', $sql);

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        }
        
        try {
            list($stmt, $sts) = Db::query($sql);

            if ($sts != '1') {
                $val = $sts;
            } else {
                $nama_field = Db::field_name($stmt, 0);
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetchAll();

                if (is_array($row)) {
                $val = $row[0][strtolower($nama_field)];
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return @$val;
    }
    
    public static function chkmin($table, $field, $condition = '1=1', $dbg = 'N') {
        $sql = "SELECT MIN($field) as min FROM $table WHERE $condition";

        Db::showsql('chkmin', $sql);

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        }
        
        try {
            list($stmt, $sts) = Db::query($sql);

            if ($sts != '1') {
                $val = $sts;
            } else {
                $nama_field = Db::field_name($stmt, 0);
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetchAll();

                if (is_array($row)) {
                $val = $row[0][strtolower($nama_field)];
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return @$val;
    }
    
    public static function delete($table, $condition, $showsts = 'N', $dbg = 'N') {
        $sts = '';

        $sql = "DELETE FROM " . $table . " WHERE " . $condition . "";
        
        try {
                list($stmt, $sts) = Db::query($sql);
                Db::showsql('delete', $sql);
                Db::audit_trail(array('sql' => $sql));
            } catch (PDOException $e) {
                echo "Error DB::delete : " . $e->getMessage();
            }

            if ($dbg == 'Y') {
                echo "<br>DEBUG : " . $sql . "<br>";
            }

        if($showsts=='Y')
        {
            $msjok = lbl($GLOBALS['fw_lbl_msg_delete_ok']);
            $msjko = lbl($GLOBALS['fw_lbl_msg_delete_ko']);
            sts_sql($sts, $msjok, $msjko);
        }
        
        return $sts;
    }
    
    public static function list_grid($request, $table, $field, $condition = '1=1', $order = '', $bilrow = 10, $dbg = 'N') {
        $error = '';
        $x = 0;

        $cari = chk($request['cari']);
        $cari_manual = @$request['fw_cari_manual'];
        $all = chk($request['fw_all']);

        $sql = "SELECT tbl.* FROM (SELECT $field FROM $table WHERE $condition) AS tbl WHERE 1=1";

        list($data, $sts) = Db::query($sql);

        if ($sts != '1') {
            echo $sts;
        } else {
            if ($order == '') {
                $order = Db::field_name($data, 0);
            }

            if ($cari != '' and @ $cari_manual == '') {
                $cari = str_replace("'", "''", $cari);
                $bil_field = Db::num_fields($data);
                $carian = '';

                $array_field = explode(",", $field);

                for ($a = 0; $a < $bil_field; $a++) {
                    $nama_field = Db::field_name($data, $a);
                    $type_field = Db::field_type($data, $a);

                    $type_field = Db::field_type($data, $a);

                    $array_type = array("timestamp", "float8", "int4");

                    foreach ($array_field as $fieldselect) {
                        if (strpos($fieldselect, $nama_field) !== false) {
                            $nama_field = $fieldselect;
                        }

                        $position = strpos($nama_field, ' as ');
                        if ($position != '') {
                            $nama_field = substr($nama_field, '0', $position);
                        }

                        $position = strpos($nama_field, ' AS ');
                        if ($position != '') {
                            $nama_field = substr($nama_field, '0', $position);
                        }

                        $nama_field = str_replace('DISTINCT ', '', $nama_field);
                    }

                    if (!in_array($type_field, $array_type)) {
                        switch (Db::$db) {
                            case 'pgsql':
                                $carian = "$carian CAST($nama_field AS TEXT) ILIKE '%$cari%' OR";
                                break;
                            case 'mysql':
                                $carian = "$carian $nama_field LIKE '%$cari%' OR";
                                break;
                            case 'oci':
                                $carian = "$carian lower($nama_field) LIKE lower('%$cari%') OR";
                                break;
                        }
                    }
                }
                $carian = "(" . substr($carian, 1, -3) . ")";
                $condition = "$condition AND $carian";
            }

            $totalreturned = Db::num_rows("(SELECT $field FROM $table WHERE $condition) AS tbl", 'tbl.*', '1=1');
            $requestgrid = datagrid($request, $totalreturned, $bilrow);
            $requestgrid['fw_all'] = $all;

            $page_end = $requestgrid['page_end'];
            $bilrow = $requestgrid['bilrow'];
            $limit = $requestgrid['limit'];

            if ($totalreturned == $page_end) {
                $page_end = $page_end - $bilrow;
            }
            if ($page_end < '0') {
                $page_end = '0';
            }

            if (Db::$db == 'Oci') {
                $maxrow = $page_end + $bilrow;
                $sql = "SELECT * FROM (
                                SELECT a.*, ROWNUM fw_bil FROM (
                                  SELECT $field
                                    FROM $table
                                       WHERE $condition
                                           ORDER BY $order
                                ) a WHERE rownum <= $maxrow
                              ) where fw_bil > $page_end";
                //  ORDER BY $order";
            } else {
                $condition = "$condition ORDER BY $order LIMIT $bilrow OFFSET $page_end ";
                $sql = "SELECT $field FROM $table WHERE $condition";
            }

            list($data, $sts) = Db::query($sql);

            if ($sts != '1') {
                echo $sts;
            } else {
                $datarow = Db::fetch_assoc($data);
                if (is_array($datarow)) {
                    foreach ($datarow as $row => $value) {
                        $datarow[$row]['fw_bil'] = $row + $page_end;
                    }
                }
            }
        }

        Db::showsql('list_grid', $sql);

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        } elseif ($dbg == 'D') {
            echo "<br>DEBUG : " . $sql . "<br>";
            echo "<pre>";
            print_r($datarow);
            echo "</pre>";
        }

        return array('totalreturned' => $totalreturned, 'page_end' => $page_end, 'request' => $request, 'requestgrid' => $requestgrid, 'fw_senarai' => chk($datarow));
    }
    
    public static function num_rows($table, $field, $condition, $dbg = 'N') {
        $sql = "SELECT $field FROM $table WHERE $condition";

        list($data, $sts) = Db::query($sql);
        $row = $data->rowCount();
        if ($dbg == 'Y') {
            Db::showsql('num_rows', $sql);
            echo "<br>DEBUG : " . $sql . "<br>";
        }
        return $row;
    }
    
    public static function fetch_assoc($data) {
        $x = 0;
        
        while (TRUE == $row = $data->fetch(PDO::FETCH_ASSOC)) {
            $x = $x + 1;
            $datarow[$x] = array_change_key_case($row, CASE_LOWER);
        }
         
        return @$datarow;
    }
    
    public static function droplist_multi($sql, $name, $value, $display, $select, $class, $others = '', $null = '') {
        $value = strtolower($value);
        $display = strtolower($display);

        list($data, $sts) = Db::query($sql);

        if ($sts != '1') {
            echo $sts;
        } else {
            $arrrow = Db::fetch_assoc($data);
            if (is_array($arrrow)) {
                echo "<select name=\"$name\" class=\"$class\" id=\"$name\" multiple=\"multiple\" $others >";
                foreach ($arrrow as $row => $values) {
                    $pilih = 0;
                    if (is_array(@$select)) {
                        foreach ($select as $r => $v) {
                            if ($values[$value]==$v) {
                                $pilih = 1;
                            }
                        }
                    } else {
                        if ($select == $values[$value]) {
                            @$pilih = 1;
                        }
                    }
                    //$rowdisplay = str_replace("'", "''", $values[$display]);
                    $rowdisplay = $values[$display];

                    if ($pilih == 1) {
                        echo "<option selected=\"selected\" value=\"" . $values[$value] . "\">" . $rowdisplay . "</option>";
                    } else {
                        echo "<option value=\"" . $values[$value] . "\">" . $rowdisplay . "</option>";
                    }
                }
                echo "</select>";
            }
        }
    }
    
    public static function droplistchange($sql, $name, $value, $display, $select, $class, $onchange, $others = '', $null = '') {
        list($data, $sts) = Db::query($sql);

        if ($sts != '1') {
            echo $sts;
        } else {
            $arrrow = Db::fetch_assoc($data);
            if (is_array($arrrow)) {
                echo "<select name=\"$name\" class=\"$class\" id=\"$name\" onchange=\"$onchange\" $others >";
                echo "<option value=''>$null</option>";
                foreach ($arrrow as $row => $values) {
                    //$rowdisplay = str_replace("'", "''", $values[$display]);
                    $rowdisplay = $values[$display];
                    if (strcmp(trim($select), trim($values[$value])) == 0) {
                        echo "<option selected=\"selected\" value=\"" . $values[$value] . "\">" . $rowdisplay . "</option>";
                    } else {
                        echo "<option value=\"" . $values[$value] . "\">" . $rowdisplay . "</option>";
                    }
                }
                echo "</select>";
            } else {
                echo "<select name=\"$name\" class=\"$class\" id=\"$name\" onchange=\"$onchange\" $others >";
                echo "</select>";
            }
        }
    }
    
    public static function display($table, $field, $condition = '1=1', $dbg = 'N') {
        $sql = "SELECT $field FROM $table WHERE $condition";

        list($data, $sts) = Db::query($sql);

        if ($sts != '1') {
            $arrval[0] = $sts;
        } else {
            $row = Db::fetch_assoc($data);
            if (is_array($row)) {
                $arrval = $row[1];
            } else {
                $arrval = $sts;
            }
        }

        if ($dbg == 'Y') {
            Db::showsql('display', $sql);
            echo "<br>DEBUG : " . $sql . "<br>";
        } elseif ($dbg == 'D') {
            echo "<br>DEBUG : " . $sql . "<br>";
            echo "<pre>";
            print_r($arrval);
            echo "</pre>";
        }

        return @$arrval;
    }
    
    public static function droplist($sql, $name, $value, $display, $select, $class = 'form-control', $others = '', $null = '') {
        $value = strtolower($value);
        $display = strtolower($display);

        list($data, $sts) = Db::query($sql);

        if ($sts != '1') {
            echo $sts;
        } else {
            $arrrow = Db::fetch_assoc($data);
            if (is_array($arrrow)) {
                
                if($null==''){
                    $null = lbl('Please select');
                }
                
                echo "<select name=\"$name\" class=\"$class\" id=\"$name\" $others >";
                echo "<option value=''>$null</option>";
                foreach ($arrrow as $row => $values) {
                    //$rowdisplay = str_replace("'", "''", $values[$display]);
                    $rowdisplay = $values[$display];
                    if (strcmp(trim($select), trim($values[$value])) == 0) {
                        echo "<option selected=\"selected\" value=\"" . $values[$value] . "\">" . $rowdisplay . "</option>";
                    } else {
                        echo "<option value=\"" . $values[$value] . "\">" . $rowdisplay . "</option>";
                    }
                }
                echo "</select>";
            }
        }
    }
    
    public static function delete_upload_file($id_upload, $dbg = 'N') {
        if ($id_upload != '') {
            global $dbdata;
            //$schema = $dbdata[Db::$dbconn]['schema'];
            $table = "fw_uploads";
            $link = Db::chkval($table, 'link', "id='$id_upload'");
            $sql = "DELETE FROM $table WHERE id='$id_upload'";

            Db::showsql('delete_upload_file', $sql);

            if ($dbg == 'Y') {
                echo "<br>DEBUG : " . $sql . "<br>";
            }

            $sts = Db::query($sql)[1];

            if ($sts == '1') {
                Db::audit_trail(array('sql' => $sql));
                unlink($link);
            }

            return $sts;
        }
    }
    
    public static function chksusunan($namafieldid, $table, $fieldsusunan, $condition) {
        $susunan_null = Db::chkval($table, $namafieldid, $condition . " AND $fieldsusunan = '' or $fieldsusunan IS NULL");
        $duplicate = Db::chkval($table, "$namafieldid, COUNT($fieldsusunan)", $condition . " GROUP BY $fieldsusunan HAVING ( COUNT($fieldsusunan) > 1)");
        if ($susunan_null != '' or $duplicate != '') {
            $senarai = Db::data_list($table, $namafieldid, $condition . " ORDER BY $fieldsusunan,$namafieldid DESC");
            foreach ($senarai as $k => $v) {
                Db::update($table, "$fieldsusunan='$k' ", $condition . " AND $namafieldid='" . $v[$namafieldid] . "'");
            }
        }
    }
    
    public static function godown($namafieldid, $idrekod, $table, $fieldsusunan, $condition, $dbg = 'N') {
        //Db::chksusunan($namafieldid,$table,$fieldsusunan,$condition);

        $chkkedudukan = Db::chkval($table, $fieldsusunan, "$namafieldid='$idrekod'", $dbg);
        $chkmaxrekod = Db::chkmax($table, $fieldsusunan, $condition, $dbg);
        if ($chkkedudukan < $chkmaxrekod) {
            $kedudukandown = Db::chkmin($table, $fieldsusunan, $condition . " AND $fieldsusunan > $chkkedudukan ", $dbg);
            $chkidrekodslps = Db::chkval($table, $namafieldid, "$condition AND $fieldsusunan = '$kedudukandown'", $dbg);
            Db::update($table, "$fieldsusunan='$chkkedudukan'", "$namafieldid='$chkidrekodslps'", $dbg);
            Db::update($table, "$fieldsusunan='$kedudukandown'", "$namafieldid='$idrekod'", $dbg);
        }
    }

    public static function goup($namafieldid, $idrekod, $table, $fieldsusunan, $condition, $dbg = 'N') {
        // Db::chksusunan($namafieldid,$table,$fieldsusunan,$condition);

        $chkkedudukan = Db::chkval($table, $fieldsusunan, "$namafieldid='$idrekod'", $dbg);
        $chkminrekod = Db::chkmin($table, $fieldsusunan, $condition, $dbg);
        if ($chkkedudukan > $chkminrekod) {
            $kedudukanup = Db::chkmax($table, $fieldsusunan, $condition . " AND $fieldsusunan < $chkkedudukan ", $dbg);
            $chkidrekodsblm = Db::chkval($table, $namafieldid, "$condition AND $fieldsusunan = '$kedudukanup'", $dbg);
            Db::update($table, "$fieldsusunan='$chkkedudukan'", "$namafieldid='$chkidrekodsblm'", $dbg);
            Db::update($table, "$fieldsusunan='$kedudukanup'", "$namafieldid='$idrekod'", $dbg);
        }
    }
    
    public static function key_condition($table, $array) {
        if ($table != '' and is_array($array)) {
            $sqlfield = Db::query("SELECT * FROM $table")[0];

            $fieldname = Db::field_name($sqlfield, 0);

            $condition = @$fieldname . "='" . @$array[$fieldname] . "'";

            return @$condition;
        }
    }
    
    public static function saveUploadv2($user, $dataupload, $file, $upload_dir = '', $sizefile = '', $allowedExts = '') {
        if ($upload_dir == '')
            $upload_dir = "upload/";
        if ($allowedExts == '')
            $allowedExts = array("jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "png", "PNG", "pdf", "PDF", "docx", "DOCX", "doc", "DOC", "xls", "XLS", "xlsx", "XLSX");
        if ($sizefile == '')
            $sizefile = $GLOBALS['upload_mb'];

        $sizefile = $sizefile * 1024 * 1024;

        if ($dataupload != '') {
            $id_upl = '';
            $today = date("YmdHis");
            $_FILES = $dataupload;
            $nama = chk($_FILES["$file"]["name"]);
            $filename = str_replace(" ", "_", $_FILES["$file"]["name"]);
            $extension = explode(".", $filename);
            $extension = end($extension);
            $filename = $today . $filename;
            if ((@$_FILES["$file"]["size"] < $sizefile) && in_array($extension, $allowedExts)) {
                if ($_FILES["$file"]["error"] > 0) {
                    $sts = $_FILES["$file"]["error"];
                } else {
                    $filename = $upload_dir . $filename;
                    if (move_uploaded_file($_FILES["$file"]["tmp_name"], $filename)) {
                        $upl_info = array("nama" => $nama, "link" => $filename, "type" => $_FILES["$file"]["type"], "tmp_name" => $_FILES["$file"]["tmp_name"],
                            "err" => $_FILES["$file"]["error"], "size" => $_FILES["$file"]["size"], "upload_by" => $user);

                        global $dbdata;
                        //$schema = $dbdata[Db::$dbconn]['schema'];
                        $table = "fw_uploads";
                        $simpan = Db::insert_all($table, $upl_info);
                        if ($simpan == 1) {
                            $sts = 1;
                            $filename = addslashes($filename);
                            $id_upl = Db::chkval($table, 'id', "link='$filename' and upload_by='$user'");
                        } else {
                            $sts = $simpan;
                        }
                    } else {
                        $sts = 'Tak berjaya pindah fail';
                    }
                }
            } else {
                if(!in_array($extension, $allowedExts)){
                    $sts = "File type not supported!";
                }
                if(@$_FILES["$file"]["size"] > $sizefile){
                     $sts = "File too large!";
                }
            }
            return array("sts" => $sts, "id_upload" => $id_upl, "saiz" => @$_FILES["$file"]["size"], "ext" => $extension, "link" => $filename, "name" => $nama);
        }
    }
    
    public static function sql_list($sql,$dbg = 'N') {
        list($data, $sts) = Db::query($sql);

        if ($sts != '1') {
            $datarow[0] = $sts;
        } else {
            $datarow = Db::fetch_assoc($data);
        }

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        } elseif ($dbg == 'D') {
            echo "<br>DEBUG : " . $sql . "<br>";
            echo "<pre>";
            print_r($datarow);
            echo "</pre>";
        }
        return $datarow;
    }
    
    public static function susun($namafieldid, $table, $fieldsusunan, $fieldstatus, $condition) {
        $senxaktif = Db::data_list($table, "$namafieldid,$fieldsusunan,$fieldstatus", "$condition ORDER BY $fieldstatus DESC, $fieldsusunan, $namafieldid DESC ");
        foreach ($senxaktif as $k => $v) {
            Db::update($table, "$fieldsusunan='$k' ", "$namafieldid='" . $v[$namafieldid] . "'");
        }
    }
    
    public static function table_fields($table) {
        if ($table != '') {
            $sqlfield = Db::query("SELECT * FROM $table")[0];
            $arrfield = array();
            $i = Db::num_fields($sqlfield);
            for ($j = 0; $j < $i; $j++) {
                $fieldname = Db::field_name($sqlfield, $j);
                array_push($arrfield, strtolower($fieldname));
            }
            return $arrfield;
        }
    }
    
    public static function update($table, $field, $condition, $showsts = 'N', $dbg = 'N') {

        $sql = "UPDATE " . $table . " SET " . $field . " WHERE " . $condition . "";

        Db::showsql('update', $sql);

        if ($dbg == 'Y') {
            echo "<br>DEBUG : " . $sql . "<br>";
        }

        $sts = Db::query($sql)[1];

        if ($sts == 1) {
            Db::audit_trail(array('sql' => $sql));
        }

        if($showsts=='Y')
        {
            $msjok = lbl($GLOBALS['fw_lbl_msg_update_ok']);
            $msjko = lbl($GLOBALS['fw_lbl_msg_update_ko']);
            sts_sql($sts, $msjok, $msjko);
        }
        
        return $sts;
    }
    
    public static function autocreate_fw($dbdata) {
        switch (Db::$db) {
            case 'pgsql' :
                $schema = $dbdata['schema'];
                $chktbl = Db::data_list('information_schema.tables', 'table_name', "table_schema = '$schema'");
                $sentbl = array();
                if(is_array($chktbl)){
                    foreach ($chktbl as $table_name) {
                        array_push($sentbl, $table_name['table_name']);
                    }
                }
                # create table fw_audittrail
                if(!in_array('fw_audittrail', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_audittrail (
                                    \"id\" serial8 NOT NULL,
                                    \"userx\" text COLLATE \"default\",
                                    \"sqlx\" text COLLATE \"default\",
                                    \"userinfo\" text COLLATE \"default\",
                                    \"tkhmasa\" timestamp(6) DEFAULT now() NOT NULL,
                                    CONSTRAINT \"fw_audittrail_pkey\" PRIMARY KEY (\"id\")
                                    )";
                    Db::query($sqlcreate);
                }
                
                # create table fw_uploads
                if(!in_array('fw_uploads', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_uploads (
                                    \"id\" serial8 NOT NULL,
                                    \"nama\" varchar(255) COLLATE \"default\",
                                    \"link\" varchar(255) COLLATE \"default\",
                                    \"type\" varchar(100) COLLATE \"default\",
                                    \"tmp_name\" varchar(255) COLLATE \"default\",
                                    \"err\" varchar(255) COLLATE \"default\",
                                    \"size\" varchar(15) COLLATE \"default\",
                                    \"upload_by\" varchar(25) COLLATE \"default\",
                                    \"tkhmasa\" timestamp(6) DEFAULT now() NOT NULL,
                                    CONSTRAINT \"fw_uploads_pkey\" PRIMARY KEY (\"id\"),
                                    CONSTRAINT \"fw_uploads_link_key\" UNIQUE (\"link\")
                                    )";
                    Db::query($sqlcreate);
                }

                # create table fw_lang
                if(!in_array('fw_lang', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_lang (
                                    \"fl_id\" serial8 NOT NULL,
                                    \"label\" text COLLATE \"default\",
                                    \"bm\" text COLLATE \"default\",
                                    \"bi\" text COLLATE \"default\",
                                    \"last_update\" timestamp(6) DEFAULT now() NOT NULL,
                                    \"update_by\" varchar(255) COLLATE \"default\",
                                    CONSTRAINT \"fw_lang_pkey\" PRIMARY KEY (\"fl_id\")
                                    )";
                    Db::query($sqlcreate);
                }
                
                # create table fw_menu
                if(!in_array('fw_menu', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_menu (
                                    \"m_id\" serial8 NOT NULL,
                                    \"m_keterangan\" varchar(255) COLLATE \"default\",
                                    \"m_submenu\" varchar(5) COLLATE \"default\",
                                    \"m_href\" varchar(255) COLLATE \"default\",
                                    \"m_class\" varchar(255) COLLATE \"default\",
                                    \"m_susunan\" int4,
                                    \"m_status\" varchar(2) DEFAULT 'A',
                                    \"m_gen_code\" text COLLATE \"default\",
                                    \"m_gen_by\" varchar(255) COLLATE \"default\",
                                    \"m_gen_date\" timestamp(6) DEFAULT now() NOT NULL,
                                    CONSTRAINT \"fw_menu_pkey\" PRIMARY KEY (\"m_id\")
                                    )";
                    Db::query($sqlcreate);
                    $sqlinsert = "INSERT INTO $schema.fw_menu (m_keterangan, m_submenu, m_href, m_class, m_susunan, m_status, m_gen_code, m_gen_by) VALUES ('Pengurusan', 'Y', '#', 'ion-ios-information-outline bg-gradient-yellow', '1', 'A', NULL, NULL);";
                    Db::query($sqlinsert);
                }
                
                # create table fw_submenu
                if(!in_array('fw_submenu', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_submenu (
                                    \"sm_id\" serial8 NOT NULL,
                                    \"sm_m_id\" int4,
                                    \"sm_keterangan\" varchar(255) COLLATE \"default\",
                                    \"sm_href\" varchar(255) COLLATE \"default\",
                                    \"sm_class\" varchar(255) COLLATE \"default\",
                                    \"sm_susunan\" int4,
                                    \"sm_status\" varchar(2) DEFAULT 'A',
                                    \"sm_gen_code\" text COLLATE \"default\",
                                    \"sm_gen_by\" varchar(255) COLLATE \"default\",
                                    \"sm_gen_date\" timestamp(6) DEFAULT now() NOT NULL,
                                    CONSTRAINT \"fw_submenu_pkey\" PRIMARY KEY (\"sm_id\")
                                    )";
                    Db::query($sqlcreate);
                    $sqlinsert = "INSERT INTO $schema.fw_submenu (sm_m_id, sm_keterangan, sm_href, sm_class, sm_susunan, sm_status, sm_gen_code, sm_gen_by) VALUES ('1', 'Terjemahan', 'm/m.fw_lang', 'fa fa-language text-theme m-l-5', '1', 'A', NULL, NULL);";
                    Db::query($sqlinsert);
                }
                
                # create table ref_role
                if(!in_array('ref_role', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.ref_role (
                                    \"rr_id\" serial8 NOT NULL,
                                    \"rr_acronym\" varchar(100) COLLATE \"default\",
                                    \"rr_description\" varchar(255) COLLATE \"default\",
                                    CONSTRAINT \"ref_role_pkey\" PRIMARY KEY (\"rr_id\")
                                    )";
                    Db::query($sqlcreate);
                    $sqlinsert = "INSERT INTO $schema.ref_role VALUES (1, 'admin','Administrator');";
                    Db::query($sqlinsert);
                }
                
                # create table fw_akses
                if(!in_array('fw_akses', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_akses (
                                    \"fa_id\" serial8 NOT NULL,
                                    \"fa_m_id\" int4,
                                    \"fa_sm_id\" int4,
                                    \"fa_rr_id\" int4,
                                    \"fa_insertby\" varchar(255) COLLATE \"default\",
                                    \"fa_insertdate\" timestamp(6) DEFAULT now() NOT NULL,
                                    CONSTRAINT \"fw_akses_pkey\" PRIMARY KEY (\"fa_id\")
                                    )";
                    Db::query($sqlcreate);
                }

                break;
            case 'mysql' :

                $chktbl = Db::data_list('information_schema.tables', 'table_name', "table_schema = '{$dbdata['database']}'");
                $sentbl = array();
                if(is_array($chktbl)){
                    foreach ($chktbl as $table_name) {
                        array_push($sentbl, $table_name['table_name']);
                    }
                }
                
                # create table fw_audittrail
                if(!in_array('fw_audittrail', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS `fw_audittrail` (
                                      `id` int(11) NOT NULL AUTO_INCREMENT,
                                      `userx` longtext,
                                      `sqlx` longtext,
                                      `userinfo` longtext,
                                      `tkhmasa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                      PRIMARY KEY (`id`)
                                    )";
                    Db::query($sqlcreate);
                }

                # create table fw_uploads
                if(!in_array('fw_uploads', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS fw_uploads (
                                          id int(11) NOT NULL AUTO_INCREMENT,
                                          nama varchar(255) DEFAULT NULL,
                                          link varchar(255) DEFAULT NULL,
                                          type varchar(255) DEFAULT NULL,
                                          tmp_name varchar(255) DEFAULT NULL,
                                          err varchar(255) DEFAULT NULL,
                                          size varchar(255) DEFAULT NULL,
                                          upload_by varchar(255) DEFAULT NULL,
                                          tkhmasa timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                          PRIMARY KEY (id)
                                        )
                                      ";
                    Db::query($sqlcreate);
                }

                # create table fw_lang
                if(!in_array('fw_lang', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS `fw_lang` (
                                          `fl_id` int(9) NOT NULL AUTO_INCREMENT,
                                          `label` text,
                                          `bm` text,
                                          `bi` text,
                                          `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                          `update_by` varchar(255) DEFAULT NULL,
                                          PRIMARY KEY (`fl_id`)
                                        )
                                      ";
                    Db::query($sqlcreate);
                }

                # create table fw_menu
                if(!in_array('fw_menu', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS `fw_menu` (
                                          `m_id` int(11) NOT NULL AUTO_INCREMENT,
                                          `m_keterangan` varchar(255) DEFAULT NULL,
                                          `m_submenu` varchar(5) DEFAULT NULL,
                                          `m_href` varchar(255) DEFAULT '#',
                                          `m_class` varchar(255) DEFAULT NULL,
                                          `m_susunan` int(255) DEFAULT NULL,
                                          `m_status` varchar(2) DEFAULT 'A' COMMENT 'A - Active; NA - Non Active',
                                          `m_gen_code` text,
                                          `m_gen_by` varchar(255) DEFAULT NULL,
                                          `m_gen_date` datetime DEFAULT NULL,
                                          PRIMARY KEY (`m_id`)
                                        )
                                      ";
                    Db::query($sqlcreate);
                    $sqlinsert = "INSERT INTO `fw_menu` (`m_keterangan`, `m_submenu`, `m_href`, `m_class`, `m_susunan`, `m_status`, `m_gen_code`, `m_gen_by`, `m_gen_date`) VALUES ('Pengurusan', 'Y', '#', 'ion-ios-information-outline bg-gradient-yellow', '1', 'A', NULL, NULL, NULL);";
                    Db::query($sqlinsert);
                }

                # create table fw_submenu
                if(!in_array('fw_submenu', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS `fw_submenu` (
                                          `sm_id` int(11) NOT NULL AUTO_INCREMENT,
                                          `sm_m_id` int(11) DEFAULT NULL,
                                          `sm_keterangan` varchar(255) DEFAULT NULL,
                                          `sm_href` varchar(255) DEFAULT NULL,
                                          `sm_class` varchar(255) DEFAULT NULL,
                                          `sm_susunan` int(255) DEFAULT NULL,
                                          `sm_status` varchar(2) DEFAULT 'A' COMMENT 'A - Active; NA - Non Active',
                                          `sm_gen_code` text,
                                          `sm_gen_by` varchar(255) DEFAULT NULL,
                                          `sm_gen_date` datetime DEFAULT NULL,
                                          PRIMARY KEY (`sm_id`),
                                          KEY `sm_m_id` (`sm_m_id`),
                                          CONSTRAINT `fw_submenu_ibfk_1` FOREIGN KEY (`sm_m_id`) REFERENCES `fw_menu` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE
                                        )
                                      ";
                    Db::query($sqlcreate);
                    $sqlinsert = "INSERT INTO `fw_submenu` (`sm_m_id`, `sm_keterangan`, `sm_href`, `sm_class`, `sm_susunan`, `sm_status`, `sm_gen_code`, `sm_gen_by`, `sm_gen_date`) VALUES ('1', 'Terjemahan', 'm/m.fw_lang', 'fa fa-language text-theme m-l-5', '1', 'A', NULL, NULL, NULL);";
                    Db::query($sqlinsert);
                }
                
                # create table ref_role
                if(!in_array('ref_role', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS `ref_role` (
                                      `rr_id` int(11) NOT NULL AUTO_INCREMENT,
                                      `rr_acronym` varchar(100) DEFAULT NULL,
                                      `rr_description` varchar(255) DEFAULT NULL,
                                      PRIMARY KEY (`rr_id`)
                                    )
                                      ";
                    Db::query($sqlcreate);
                    $sqlinsert = "INSERT INTO `ref_role` VALUES (1, 'admin','Administrator');";
                    Db::query($sqlinsert);
                }

                # create table fw_akses
                if(!in_array('fw_akses', $sentbl)){
                    $sqlcreate = "CREATE TABLE IF NOT EXISTS `fw_akses` (
                                          `fa_id` int(11) NOT NULL AUTO_INCREMENT,
                                          `fa_m_id` int(11) DEFAULT NULL COMMENT 'fw_menu.m_id',
                                          `fa_sm_id` int(11) DEFAULT NULL COMMENT 'fw_submenu.sm_id',
                                          `fa_rr_id` int(11) DEFAULT NULL COMMENT 'ref_role.rr_id',
                                          `fa_insertby` varchar(255) DEFAULT NULL,
                                          `fa_insertdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                                          PRIMARY KEY (`fa_id`),
                                          KEY `fa_rr_id` (`fa_rr_id`),
                                          CONSTRAINT `fw_akses_ibfk_1` FOREIGN KEY (`fa_rr_id`) REFERENCES `ref_role` (`rr_id`) ON DELETE CASCADE ON UPDATE CASCADE
                                        )
                                      ";
                    Db::query($sqlcreate);
                }
                
                break;
            case 'oci' :
                $schema = Db::$schema;
                // create table fw_audittrail
                $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_audittrail (
                                    ID NUMBER (8)  NOT NULL  PRIMARY KEY,
                                    USERX VARCHAR2 (1000)  NOT NULL,
                                    SQLX VARCHAR2 (1000),
                                    USERINFO VARCHAR2 (500),
                                    TKHMASA TIMESTAMP DEFAULT SYSDATE);";

                Db::query($sqlcreate);

                $seq = $schema . 'fw_audittrail_SEQ';
                $sqlseq = "CREATE SEQUENCE IF NOT EXISTS $seq";
                Db::query($sqlseq);

                $trg = $schema . 'fw_audittrail_TRG';
                $sqltrg = "CREATE OR REPLACE TRIGGER $trg
                                BEFORE INSERT ON $schema.fw_audittrail
                                FOR EACH ROW
                                BEGIN
                                  SELECT $seq.NEXTVAL
                                  INTO   :new.ID
                                  FROM   dual;
                                END;";
                Db::query($sqltrg);

                // create table fw_uploads
                $sqlcreate = "CREATE TABLE IF NOT EXISTS $schema.fw_uploads
                                 (ID NUMBER (8)  NOT NULL  PRIMARY KEY,
                                    NAMA VARCHAR2(255),
                                    LINK VARCHAR2(255),
                                    TYPE VARCHAR2(100),
                                    TMP_NAME VARCHAR2(255),
                                    ERR VARCHAR2(255),
                                    DOC_SIZE VARCHAR2(15),
                                    UPLOAD_BY VARCHAR2(25),
                                    TKHMASA TIMESTAMP DEFAULT SYSDATE)";

                Db::query($sqlcreate);

                $seqfw_uploads = $schema . 'fw_uploads_SEQ';
                $sqlseq = "CREATE SEQUENCE IF NOT EXISTS $seqfw_uploads";
                Db::query($sqlseq);

                $trg = $schema . 'fw_uploads_TRG';
                $sqltrg = "CREATE OR REPLACE TRIGGER $trg
                                BEFORE INSERT ON $schema.fw_uploads
                                FOR EACH ROW
                                BEGIN
                                  SELECT $seqfw_uploads.NEXTVAL
                                  INTO   :new.ID
                                  FROM   dual;
                                END;";
                Db::query($sqltrg);
                break;
        }
    }
    
    function user_login($email, $password) {
        session_unset();
        // Using prepared statements means that SQL injection is not possible.
        
        $sql = 'SELECT u_id, u_email, u_pwd FROM users WHERE u_email = :u_email LIMIT 1';
        list($stmt, $sts) = Db::query($sql,'');
        $stmt->bindParam(':u_email', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        
        // get variables from result.
        list($u_id, $u_email, $u_pwd) = $stmt->fetch( PDO::FETCH_NUM );

        if (isset($u_email, $u_pwd)) {
            // Check if the password in the database matches
            if (emenu(strrev($email), $password)===$u_pwd) {
                // Password is correct!
                $table = "users a INNER JOIN profile b ON a.u_id=b.p_u_id";
                $field = 'a.u_id, a.u_email, b.p_fullname';
                $condition = "a.u_email = '$email'";
                $users = Db::display($table, $field, $condition);
                if (is_array($users)) {
                    $_SESSION[$GLOBALS['fw_sistem']] = array("username" => $users['u_email'], "name" => $users['p_fullname'], "u_id" => $users['u_id']);
                }
                // Login successful.
                $sts = 1;
            } else {
                // Password is incorrect!;
                $sts = 2;
            }
        } else {
            // No user exists.
            $sts = 3;
        }
        
        return $sts;
    }

}

?>
