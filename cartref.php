<?php
session_start();
include ('blocks/bd.php');
if($_SERVER['HTTP_REFERER']==''){header('Location: index.php'); exit();}
if(isset($_POST['sub_ref']) and $_POST['sub_ref']=='Пересчитать'){
if(isset($_SESSION['tovar'])){
foreach($_SESSION['tovar'] as $key=>$val){
	if($val>=1){
		if(isset($_POST[$key])){
		if(trim($_POST[$key])==''){header('Location: cart'); exit();}
		if(!preg_match('/^[0-9]+$/',$_POST[$key])){header('Location: cart'); exit();}
		if($_POST[$key]>100 or $_POST[$key]<1){header('Location: cart'); exit();}
		$_SESSION['tovar'][$key]=$_POST[$key];}
		else{$_SESSION['msg_cart']=4; header('Location: cart'); exit();}
	}
}header('Location: cart'); exit();
}else{header('Location: cart'); exit();}
}else{header('Location: index.php'); exit();}
?>