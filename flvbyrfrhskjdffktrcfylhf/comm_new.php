<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['mcomm_new'])) {
$mcomm_new = $_SESSION['mcomm_new'];
unset($_SESSION['mcomm_new']);
}
if (isset($_GET['post'])) {$post = $_GET['post'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Новые комментарии</title>
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
	<?php 
	if (!isset($post))
	{
		echo "<div class='cnt_title2'><h1 id='main'>Новые комментарии</h1></div>
				<div class='cnt_txt'><div class='pp'><p><strong>Важно!</strong> Обязательно удалять все заказы где используются запрещенные символы или SQL запросы!</p>";
		$result = mysql_query ("SELECT post FROM comments WHERE adm='0' ORDER BY id DESC",$db);
		$myrow = mysql_fetch_array($result);
		do 
		{
			if (isset($add[$myrow['post']])) {continue;}
			$add[$myrow['post']] = 1;
			$result2 = mysql_query ("SELECT title FROM data WHERE id='".$myrow['post']."'",$db);
			$myrow2 = mysql_fetch_array($result2);
			echo "<p>&raquo; <a href='comm_new.php?post=".$myrow['post']."'>".$myrow2['title']."</a></p>";
		}
		while ($myrow = mysql_fetch_array($result));
		echo "</div></div>";
	} 
	else 
	{
		$t = mysql_query ("SELECT title,page,cat FROM data WHERE id='".$post."'",$db);
		$mt = mysql_fetch_array($t);
		$respage = mysql_query("SELECT page FROM categories WHERE id='".$mt['cat']."'",$db);
		$pagecat = mysql_fetch_array($respage);
		echo "<div class='cnt_title2'><h1 id='main'>".$mt['title']."</h1></div>
		<div class='cnt_txt'><div class='pp'><p><strong>Важно!</strong> Обязательно удалять все заказы где используются запрещенные символы или SQL запросы!</p>
		<p><a href='../".$pagecat['page']."/".$mt['page']."'><strong>* Перейти на страницу описания товара</strong></a></p>
		</div></div>";
		
		$result = mysql_query("SELECT * FROM comments WHERE post='".$post."' AND adm='0' ORDER BY id DESC",$db);    
		if (mysql_num_rows($result) == 0) {echo "
		<div id='msgok'><p>В базе нет записей!</p></div>
		</td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div></body></html>"; exit();}
		$myrow = mysql_fetch_array($result);
	
   		if (isset($mcomm_new)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Не верный id или post!';
			$msg_a[4] = 'Комментарий помечен как прочитанный.';
			$msg_a[5] = 'Комментарий удален.';
			
			if ($mcomm_new == 4 || $mcomm_new ==5) {echo "<div id='msgok'><p>".$msg_a[$mcomm_new]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$mcomm_new]."</p></div>";}
		}
		
		do
		{echo "<div class='comm'><div class='Tp'>Автор: <strong>".$myrow['author']."</strong> (".$myrow['date']." г.)</div></div>
			<pre class='comm_text'><p>".$myrow['text']."</p></pre>
			
			<div class='cnt_footer'>
			<a href='comm_new_go_old_.php?id=".$myrow['id']."&post=".$myrow['post']."'>Отметить как прочитанное</a> | 
			<a href='com_new_edit.php?id=".$myrow['id']."&post=".$myrow['post']."'>Изменить</a> | 
			<a href='com_new_del.php?id=".$myrow['id']."&post=".$myrow['post']."'>Удалить</a></div>";
		}
		while ($myrow = mysql_fetch_array($result));

	 }?>
    </td>
  </tr> 
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>