<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['mnew_cat'])) {
$mnew_cat = $_SESSION['mnew_cat'];
unset($_SESSION['mnew_cat']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Добавление новой категории</title>
</head>
<body>
<!--HEADER-->
<div id='header'>
</div>
<table id='main_tbl'>
  <tr>
  	<!--ЛЕВАЯ НАВИГАЦИЯ-->
    <td id='left'>
    	<div id='nav'><?php include ('blocks/nav_left.php');?></div>
    </td>
    <!--КОНТЕНТ-->
    <td id='cnt'>
	<div class='cnt_title2'><h1 id='main'>Добавление новой категории</h1></div>
	<div class='cnt_txt'><div class='pp'><p>Пожалуйста заполните поля.</p></div></div>
	<?php 
		if (isset($mnew_cat)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Вы ввели не всю информацию, <strong>категория не добавлена!</strong>';
			$msg_a[4] = 'Категория добавлена.';

			if ($mnew_cat == 4) {echo "<div id='msgok'><p>".$msg_a[$mnew_cat]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$mnew_cat]."</p></div>";}
		}
		$tmp_title =''; $tmp_meta_d =''; $tmp_meta_k = ''; $tmp_text = ''; $page = '';
	?>
		<form action='new_cat_.php' method='post'>
     	
        <div class='TVVC'><p>Введите название(заголовок) категории:</p></div>
		<input class='VVZ' name='title' type='text' value='<?php echo $tmp_title;?>' maxlength='255'>

    	<div class='TVVC'><p>Введите Meta Description:</p></div>
		<input class='VVZ' name='meta_d' type='text' value='<?php echo $tmp_meta_d;?>' maxlength='255'>

        <div class='TVVC'><p>Введите Meta Keywords:</p></div>
		<input class='VVZ' name='meta_k' type='text' value='<?php echo $tmp_meta_k;?>' maxlength='255'>      
  
        <div class='TVVC'><p>Введите полный текст описания категории:</p></div>
        <textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>      

        <div class='TVVC'><p>Введите название страницы (без пробелов):</p></div>
		<input class='VVZ' name='page' type='text' value='<?php echo $page;?>' maxlength='40'>      
                        
		<div class='TVVC'><p><input name='sub_new_cat' type='submit' value='Добавить категорию'></div>
                  
		 </form>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>