<?php 
require_once ("lock.php");
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_del_post']) and $_POST['sub_del_post'] == '������� �����') 
{
	if (isset($_POST['id']) && trim($_POST['id']) != '') { $id = $_POST['id'];}
	else {$_SESSION['mdel_post'] = 3; header('Location: del_post.php'); exit();}

		//������� �����
	$result = mysql_query ("DELETE FROM data WHERE id='".$id."'",$db);
	if (!$result) {$_SESSION['mdel_post'] = 2; header('Location: del_post.php'); exit();}
		//������� ����������� � ������\
	$result = mysql_query ("DELETE FROM comments WHERE post='".$id."'",$db);
	if (!$result) {$_SESSION['mdel_post'] = 2; header('Location: del_post.php'); exit();}	
	unset($_POST['id']); 
	$_SESSION['mdel_post'] = 4; header('Location: del_post.php'); exit();
} else {header('Location: index.php'); exit();} //�� ������ ������ 


?>

