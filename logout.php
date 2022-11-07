<?php

//Include GP config file
include_once 'gpConfig.php';

//Unset token and user data from session
unset($_SESSION['token']);
//unset($_SESSION['userData']);
unset($_SESSION[$GLOBALS['fw_sistem']]);

if (isset($_SESSION['userData']['email'])) {
    //Destroy entire session
    session_destroy();
    //Reset OAuth access token
    $gClient->revokeToken();
}

if (isset($_SESSION['userData']['upmid'])) {
    //Destroy entire session
    include_once("../upmidsso/CAS.php");
    phpCAS::client(CAS_VERSION_2_0, 'upm-id.upm.edu.my', 443, '/ssostudent/');
    // SSL!
// phpCAS::setCasServerCACert(“./CACert.pem”);//this is relative to the cas client.php file
    phpCAS::setNoCasServerValidation();

    session_destroy();
    phpCAS::logoutWithRedirectService("http://php7.upm.edu.my/seashell4");
}

//Destroy entire session
session_destroy();
//Redirect to homepage
header("Location:index.php");
?>