<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_GET['id']) && trim($_GET['id']) != '') {$id = $_GET['id'];}
else {$_SESSION['mzak_notstat'] = 3; header('Location: zak_notstat.php?id='.$_GET['id'].''); exit();}

		//Создаем запрос для записи данных в БД
	$result = mysql_query ("UPDATE zakaz SET adm='2', status='1' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mzak_notstat'] = 2;  header('Location: zak_notstat.php?id='.$id.''); exit();}
	unset($_GET['id']);
	$_SESSION['mzak_notstat'] = 5; header('Location: zak_notstat.php?id='.$id.''); exit();
?>