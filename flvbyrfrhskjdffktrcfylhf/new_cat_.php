<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_new_cat']) and $_POST['sub_new_cat'] == 'Добавить категорию') 
{
if (isset($_POST['title']) && isset($_POST['meta_d']) && isset($_POST['meta_k']) && isset($_POST['text']) && isset($_POST['page']) && trim($_POST['title']) !='' && trim($_POST['meta_d']) !='' && trim($_POST['meta_k']) !='' && trim($_POST['text']) !='' && trim($_POST['page']) !='') 
{$title = $_POST['title']; $meta_d = $_POST['meta_d']; $meta_k = $_POST['meta_k']; $text = $_POST['text']; $page = $_POST['page'];}
else {$_SESSION['mnew_cat'] = 3; header('Location: new_cat.php'); exit();}

		//Создаем запрос для записи данных в БД
		$result = mysql_query("INSERT INTO categories (title,meta_d,meta_k,text,page) VALUES('".$title."','".$meta_d."','".$meta_k."','".$text."','".$page."')",$db);
		if (!$result) {$_SESSION['mnew_cat'] = 2; header('Location: new_cat.php'); exit();}
		
		unset($_POST['title']); unset($_POST['meta_d']); unset($_POST['meta_k']); unset($_POST['text']); unset($_POST['page']); 
		$_SESSION['mnew_cat'] = 4; header('Location: new_cat.php'); exit();
} else {header('Location: index.php'); exit();} //не нажата кнопка 
?>