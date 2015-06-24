<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_GET['id']) && trim($_GET['id']) != '' && isset($_GET['post']) && trim($_GET['post']) != '') 
{$id = $_GET['id']; $post = $_GET['post'];}
else {$_SESSION['mcomm_old'] = 3; header('Location: comm_old.php?post='.$_GET['post'].''); exit();}

		//Создаем запрос для записи данных в БД
	$result = mysql_query ("DELETE FROM comments WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mcomm_old'] = 2; header('Location: comm_old.php?post='.$post.''); exit();}
	unset($_GET['id']); unset($_GET['post']); 
	$_SESSION['mcomm_old'] = 5; header('Location: comm_old.php?post='.$post.''); exit();
?>