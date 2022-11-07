<?PHP
include_once("../../upmidsso/CAS.php");
 phpCAS::client(CAS_VERSION_2_0,'upm-id.upm.edu.my',443,'/ssostudent/');
 // SSL!
// phpCAS::setCasServerCACert(“./CACert.pem”);//this is relative to the cas client.php file
phpCAS::setNoCasServerValidation();

if (phpCAS::isAuthenticated())
 {
    session_destroy();
phpCAS::logoutWithRedirectService("http://php7.upm.edu.my/seashell4");
// phpCAS::logout();
 }else{
 header('location: ../index.php');
 }
?>

