<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_comm_old_edit']) and $_POST['sub_comm_old_edit'] == 'Изменить') 
{
if (isset($_POST['author']) && isset($_POST['text']) && isset($_POST['id']) && isset($_POST['post']) && trim($_POST['author']) !='' && trim($_POST['text']) !='' && trim($_POST['id']) != '' && trim($_POST['post']) != '') 
{$author = $_POST['author']; $text = $_POST['text']; $id = $_POST['id']; $post = $_POST['post']; }
else {$_SESSION['mcomm_old_edit'] = 3; header('Location: com_old_edit.php?id='.$_POST['id'].'&post='.$_POST['post'].''); exit();}

		//Создаем запрос для записи данных в БД
	$result = mysql_query ("UPDATE comments SET author='".$author."', text='".$text."' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['mcomm_old_edit'] = 2; header('Location: com_old_edit.php?id='.$id.'&post='.$post.''); exit();}
	unset($_POST['author']); unset($_POST['text']); unset($_POST['id']); 
	$_SESSION['mcomm_old_edit'] = 4; header('Location: com_old_edit.php?id='.$id.'&post='.$post.''); exit();
} else {header('Location: index.php'); exit();} //не нажата кнопка 
?>