<?php
session_start();
require_once 'admin.php';

//Include Google client library 
include_once 'framework/plugin/googleoauth/Google_Client.php';
include_once 'framework/plugin/googleoauth/contrib/Google_Oauth2Service.php';

$server = str_replace("www.", "", $_SERVER["SERVER_NAME"]);

if ($server == $url_local) {
    # localhost
    $redirectURL = 'http://localhost/seashell4';
} elseif ($server == $url_development) {
    # development
    $redirectURL = 'http://php7.upm.edu.my/seashell4';
} elseif ($server == $url_live) {
    # live
    $redirectURL = 'http://php7.upm.edu.my/seashell4';
} else {
    echo "Tiada nama server yang sah!";
}

/*
 * Configuration and setup Google API
 */
$clientId = '853983073340-9ip8i48ocrlhbdipqapn7th596545hgs.apps.googleusercontent.com';
$clientSecret = '4bCI7QeQrkyZQ3kRvCJvvocX';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to '.$GLOBALS['fw_sistem']);
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>