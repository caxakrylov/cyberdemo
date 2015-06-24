<?php
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if(isset($_GET['del']) and $_GET['del']!='' and $_SERVER['HTTP_REFERER']!=''){
$del=$_GET['del']; $del=s_param($del);
if(!preg_match('/^[0-9]+$/',$del)){header('Location: index.php'); exit();}
if($del>99999 or $del<1){header('Location: index.php'); exit();}
}else{header('Location: index.php'); exit();}
if(isset($_SESSION['tovar'])){
	$strkey=0;
	foreach($_SESSION['tovar'] as $key=>$val){
	if($val>=1 and $key==$del){$_SESSION['tovar'][$key]=0; continue;}
	elseif($val>=1){$strkey=1;}
	}
	if($strkey==0){unset($_SESSION['tovar']);}
	header('Location: cart'); exit();
}else{header('Location: cart'); exit();}
?>