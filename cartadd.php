<?php
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if(isset($_GET['add']) and $_GET['add']!='' and $_SERVER['HTTP_REFERER']!='')
{$add=$_GET['add']; $add=s_param($add);
if(!preg_match('/^[0-9]+$/',$add)){header('Location: index.php'); exit();}
if($add>99999 or $add<1){header('Location: index.php'); exit();}
}else{header('Location: index.php'); exit();}
$result=mysql_query("SELECT id FROM data WHERE id='".$add."'",$db);
if(!$result){$_SESSION['msg_cart']=2; header('Location: cart'); exit();}
if(mysql_num_rows($result)>0){
if(isset($_SESSION['tovar'][$add]) and $_SESSION['tovar'][$add]>=1){header('Location: cart'); exit();}
$_SESSION['tovar'][$add]=1;
header('Location: '.$_SERVER['HTTP_REFERER'].''); exit();
}else{header('Location: index.php'); exit();}
?>