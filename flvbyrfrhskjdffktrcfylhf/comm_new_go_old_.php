<?php
require_once ("lock.php");
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_GET['id']) && trim($_GET['id']) != '' && isset($_GET['post']) && trim($_GET['post']) != '') 
{$id = $_GET['id']; $post = $_GET['post'];}
else {$_SESSION['mcomm_new'] = 3; header('Location: comm_new.php?post='.$_GET['post'].''); exit();}

		//������� ������ ��� ������ ������ � ��
	$result = mysql_query ("UPDATE comments SET adm='1' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mcomm_new'] = 2; header('Location: comm_new.php?post='.$post.''); exit();}
	unset($_GET['id']); unset($_GET['post']); 
	$_SESSION['mcomm_new'] = 4; header('Location: comm_new.php?post='.$post.''); exit();
?>