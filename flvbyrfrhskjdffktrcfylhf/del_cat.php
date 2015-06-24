<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['mdel_cat'])) {
$mdel_cat = $_SESSION['mdel_cat'];
unset($_SESSION['mdel_cat']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Удаление категории</title>
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
	<div class='cnt_title2'><h1 id='main'>Удаление категории</h1></div>
	<div class='cnt_txt'><div class='pp'><p>Выберите товар.</p></div></div>
    <?php 
	if (isset($mdel_cat)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Произошла ошибка, не верный id категории!';
			$msg_a[5] = 'В категории которую вы хотите удалить есть товары!';
			$msg_a[4] = 'Категория удалена!';
			
			if ($mdel_cat == 4) {echo "<div id='msgok'><p>".$msg_a[$mdel_cat]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$mdel_cat]."</p></div>";}
		}
	?>
	<form action='del_cat_.php' method='post'>
    <?php
		$result = mysql_query('SELECT title,id FROM categories',$db);   
		if (mysql_num_rows($result) == 0) {echo "<div id='msgok'><p>В базе нет записей!</p></div>
		</td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div></body></html>"; exit();}   
		$myrow = mysql_fetch_array($result);
		do 
		{
			echo "<div class='TVVC'><p>
			<input name='id' type='radio' value='".$myrow['id']."'>
			<label>".$myrow['title']."</label></p></div>";
		}
		while ($myrow = mysql_fetch_array($result));
	?>
    <div class='TVVC'><p><input name='sub_del_cat' type='submit' value='Удалить категорию'></div>
	</form>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>