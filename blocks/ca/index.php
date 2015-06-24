<?php
error_reporting (E_ALL);

header('Expires: Wed, 01 Jan 1997 00:00:00 GMT');
header('Last-Modified: Wed, 01 Jan 1997 00:00:00 GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

include('kcaptcha.php');
if(isset($_REQUEST[session_name()])){
	session_start();
}

$captcha = new KCAPTCHA();

if($_REQUEST[session_name()]){
	$_SESSION['captcha_keystring'] = $captcha->getKeyString();
}

?>