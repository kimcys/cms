<?php

function chk(&$var)
{
    $var = (isset($var)) ? $var : '';
    return $var;
}

function chkarray(&$var)
{
    if (!is_array($var))
        $var = array();
    return $var;
}

function chkmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sts = 0;
    } else {
        $sts = $email;
    }
    return $sts;
}

function bersih($value)
{
    if (!is_array($value)) {
        //$clean = strip_tags ( $value );
        $value = addslashes($value);
    }

    return $value;
}

//function lbl($lbl)
//{
//    global $db;
//
//    if($db=='Mysql')
//    {
//            $objDB = new Mysql();
//    }
//    elseif($db=='Pg')
//    {
//            $objDB = new Pg();
//    }
//
//    if($lbl!='')
//    {
//            $lang = chk($_SESSION['lang']);
//            $lang = strtolower($lang);
//            $lblnew='';
//            $lbl = addslashes($lbl);
//            $val=$objDB->chkval('fw_lang','label'," label='$lbl'");
//            if($val=='')
//            {
//                    $objDB->table_insert("fw_lang", "label,bm", "'$lbl','$lbl'");
//                    $lblnew = $lbl;
//            }
//            else
//            {
//                    if($lang=='bm')
//                    {
//                            $lblnew=$objDB->chkval('fw_lang','bm'," label='$lbl'");
//                    }
//                    elseif($lang=='bi')
//                    {
//                            $lblnew=$objDB->chkval('fw_lang','bi'," label='$lbl'");
//                    }	
//                            if($lblnew=='')
//                            {
//                                    $lblnew=$lbl;
//                            }
//            }
//            return $lblnew;
//    }	
//}

function lbl($lbl)
{
    if ($lbl != '') {
        $lang = chk($_SESSION['lang']);
        $lang = strtolower($lang);
        $lblnew = '';
        $val = Db::chkval('fw_lang', 'label', " label='$lbl'");
        if ($val == '') {
            Db::insert("fw_lang", "label,{$GLOBALS['fw_lang']}", "'$lbl','$lbl'");
            $lblnew = $lbl;
        } else {
            if ($lang == 'bm') {
                $lblnew = Db::chkval('fw_lang', 'bm', " label='$lbl'");
            } elseif ($lang == 'bi') {
                $lblnew = Db::chkval('fw_lang', 'bi', " label='$lbl'");
            }
            if ($lblnew == '') {
                $lblnew = $lbl;
            }
        }
        return $lblnew;
    }
}

function dformat($var)
{
    if (!is_array($var)) {
        if (preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $var)) {
            $var = date("d-m-Y h:i:s A", strtotime($var));
            return $var;
        } elseif (preg_match("/[0-9]{4}\/[0-9]{2}\/[0-9]{2}/", $var)) {
            $var = date("d/m/Y h:i:s A", strtotime($var));
            return $var;
        } else {
            return $var;
        }
    } else {
        return $var;
    }
}

function chgdate($format, $var)
{
    if ($var != '') {
        $var = date($format, strtotime($var));
    }
    return @$var;
}

function gopage($page, $timer = 0)
{
    //echo "<meta http-equiv=\"refresh\" content=\"$timer;".
    //		 "url=$page\">";
    ?>
    <script type="text/javascript">
        function pageRedirect() {
            window.location.replace("<?php echo $page ?>");
        }

        setTimeout("pageRedirect()", <?php echo $timer ?>);
    </script>
    <?php
}

function emenu($keyid, $string)
{
    if ($string != '') {
        # $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($keyid), $string, MCRYPT_MODE_CBC, md5(md5($keyid))));
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode($keyid);
        // Generate an initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-ECB'));
        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
        $encrypted = openssl_encrypt($string, 'AES-256-ECB', $encryption_key, 0, $iv);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        $encrypted = base64_encode($encrypted . '::' . $iv);
        $encrypted = substr($encrypted, 0, -1);
        return $encrypted;
    }
}

function dmenu($keyid, $string)
{
    if ($string != '') {
        # $string=str_replace(' ','+',$string);
        # $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($keyid), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($keyid))), "\0");
        $string = $string . '=';
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode($keyid);
        // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
        list($encrypted_data, $iv) = explode('::', base64_decode($string), 2);
        $decrypted = openssl_decrypt($encrypted_data, 'AES-256-ECB', $encryption_key, 0, $iv);
        return $decrypted;
    }
}

function alert($msj)
{
    /*echo "<script>alert('$msj')</script>";*/

    ?>
    <style>
        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 50px;
            font-size: 16px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
    </style>

    <div id="snackbar"><?php echo $msj; ?></div>

    <script>
        myFunction();

        function myFunction() {
            var x = document.getElementById("snackbar");
            if (x) {
                x.className = "show";
                setTimeout(function () {
                    x.className = x.className.replace("show", "");
                }, 3000);
            }
        }
    </script>
    <?php
}

function google_qr($url, $size = '150', $EC_level = 'L', $margin = '0')
{
    $url = urlencode($url);
    echo '<img src="https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=' . $EC_level . '|' . $margin . '&chl=' . $url . '" alt="QR code" width="' . $size . '" height="' . $size . '"/>';
}

function insert_display($condition, $valchk, $nama, $value, $class, $arr = '')
{
    if (is_array($arr)) {
        foreach ($arr as $x => $valueadd) {
            $info = chk($info) . "$x='$valueadd' ";
        }
    }

    if ($condition != $valchk) {
        ?>
        <input name="<?php echo $nama ?>" type="text" id="<?php echo $nama ?>" class="<?php echo $class ?>"
               value="<?php echo $value ?>" <?php echo chk($info) ?>/>
        <?php
    } else {
        echo $value;
    }
}

function insert_display_textarea($condition, $valchk, $nama, $class = '', $value)
{
    if ($condition != $valchk) {
        ?>
        <textarea name="<?php echo $nama ?>" class="<?php echo $class ?>"><?php echo $value ?></textarea>
        <?php
    } else {
        echo nl2br($value);
    }
}

function insert_display_upload($condition, $valchk, $nama, $class = '', $value)
{
    global $db;

    if ($db == 'Mysql') {
        $objDB = new Mysql();
    } elseif ($db == 'Pg') {
        $objDB = new Pg();
    }

    if ($condition != $valchk) {
        ?>
        <input type="file" class="<?php echo $class ?>" name="<?php echo $nama ?>" id="<?php echo $nama ?>"/>
        <?php
        $dataupl = $objDB->display('upload', '*', "id='$value'");
        if (is_array($dataupl)) {
            extract($dataupl);
            ?>
            <br><a href="<?php echo chk($link) ?>" target="_blank"><?php echo chk($nama); ?></a>
            <?php
        }
    } else {
        $dataupl = $objDB->display('upload', '*', "id='$value'");
        if (is_array($dataupl)) {
            extract($dataupl);
            ?>
            <a href="<?php echo chk($link) ?>" target="_blank"><?php echo chk($nama); ?></a><br>
            <?php
        }

    }
}

function insert_update_button($input, $baca)
{
    if ($input != '' and $baca == '')
        $button = 'Kemaskini';
    elseif ($input == '' and $baca == '')
        $button = 'Simpan';
    else
        $button = 'xkemaskini';

    return $button;
}

function link_cetak($a, $papar, $cetak)
{
    if ($cetak == 1)
        echo $papar;
    else {
        $a = str_replace('"', '\"', $a);
        echo "<a $a >$papar</a>";
    }

}

function sts_sql($sts, $msjok, $msjko = '')
{
    if ($msjko == '') {
        $msjko = $sts;
    }
    if ($sts == '1') {
        alert($msjok);
    } else {
        alert($msjko);
    }
}

function fungsi_info($fail, $tugas, $peratus)
{
    $namafail = str_replace('m/', '', chk($fail));
    $senaraim = array();
    if (file_exists('projekinfo.json')) {
        $jsonString = file_get_contents('projekinfo.json');
        $datax = json_decode($jsonString, TRUE);
        if (is_array($datax)) {
            foreach ($datax as $keyx => $entry) {
                array_push($senaraim, $datax[$keyx]['fail']);
                if ($datax[$keyx]['fail'] == $namafail) {
                    $datax[$keyx]['modify'] = date("d M Y h:i:s A", filemtime('m/' . $namafail));
                    $datax[$keyx]['peratus'] = $peratus;
                    $datax[$keyx]['tugas'] = $tugas;
                }
            }
        }
    }

    if (array_search($namafail, $senaraim) === FALSE) {
        $keyx = @$keyx + 1;
        $data = array('fail' => $namafail,
            'modified' => date("d M Y h:i:s A", filemtime('m/' . $namafail)),
            'peratus' => $peratus,
            'tugas' => $tugas);
        $datax[$keyx] = $data;
    }

    $newJsonString = json_encode($datax);
    file_put_contents('projekinfo.json', $newJsonString);
}

function sts_aktif($name, $select, $class = '')
{
    echo "<select name=\"$name\" class=\"$class\" id=\"$name\">";
    echo "<option value=''>$null</option>";
    if (strcmp(trim($select), 'A') == 0) {
        echo "<option selected=\"selected\" value='A'>Aktif</option>";
    } else {
        echo "<option value='A'>Aktif</option>";
    }
    if (strcmp(trim($select), 'T') == 0) {
        echo "<option selected=\"selected\" value='T'>Tidak Aktif</option>";
    } else {
        echo "<option value='T'>Tidak Aktif</option>";
    }
    echo "</select>";
}

function chk_sts($val)
{
    if ($val == 'A') {
        ?>
        <div class="switch" data-on="success" data-off="danger">
            <input class="toggle" controls-row type="checkbox" checked disabled="disabled"/>
        </div>
        <?php
    } elseif ($val == 'T') {
        ?>
        <div class="switch" data-on="success" data-off="danger">
            <input class="toggle" controls-row type="checkbox" disabled="disabled"/>
        </div>
        <?php
    }
}

function fail2nama($namafail)
{
    $namafail = str_replace('_', ' ', $namafail);
    $namafail = str_replace('m/m.', '', $namafail);

    return $namafail;
}

function papar_upload($name, $id_upload, $action = '')
{
    global $key;

    if ($action != '') {

        ?>
        <label class="ace-file-input">
            <input type="file" name="<?php echo $name ?>" id="id-input-file-2">
            <span class="ace-file-container" data-title="Pilih">
            <span class="ace-file-name" data-title="No File ...">
                <i class=" ace-icon fa fa-upload"></i></span>
        </span><a class="remove" href="#">
                <i class=" ace-icon fa fa-times"></i></a>
        </label>
        <?php
        if (chk($id_upload) != '') {
            $src = Db::display('fw_uploads', 'nama,link', "id='" . chk($id_upload) . "'");
            ?>
            <div class="input-group">
                <input type="text" class="form-control" value="<?php echo $src['nama'] ?>">
                <div class="input-group-addon"><a href="action.dload?id=<?php echo emenu($key, $id_upload) ?>"
                                                  target="_blank"><i class="ace-icon fa fa-download"
                                                                     title="Download"></i></a></div>
                <div class="input-group-addon"><a href="<?php echo $action . "&id_upload=$id_upload" ?> "><i
                                class="ace-icon fa fa-remove red" title="Remove"></i></a></div>
            </div>
            <?php
        }
    } else {
        if (chk($id_upload) != '') {
            $src = Db::display('fw_uploads', 'nama,link', "id='" . chk($id_upload) . "'");
            ?>
            <div class="input-group">
                <input type="text" class="form-control" value="<?php echo $src['nama'] ?>">
                <div class="input-group-addon"><a href="action.dload?id=<?php echo emenu($key, $id_upload) ?>"
                                                  target="_blank"><i class="ace-icon fa fa-download"
                                                                     title="Download"></i></a></div>
            </div>
            <?php
        }
    }

}

function pilih_masa($name, $select, $class)
{
    $selectjam = chgdate('h', $select);
    $selectminit = chgdate('i', $select);
    $selectampm = chgdate('A', $select);

    echo "<select name=\"" . $name . "[jam]" . "\" class=\"$class\" id=\"" . $name . "[jam]" . "\">";
    for ($x = '1'; $x <= '12'; $x++) {
        $x = str_pad($x, 2, '0', STR_PAD_LEFT);
        if ($selectjam == $x) {
            echo "<option selected=\"selected\" value=" . $x . ">" . $x . "</option>";
        } else {
            echo "<option value=" . $x . ">" . $x . "</option>";
        }
    }
    echo "</select>";

    echo "<select name=\"" . $name . "[minit]" . "\" class=\"$class\" id=\"" . $name . "[minit]" . "\">";
    for ($x = '0'; $x <= '59'; $x++) {
        $x = str_pad($x, 2, '0', STR_PAD_LEFT);
        if ($selectminit == $x) {
            echo "<option selected=\"selected\" value=" . $x . ">" . $x . "</option>";
        } else {
            echo "<option value=" . $x . ">" . $x . "</option>";
        }
    }
    echo "</select>";

    echo "<select name=\"" . $name . "[ampm]" . "\" class=\"$class\" id=\"" . $name . "[ampm]" . "\">";
    if (strcmp(trim($selectampm), 'AM') == 0) {
        $selectedam = "selected";
    } elseif (strcmp(trim($selectampm), 'PM') == 0) {
        $selectedpm = "selected";
    }

    echo "<option " . chk($selectedam) . " value=\"AM\">AM</option>";
    echo "<option " . chk($selectedpm) . " value=\"PM\">PM</option>";
    echo "</select>";
}

function tkh($var)
{
    if ($var) {
        if ($var != '0000-00-00') {
            $var = date('d-m-Y', strtotime($var));
            return @$var;
        }
    }
}

function tkhmasa($var)
{
    if ($var) {
        if ($var != '0000-00-00 00:00:00') {
            $var = date('d-m-Y h:i A', strtotime($var));
            return @$var;
        }
    }
}

function masa($var)
{
    if ($var != '') {
        $var = date('h:i A', strtotime($var));
    }
    return @$var;
}

function pg_array_parse($literal)
{
//        if ($literal == '') return;
//        preg_match_all('/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER);
//        $values = [];
//        foreach ($matches as $match) {
//            $values[] = $match[3] != '' ? stripcslashes($match[3]) : (strtolower($match[2]) == 'null' ? null : $match[2]);
//        }
    return @$literal;
}

function tambahhari($tkh, $bilhari, $masa = 'N')
{
    if ($tkh != '') {
        if ($masa == 'Y') {
            $addms = ' h:i A';
        }
        $tkh = date('d-m-Y' . @$addms, strtotime($tkh . "+$bilhari days"));
    }

    return @$tkh;
    //$date1 = str_replace('-', '/', $date);
}

function bezatkh($tkh1, $tkh2)
{
    if ($tkh1 != '' and $tkh2 != '') {
        $date1 = date_create($tkh1);
        $date2 = date_create($tkh2);
        $diff = date_diff($date1, $date2);
        $day = $diff->format("%R%a");
        return $day;
    }
}

function droptime($name, $select, $interval = '30', $class = '')
{
    ?>
    <select name="<?php echo $name ?>" id="<?php echo $name ?>" class="<?php echo $class ?>">
        <?php
        for ($hours = 0; $hours < 24; $hours++) // the interval for hours is '1'
        {
            for ($mins = 0; $mins < 60; $mins += $interval) // the interval for mins is '30'
            {
                $jam = str_pad($hours, 2, '0', STR_PAD_LEFT);
                $min = str_pad($mins, 2, '0', STR_PAD_LEFT);

                if ($jam > '12') {
                    $jamshow = str_pad($jam - 12, 2, '0', STR_PAD_LEFT);
                    $ampm = 'PM';
                } else {
                    if ($jam == '00') {
                        $jamshow = '12';
                    } else {
                        $jamshow = $jam;
                    }

                    if ($jam == '12') {
                        $ampm = 'PM';
                    } else {
                        $ampm = 'AM';
                    }
                }
                $minshow = $min;
                $jamminit = $jam . ':' . $min;
                if (strcmp(trim($jamminit), trim(@$select)) == '-3') {
                    echo '<option selected="selected" value="' . $jamminit . '">' . $jamshow . ':' . $minshow . ' ' . $ampm . '</option>';
                } else {
                    echo '<option value="' . $jamminit . '">' . $jamshow . ':' . $minshow . ' ' . $ampm . '</option>';
                }
            }
        }
        ?>
    </select>
    <?php
}

function bezamasa($start, $end)
{
    $uts['start'] = strtotime($start);
    $uts['end'] = strtotime($end);
    if ($uts['start'] !== -1 && $uts['end'] !== -1) {
        if ($uts['end'] >= $uts['start']) {
            $diff = $uts['end'] - $uts['start'];
            if ($days = intval((floor($diff / 86400))))
                $diff = $diff % 86400;
            if ($hours = intval((floor($diff / 3600))))
                $diff = $diff % 3600;
            if ($minutes = intval((floor($diff / 60))))
                $diff = $diff % 60;
            $diff = intval($diff);
            $result = array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff);
            return ($result);
        } else {
            trigger_error("Ending date/time is earlier than the start date/time", E_USER_WARNING);
            echo "Ending date/time is earlier than the start date/time";
        }
    } else {
        trigger_error("Invalid date/time data detected", E_USER_WARNING);
        echo "Invalid date/time data detected";
    }
    return (false);
}

function chkdb()
{
    global $db;
    if ($db == 'Pg') {
        $objDB = new Pg();
    } elseif ($db == 'Mysql') {
        $objDB = new Mysql();
    } elseif ($db == 'Oci') {
        $objDB = new Oci();
    }

    return $objDB;
}

function droplistfor($name, $min, $max, $select, $class, $null = '')
{
    echo "<select name=\"$name\" class=\"$class\" id=\"$name\">";
    echo "<option value=''>$null</option>";
    for ($x = $min; $x <= $max; $x++) {
        if ($select == $x) {
            echo "<option selected=\"selected\" value=" . $x . ">" . $x . "</option>";
        } else {
            echo "<option value=" . $x . ">" . $x . "</option>";
        }
    }
    echo "</select>";
}

function droplistforselect2($name, $min, $max, $select, $class, $null = '')
{
    echo "<select name=\"$name\" class=\"$class\" id=\"$name\" data-size=\"0\" data-live-search=\"true\" data-style=\"btn-white\">";
    echo "<option value=''>$null</option>";
    for ($x = $min; $x <= $max; $x++) {
        if ($select == $x) {
            echo "<option selected=\"selected\" value=" . $x . ">" . $x . "</option>";
        } else {
            echo "<option value=" . $x . ">" . $x . "</option>";
        }
    }
    echo "</select>";
}

function droplisthour($name, $select, $class)
{
    echo "<select name=\"$name\" class=\"$class\" id=\"$name\">";
    for ($x = '1'; $x <= '12'; $x++) {
        $x = str_pad($x, 2, '0', STR_PAD_LEFT);
        if ($select == $x) {
            echo "<option selected=\"selected\" value=" . $x . ">" . $x . "</option>";
        } else {
            echo "<option value=" . $x . ">" . $x . "</option>";
        }
    }
    echo "</select>";
}

function droplistmulti($name, $selected, $class, $dataselect)
{
    ?>
    <select name="<?php echo $name ?>" id="<?php echo $class ?>" class="<?php echo $class ?>" multiple>
        <?php
        foreach ($dataselect as $group => $child) {
            ?>
            <optgroup label="<?php echo $group ?>">
                <?php
                foreach ($child as $value => $display) {
                    if (is_numeric(array_search($value, $selected))) {
                        ?>
                        <option value="<?php echo $value ?>" selected><?php echo $display ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $value ?>"><?php echo $display ?></option>
                        <?php
                    }
                }
                ?>
            </optgroup>
            <?php
        }
        ?>
    </select>
    <?php
}

function exclude($data, $fields)
{
    $afield = explode(',', $fields);
    foreach ($afield as $x => $field) {
        unset($data[$field]);
    }
    return $data;
}

function datagrid($data, $totalreturned, $bilrow)
{
    if ($data) {
        extract($data);

        $page = chk($page);
        $perpage = chk($perpage);
        $kurang = chk($kurang);
        $pagekurang = chk($pagekurang);
        $tambah = chk($tambah);
        $pagetambah = chk($pagetambah);
        $pageakhir = chk($pageakhir);

        $output['bilrow'] = $perpage;

        if ($kurang == ' < ') {
            $output['page'] = $pagekurang;
        } elseif ($kurang == ' << ') {
            $output['page'] = 0;
        } elseif ($tambah == ' > ') {
            $output['page'] = $pagetambah;
        } elseif ($tambah == ' >> ') {
            $output['page'] = $pageakhir;
        } else {
            $output['page'] = $page;
        }

        if (@$fw_cari_manual != '') {
            $cari = @$fw_cari_manual;
        }
        $output['cari'] = chk($cari);
    }

    if ($output['bilrow'] == '') {
        $output['bilrow'] = $bilrow;
    }

    $output['limit'] = chk($totalreturned) / $output['bilrow'];
    $output['limittambah'] = (int)$output['limit'] + 1;

    if ($output['page'] <= -1) {
        $output['page'] = 0;
    } elseif ($output['page'] >= $output['limittambah']) {
        $output['page'] = $output['limittambah'] - 1;
    }

    if ($output['page'] == '') {
        $output['page'] = '0';
    }
    $output['page_end'] = $output['page'] * $output['bilrow'];

    return $output;

}

function increase($OLDQUEUE, $targetID)
{
    $counter = 0;
    $temp = "";


    foreach ($OLDQUEUE as $a => $b) {
        //print "masuk foreach";
        $counter++;

        if ($a == $targetID and $counter != 1) //jika id sasaran dijumpai DAN bukan yg pertama
        {
            $NEWQUEUE[$a] = ($counter - 1);
            $NEWQUEUE[$temp] = $counter;
        }


        if ($a != $targetID) {
            $temp = $a;
            $NEWQUEUE[$a] = $counter;
        }

    }

    return $NEWQUEUE;
}

function reduce($OLDQUEUE, $targetID)
{
    $counter = 0;
    $temp = "";
    foreach ($OLDQUEUE as $a => $b) {
        $counter++;

        if ($a == $targetID) {
            $NEWQUEUE[$a] = ($counter + 1);
            $temp = $counter;
        }


        if ($a != $targetID) {
            if ($temp) {
                $NEWQUEUE[$a] = $temp;
                $temp = "";
            } else {
                $NEWQUEUE[$a] = $counter;
            }
        }
    }
    return $NEWQUEUE;
}

function include_view($file, $cetak = '')
{
    if ($cetak == 1) {
        $file = '../' . $file;
    }

    require_once "$file";
}

function array_upper($data)
{
    if (is_array($data)) {
        foreach ($data as $row => $value) {
            $newdata[$row] = strtoupper($value);
        }
        return $newdata;
    }
}

function percent($val, $total)
{
    if ($val != '' and $total != '') {
        $peratus = $val / $total * 100;
        $peratus = number_format($peratus);
        return $peratus;
    }
}

function pr($arr)
{
    if (is_array($arr)) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    } else {
        echo 'Not array';
    }
}

function table_label($data, $classtr = '', $classth = '', $rowno = '', $edit = '', $del = '')
{
    if (is_array($data)) {
        ?>
        <tr class="<?php echo @$classtr ?>">
            <?php
            if ($rowno != '') {
                ?>
                <th width="5%" class="<?php echo @$classth ?>">No.</th>
                <?php
            }
            foreach (array_slice($data[1], 1) as $label => $v) {
                $label = field2label($label);
                ?>
                <th class="<?php echo @$classth ?>"><?php echo $label ?></th>
                <?php
            }
            if ($edit != '') {
                ?>
                <th width="5%" class="<?php echo @$classth ?>"><?php echo $edit ?></th>
                <?php
            }
            if ($del != '') {
                ?>
                <th width="5%" class="<?php echo @$classth ?>"><?php echo $del ?></th>
                <?php
            }
            ?>
        </tr>
        <?php
    }
}

function table_row($data, $class = '', $rowno = '', $edit = '', $del = '')
{
    if (is_array($data)) {
        foreach ($data as $row => $value) {
            ?>
            <tr>
                <?php
                if ($rowno != '') {
                    ?>
                    <td width="5%" class="<?php echo @$class ?>"><?php echo $row ?>.</td>
                    <?php
                }
                $linkdata = '';
                foreach ($data[$row] as $label => $v) {
                    if ($linkdata == '') {
                        $linkdata = '&' . $label . '=' . $v;
                    } else {
                        ?>
                        <td class="<?php echo @$class ?>"><?php echo $v; ?></td>
                        <?php
                    }
                }
                if ($edit != '') {
                    ${$edit . $row} = str_replace('edit=1', 'edit=1' . $linkdata, $edit);
                    ?>
                    <td width="5%" class="<?php echo @$class ?>"><?php echo ${$edit . $row} ?></td>
                    <?php
                }
                if ($del != '') {
                    ${$del . $row} = str_replace('del=1', 'del=1' . $linkdata, $del);
                    ?>
                    <td width="5%" class="<?php echo @$class ?>"><?php echo ${$del . $row}; ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    }
}

function field2label($label)
{
    if ($label != '') {
        return ucwords(str_replace('_', ' ', substr($label, strpos($label, '_') + 1)));
    }
}

function array2get($arr)
{
    if (is_array($arr)) {
        foreach ($arr as $label => $value) {
            $getlist = @$getlist . "&" . @$label . "=" . urlencode(@$value) . "";
        }
        $getlist = substr(@$getlist, 1);
        return $getlist;
    }
}

function bulan_bm($bulan, $format = 0)
{
    $arr_bulan = array('Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember');
    $arr_bulan_1 = array('Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogos', 'Sept', 'Okt', 'Nov', 'Dis');
    $arr_papar = array('0' => $arr_bulan, '1' => $arr_bulan_1);
    return $arr_papar[$format][$bulan - 1];
}

function chkwajib($post, $fields)
{

    $afield = explode(',', $fields);
    foreach ($afield as $x => $field) {
        if (@$post["$field"] == '') {
            $semak["chk_$field"] = 1;
        }
    }
    return @$semak;
}

function int_only($var)
{
    if (isset($var)) {
        return (int)filter_var($var, FILTER_SANITIZE_NUMBER_INT);
    }
}

function timeago($date)
{
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60", "60", "24", "30", "12", "10");

    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);

        if ($diff < 24 && $i < 2) {
            return $diff . " " . $strTime[$i] . "s ago ";
        } else {
            return tkhmasa($date);
        }
    }
}

function encrypt_decrypt($action, $data)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        //$string = base64_encode(serialize($data));
        $output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);
        //$output = base64_encode(serialize($output));
    }
    return $output;
}

?>