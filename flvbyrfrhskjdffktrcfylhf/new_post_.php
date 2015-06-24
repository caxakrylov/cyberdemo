<?php
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}

if (isset($_POST['sub_new_post']) and $_POST['sub_new_post'] == 'Добавить товар') 
{

if (isset($_POST['title']) && isset($_POST['meta_d']) && isset($_POST['meta_k']) && isset($_POST['descr']) && isset($_POST['text']) && isset($_POST['money']) && isset($_POST['cat']) && isset($_POST['page']) && trim($_POST['title']) !='' && trim($_POST['meta_d']) !='' && trim($_POST['meta_k']) !='' && trim($_POST['descr']) !='' && trim($_POST['text']) !='' && trim($_POST['money']) !='' && trim($_POST['cat']) !='' && trim($_POST['page']) !='') 
{$title = $_POST['title']; $meta_d = $_POST['meta_d']; $meta_k = $_POST['meta_k']; $descr = $_POST['descr']; $text = $_POST['text']; $money = $_POST['money']; $cat = $_POST['cat']; $page = $_POST['page'];}
else {$_SESSION['mnew_post'] = 3; header('Location: new_post.php'); exit();}

		//Создаем запрос для записи данных в БД
		$result = mysql_query("INSERT INTO data (title,meta_d,meta_k,description,text,money,cat,page) VALUES('".$title."','".$meta_d."','".$meta_k."','".$descr."','".$text."','".$money."','".$cat."','".$page."')",$db);
		if (!$result) {$_SESSION['mnew_post'] = 2; header('Location: new_post.php'); exit();}
		
		unset($_POST['title']); unset($_POST['meta_d']); unset($_POST['meta_k']); unset($_POST['descr']);	unset($_POST['text']); unset($_POST['money']); unset($_POST['cat']); unset($_POST['page']); 
		$_SESSION['mnew_post'] = 4; header('Location: new_post.php'); exit();
} else {header('Location: index.php'); exit();} //не нажата кнопка 
?>