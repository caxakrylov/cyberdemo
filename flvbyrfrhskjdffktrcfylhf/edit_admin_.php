<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_edit_admin']) and $_POST['sub_edit_admin'] == 'Изменить') 
{
	if (isset($_POST['oldpass']) && isset($_POST['newlogin']) && isset($_POST['newpass']) && isset($_POST['newpass2']) && trim($_POST['oldpass']) !='' && trim($_POST['newlogin']) !='' && trim($_POST['newpass']) !='' && trim($_POST['newpass2']) !='') 
	{$oldpass = $_POST['oldpass']; $newlogin = $_POST['newlogin']; $newpass = $_POST['newpass']; $newpass2 = $_POST['newpass2'];}
	else {$_SESSION['medit_admin'] = 3; header('Location: edit_admin.php'); exit();}
	
	
	$result = mysql_query("SELECT pass,salt FROM userlist WHERE id='1'",$db);
	if (!$result) {$_SESSION['medit_admin'] = 2; header('Location: edit_admin.php'); exit();}	
	$myrow = mysql_fetch_array($result);
	
	$oldpass = mysql_escape_string($oldpass);
	$newlogin = mysql_escape_string($newlogin);
	$newpass = mysql_escape_string($newpass);
	
	$oldpass = md5(md5($oldpass.$myrow['salt']).$myrow['salt']);
	 
	if ($myrow['pass'] != $oldpass){
		$_SESSION['medit_admin'] = 5; header('Location: edit_admin.php'); exit();
	}
	
	if (!preg_match('/^[a-zA-Z0-9_]+$/', $newlogin)){
		$_SESSION['medit_admin'] = 6; header('Location: edit_admin.php'); exit();
	}
	
	if(strlen($newlogin) < 4 or strlen($newlogin) > 50){
		$_SESSION['medit_admin'] = 6; header('Location: edit_admin.php'); exit();
	}
	   
	if (!preg_match('/^[a-zA-Z0-9_]+$/', $newpass)){
		$_SESSION['medit_admin'] = 6; header('Location: edit_admin.php'); exit();
	}
	
	if(strlen($newpass) < 4 or strlen($newpass) > 50){
		$_SESSION['medit_admin'] = 6; header('Location: edit_admin.php'); exit(); 
	}
	
	if ($newpass != $newpass2){
		$_SESSION['medit_admin'] = 7; header('Location: edit_admin.php'); exit();
	}
	
	$salt = mt_rand(1000,9999); 
	$mdpassword = md5(md5($newpass.$salt).$salt);
	$mdlogin = md5(md5($newlogin.$salt).$salt);
	
	$result2 = mysql_query ("UPDATE userlist SET user='".$mdlogin."', pass='".$mdpassword."', salt='".$salt."' WHERE id='1'",$db);
	if (!$result2) {$_SESSION['medit_admin'] = 2; header('Location: edit_admin.php'); exit();}	
	unset($_POST['oldpass']); unset($_POST['newlogin']); unset($_POST['newpass']);  unset($_POST['newpass2']);
	$_SESSION['medit_admin'] = 4; header('Location: edit_admin.php'); exit();

} else {header('Location: index.php'); exit();} //не нажата кнопка 
?>