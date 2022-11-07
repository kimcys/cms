<?php
//Include GP config file && User class
include_once 'gpConfig.php';

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    // Array ( [id] => 110261535433998720375 
    // [email] => hezrul@gmail.com 
    // [verified_email] => 1 
    // [name] => Hezrul Mifzal 
    // [given_name] => Hezrul 
    // [family_name] => Mifzal 
    // [link] => https://plus.google.com/+hezrul 
    // [picture] => https://lh5.googleusercontent.com/-xumu_gBk3Do/AAAAAAAAAAI/AAAAAAAALv4/aJPPIhvCQaI/photo.jpg 
    // [gender] => male 
    // [locale] => en-GB ) 

    //Storing user data into session
    $_SESSION['userData'] = $gpUserProfile;
    
    //Render facebook profile data
    if(!empty($gpUserProfile)){
        header('Location: action.check');
    }else{
        $google_api = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    $google_api = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img class="img-responsive" src="assets/images/glogin.png" alt=""/></a>';
}
?>
