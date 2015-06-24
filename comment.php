<?php
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if($_SERVER['HTTP_REFERER']==''){header('Location: index.php'); exit();}
if(isset($_POST['sub_com']) and $_POST['sub_com']=='Äîáàâèòü îòçûâ'){
$_SESSION['comm']['login']=$_POST['login'];
$_SESSION['comm']['text']=$_POST['text'];
if(isset($_POST['page'])){$page=trim($_POST['page']); if($page==''){header('Location: index.php'); exit();}}
$page=s_param($page);
if(!preg_match('/^[a-z0-9_-]+$/',$page)) {header('Location: index.php'); exit();}
if(strlen($page)>40){header('Location: index.php'); exit();}
if(isset($_POST['id'])){$id=trim($_POST['id']); if($id==''){header('Location: index.php'); exit();}}
$id=s_param($id);
if(!preg_match('/^[0-9]+$/',$id)){header('Location: index.php'); exit();}
if($id>99999 or $id<1){header('Location: index.php'); exit();}
if(isset($_POST['login'])){$login=trim($_POST['login']); if($login==''){$_SESSION['v_post']=6; header('Location: '.$page.''); exit();}}
$login=s_param($login);
if(!preg_match('/^[a-zA-Z0-9à-ÿÀ-ß¸¨_]+$/',$login)){$_SESSION['v_post']=7; header('Location: '.$page.''); exit();}
if(strlen($login)<4 or strlen($login)>50){$_SESSION['v_post']=8; header('Location: '.$page.''); exit();}
if(isset($_POST['text'])){$text=trim($_POST['text']); if($text==''){$_SESSION['v_post']=3; header('Location: '.$page.''); exit();}}
$text=s_param($text);
if(!eregi("^[a-zA-Z0-9à-ÿÀ-ß¸¨_.,?!:¹\(\)\ ]+$",$text)){$_SESSION['v_post']=5; header('Location: '.$page.''); exit();}
if(strlen($text)>500){$_SESSION['v_post']=4; header('Location: '.$page.''); exit();}
if(isset($_POST['ca'])){$ca=trim($_POST['ca']); if($ca==''){$_SESSION['v_post']=9; header('Location: '.$page.''); exit();}}
$ca=s_param($ca);
if(!preg_match('/^[a-z0-9]*$/',$ca)){$_SESSION['v_post']=9; header('Location: '.$page.''); exit();}
if(strlen($ca)>6){$_SESSION['v_post']=9; header('Location: '.$page.''); exit();}
if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring']==$ca){
	$date=date('d-m-Y');
	$result=mysql_query("INSERT INTO comments (post,author,text,date) VALUES('".$id."','".$login."','".$text."','".$date."')",$db);
	if(!$result){$_SESSION['v_post']=2; header('Location: '.$page.''); exit();}
	unset($_POST['sub_com']); unset($_POST['text']); unset($_POST['id']); unset($_POST['login']); unset($_SESSION['captcha_keystring']); unset($_POST['ca']); unset($_POST['page']); header('Location: '.$page.''); exit();
}else{$_SESSION['v_post']=9; header('Location: '.$page.''); exit();}//êàï÷à
}else{header('Location: index.php'); exit();}//êíîïêà
?>