<?php
$keybefore=chk($_SESSION['keybefore']);
$dobefore=chk($_GET['do']);								
$dobefore=dmenu($keybefore,$dobefore);

// echo "keybefore : ".$keybefore;
// echo "<br>dobefore : ".$dobefore;

$key = rand();
$_SESSION['keybefore']=$key;

//if(dmenu($keybefore,chk($_GET['ch']))==1)
//{
//    $_SESSION['lang']=chk($_GET['lang']);
//}
$dobefore=emenu($key,$dobefore);

//if(!chk($_SESSION['lang']))
//{
//	$_SESSION['lang']='bm';	
//}

 if(@$_SESSION['lang']==''){
    $_SESSION['lang'] = $GLOBALS['fw_lang'];
}
    
if (@$_REQUEST['ch'] == 1) {
    $_SESSION['lang'] = @$_REQUEST['lang'];
}

?>