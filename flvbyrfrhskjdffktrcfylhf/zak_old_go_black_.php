<?php //��������� ' header <p> showerr != s_param
require_once ("lock.php");
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_GET['id']) && trim($_GET['id']) != '') {$id = $_GET['id'];}
else {$_SESSION['mzak_old'] = 3; header('Location: zak_old.php?id='.$_GET['id'].''); exit();}

		//������� ������ ��� ������ ������ � ��
	$result = mysql_query ("UPDATE zakaz SET adm='2' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mzak_old'] = 2;  header('Location: zak_old.php?id='.$id.''); exit();}
	unset($_GET['id']);
	$_SESSION['mzak_old'] = 5; header('Location: zak_old.php?id='.$id.''); exit();
?>