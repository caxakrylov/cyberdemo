<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['medit_admin'])) {
$medit_admin = $_SESSION['medit_admin'];
unset($_SESSION['medit_admin']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Изменение учетной записи</title>
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
	<div class='cnt_title2'><h1 id='main'>Изменение учетной записи</h1></div>
	<div class='cnt_txt'><div class='pp'><p>Внесите изменения.</p></div></div>
	<?php 
   		if (isset($medit_admin)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Вы ввели не всю информацию, <strong>данные не изменены!</strong>';
			$msg_a[4] = 'Данные администратора изменены.';
			$msg_a[5] = 'Неверный старый пароль';
			$msg_a[6] = 'Запрещенные символы';
			$msg_a[7] = 'Пароли не совпали';
			
			if ($medit_admin == 4) {echo "<div id='msgok'><p>".$msg_a[$medit_admin]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$medit_admin]."</p></div>";}
		}
	?>
		<form action='edit_admin_.php' method='post'>
        
        <div class='TVVC'><p>Введите старый пароль:</p></div>
		<input class='VVZ' name='oldpass' type='text' maxlength='255'>
 
        <div class='TVVC'><p>Введите новый логин:</p></div>
		<input class='VVZ' name='newlogin' type='text' maxlength='50'>       

        <div class='TVVC'><p>Введите новый пароль:</p></div>
		<input class='VVZ' name='newpass' type='text' maxlength='50'>  
          
        <div class='TVVC'><p>Повторите новый пароль:</p></div>
		<input class='VVZ' name='newpass2' type='text' maxlength='50'>  
                            
		<div class='TVVC'><p><input name='sub_edit_admin' type='submit' value='Изменить'></div>
        
		 </form>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>