<?php 
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_del_post']) and $_POST['sub_del_post'] == 'Удалить товар') 
{
	if (isset($_POST['id']) && trim($_POST['id']) != '') { $id = $_POST['id'];}
	else {$_SESSION['mdel_post'] = 3; header('Location: del_post.php'); exit();}

		//Удалеем товар
	$result = mysql_query ("DELETE FROM data WHERE id='".$id."'",$db);
	if (!$result) {$_SESSION['mdel_post'] = 2; header('Location: del_post.php'); exit();}
		//Удаляем комментарии к товару\
	$result = mysql_query ("DELETE FROM comments WHERE post='".$id."'",$db);
	if (!$result) {$_SESSION['mdel_post'] = 2; header('Location: del_post.php'); exit();}	
	unset($_POST['id']); 
	$_SESSION['mdel_post'] = 4; header('Location: del_post.php'); exit();
} else {header('Location: index.php'); exit();} //не нажата кнопка 


?>

