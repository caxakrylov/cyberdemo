<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['mdel_post'])) {
$mdel_post = $_SESSION['mdel_post'];
unset($_SESSION['mdel_post']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Удаление товара</title>
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
	<div class='cnt_title2'><h1 id='main'>Удаление товара</h1></div>
    <div class='cnt_txt'><div class='pp'><p>Выберите товар.</p></div></div>
    <?php 
		if (isset($mdel_post)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Произошла ошибка, не верный id товара!';
			$msg_a[4] = 'Товар удален!.';
			
			if ($mdel_post == 4) {echo "<div id='msgok'><p>".$msg_a[$mdel_post]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$mdel_post]."</p></div>";}
	} 
	?>
    <form action='del_post_.php' method='post'>
    
    <?php
		$result = mysql_query('SELECT title,id FROM data',$db);  
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
    <div class='TVVC'><p><input name='sub_del_post' type='submit' value='Удалить товар'></div>
    </form>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>