<?PHP
include_once("../../upmidsso/CAS.php");
phpCAS::client(CAS_VERSION_2_0,'upm-id.upm.edu.my',443,'/ssostudent/');
 // SSL!
// phpCAS::setCasServerCACert(“./CACert.pem”);//this is relative to//uu the cas client.php file
phpCAS::setNoCasServerValidation();

if (!phpCAS::isAuthenticated())
 {
 	phpCAS::forceAuthentication();
 }else{
 	
	# Session declaration here.
	$_SESSION['userData']['upmid'] = phpCAS::getUser().'@upm.edu.my';
 	header('location: ../action.check');
 }

