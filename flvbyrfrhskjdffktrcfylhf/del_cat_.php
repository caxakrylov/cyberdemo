<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_del_cat']) and $_POST['sub_del_cat'] == 'Удалить категорию') 
{
	if (isset($_POST['id']) && trim($_POST['id']) != '') { $id = $_POST['id'];}
	else {$_SESSION['mdel_cat'] = 3; header('Location: del_cat.php'); exit();}

	//Проверяем есть ли товары в этой категории
	$result0=mysql_query ("SELECT id FROM data WHERE cat='".$id."'",$db);
	if (mysql_num_rows($result0) > 0) {$_SESSION['mdel_cat'] = 5; header('Location: del_cat.php'); exit();}
	else {
		//Создаем запрос
		$result = mysql_query ("DELETE FROM categories WHERE id='".$id."'",$db);
		if (!$result) {$_SESSION['mdel_cat'] = 2; header('Location: del_cat.php'); exit();}
		unset($_POST['id']); 
		$_SESSION['mdel_cat'] = 4; header('Location: del_cat.php'); exit();
		}
} else {header('Location: index.php'); exit();} //не нажата кнопка 


?>

