<?php

include "setting.php";
include "framework/emenudmenu.php";

unset($_SESSION[$GLOBALS['fw_sistem']]['username']);


if (isset($_POST['user']) and isset($_POST['pass'])) {
    # check server from local
    if($server == $url_local){
        if ($_POST['user'] == 'admin' and $_POST['pass'] == 'xs2admin') {
            $username = $_POST['user'];
        }
        else if ($_POST['user'] == 'technician' and $_POST['pass'] == 'xs2technician') {
            $username = $_POST['user']; 
        }
        else if ($_POST['user'] == 'staff hpupm' and $_POST['pass'] == 'xs2staff') {
            $username = $_POST['user']; 
        }
        else if ($_POST['user'] == 'technician manager' and $_POST['pass'] == 'xs2technician') {
            $username = $_POST['user']; 
        }
        else {
            $result = General::verifyUser($_POST['user'] , $_POST['pass']);
            $obj = json_decode($result, true);

            if ($obj['status'] == 1){
                $username = $_POST['user'];
            }
            alert('Selamat Datang ke SeaShells');
        }
    }  else{
        alert ('Maklumat Tidak Sah');
        }
}

if (in_array(@$_SESSION[$GLOBALS['fw_sistem']]['superadmin'], $GLOBALS['fw_superadmin'])) {
    $username = @$_POST['username'];
    $usernow = $_SESSION[$GLOBALS['fw_sistem']]['superadmin'];
    $chguser = 1;
}

if (isset($username)) {
    # buat sql untuk semak peranan pengguna 
    if ($_POST['user'] == 'admin' and $_POST['pass'] == 'xs2admin'){
    $pengguna = array('email' => 'admin', 'name' => 'Administrator', 'role' => '1');

}  else if ($_POST['user'] == 'technician' and $_POST['pass'] == 'xs2technician'){
    $pengguna = array('email' => 'technician', 'name' => 'Technician', 'role' => '2');

}
    else if ($_POST['user'] == 'staff hpupm' and $_POST['pass'] == 'xs2staff'){
    $pengguna = array('email' => 'staff hpupm', 'name' => 'Staff HPUPM', 'role' => '3');

}
    else if ($_POST['user'] == 'technician manager' and $_POST['pass'] == 'xs2technician'){
    $pengguna = array('email' => 'technician manager', 'name' => 'Technician Manager', 'role' => '4');

}
else {
    # check if user exist in users
    $upmidExist = Db::chkval('users','1',"u_upm_id='{$_POST['user']}'",'Y');

    if($upmidExist){
        $condition= "u_upm_id='{$_POST['user']}'";
        $userData = Db::display('users','u_upm_id,u_name,u_rr_id,u_id',$condition,'Y');

        if(is_array($userData)){
            extract($userData);

            $pengguna = array('email' => "$u_upm_id", 'name' => "$u_name", 'role' => "$u_rr_id", 'u_id'=>"$u_id");
        }
    }
}

    if (is_array($pengguna)) {
        $_SESSION[$GLOBALS['fw_sistem']] = 
        array(
            "username" => $pengguna['email'],
            "nama" => $pengguna['name'],
            "peranan" => $pengguna['role'],
            "u_id"=> $pengguna['u_id']
        );

        if (@$chguser == '') {
            if (in_array($username, $GLOBALS['fw_superadmin'])) {
                $_SESSION[$GLOBALS['fw_sistem']]['superadmin'] = $username;
            }
        } else if (@$chguser == 1) {
            $_SESSION[$GLOBALS['fw_sistem']]['superadmin'] = $usernow;
        }
        gopage("action.do");

    } else {
        alert('Pengguna tidak wujud');
        gopage("logout.php", 3);
    }
} else {
    gopage("logout.php");
}
?>