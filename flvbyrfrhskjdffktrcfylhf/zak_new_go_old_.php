<?php
require_once ("lock.php");
session_start();
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_GET['id']) && trim($_GET['id']) != '') {$id = $_GET['id'];}
else {$_SESSION['mzak_new'] = 3; header('Location: zak_new.php?id='.$_GET['id'].''); exit();}

		//Создаем запрос для записи данных в БД
	$result = mysql_query ("UPDATE zakaz SET adm='1' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mzak_new'] = 2;  header('Location: zak_new.php?id='.$id.''); exit();}
	unset($_GET['id']);
	$_SESSION['mzak_new'] = 4; header('Location: zak_new.php?id='.$id.''); exit();
?>