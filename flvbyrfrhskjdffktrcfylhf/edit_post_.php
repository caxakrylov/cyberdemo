<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_edit_post']) and $_POST['sub_edit_post'] == 'Сохранить изменения') 
{

if (isset($_POST['title']) && isset($_POST['meta_d']) && isset($_POST['meta_k']) && isset($_POST['descr']) && isset($_POST['text']) && isset($_POST['money']) && isset($_POST['page']) && isset($_POST['rating']) && isset($_POST['main_last']) && isset($_POST['cat']) && isset($_POST['sort']) && isset($_POST['id']) && trim($_POST['title']) !='' && trim($_POST['meta_d']) !='' && trim($_POST['meta_k']) !='' && trim($_POST['descr']) !='' && trim($_POST['text']) !='' && trim($_POST['money']) !='' && trim($_POST['cat']) !='' && trim($_POST['id']) != '' && trim($_POST['page']) != '' && trim($_POST['rating']) != '' && trim($_POST['main_last']) != '' && trim($_POST['sort']) != '')
{$title = $_POST['title']; $meta_d = $_POST['meta_d']; $meta_k = $_POST['meta_k']; $descr = $_POST['descr']; $text = $_POST['text']; $money = $_POST['money']; $cat = $_POST['cat']; $id = $_POST['id']; $page = $_POST['page']; $rating = $_POST['rating']; $main_last = $_POST['main_last']; $sort = $_POST['sort'];}
else {$_SESSION['medit_post'] = 3; header('Location: edit_post.php?id='.$_POST['id'].''); exit();}

		//Создаем запрос для записи данных в БД
	$result = mysql_query ("UPDATE data SET title='".$title."', meta_d='".$meta_d."', meta_k='".$meta_k."', description='".$descr."', text='".$text."', money='".$money."', cat='".$cat."', page='".$page."', rating='".$rating."', main_last='".$main_last."', sort='".$sort."' WHERE id='".$id."'",$db);
		
	if (!$result) {$_SESSION['medit_post'] = 2; header('Location: edit_post.php?id='.$id.''); exit();}	
	unset($_POST['title']); unset($_POST['meta_d']); unset($_POST['meta_k']); unset($_POST['descr']);	unset($_POST['text']); unset($_POST['money']); unset($_POST['cat']); unset($_POST['id']); unset($_POST['page']); unset($_POST['rating']); unset($_POST['main_last']); unset($_POST['sort']); 
	$_SESSION['medit_post'] = 4; header('Location: edit_post.php?id='.$id.''); exit();
} else {header('Location: index.php'); exit();} //не нажата кнопка 
?>