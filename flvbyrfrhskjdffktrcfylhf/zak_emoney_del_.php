<?php //��������� ' header <p> showerr != s_param
require_once ("lock.php");
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_GET['id']) && trim($_GET['id']) != '') {$id = $_GET['id'];}
else {$_SESSION['mzak_emoney'] = 3; header('Location: zak_emoney.php?id='.$_GET['id'].''); exit();}

		//������� ������ ��� ������ ������ � ��
	$result = mysql_query ("DELETE FROM zakaz WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mzak_emoney'] = 2; header('Location: zak_emoney.php?id='.$id.''); exit();}
	unset($_GET['id']);
	$_SESSION['mzak_emoney'] = 4; header('Location: zak_emoney.php?id='.$id.''); exit();
?>