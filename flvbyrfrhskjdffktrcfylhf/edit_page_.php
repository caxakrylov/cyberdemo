<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_edit_page']) and $_POST['sub_edit_page'] == 'Сохранить изменения') 
{
if (isset($_POST['title']) && isset($_POST['title2']) && isset($_POST['meta_d']) && isset($_POST['meta_k']) && isset($_POST['text']) && isset($_POST['page']) && isset($_POST['id']) && trim($_POST['title']) !='' && trim($_POST['title2']) !='' && trim($_POST['meta_d']) !='' && trim($_POST['meta_k']) !='' && trim($_POST['text']) !='' && trim($_POST['page']) !='' && trim($_POST['id']) != '') 
{$title = $_POST['title']; $title2 = $_POST['title2']; $meta_d = $_POST['meta_d']; $meta_k = $_POST['meta_k']; $text = $_POST['text']; $page = $_POST['page']; $id = $_POST['id'];}
else {$_SESSION['medit_page'] = 3; header('Location: edit_page.php?id='.$_POST['id'].''); exit();}

		//Создаем запрос для записи данных в БД
	$result = mysql_query ("UPDATE settings SET title='".$title."', title2='".$title2."', meta_d='".$meta_d."', meta_k='".$meta_k."', text='".$text."', page='".$page."' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['medit_page'] = 2; header('Location: edit_page.php?id='.$id.''); exit();}	
	unset($_POST['title']); unset($_POST['title2']); unset($_POST['meta_d']); unset($_POST['meta_k']); unset($_POST['text']); unset($_POST['page']); unset($_POST['id']); 
	$_SESSION['medit_page'] = 4; header('Location: edit_page.php?id='.$id.''); exit();
} else {header('Location: index.php'); exit();} //не нажата кнопка 
?>