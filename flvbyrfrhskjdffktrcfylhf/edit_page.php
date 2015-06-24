<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['medit_page'])) {
$medit_page = $_SESSION['medit_page'];
unset($_SESSION['medit_page']);
}
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Редактирование основных страниц</title>
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
	<div class='cnt_title2'><h1 id='main'>Редактирование основных страниц</h1></div>
    <div class='cnt_txt'><div class='pp'><p>Внесите изменения.</p></div></div>
	<?php 
	if (!isset($id))
	{
		echo "<div class='cnt_txt'><div class='pp'>";
		$result = mysql_query('SELECT page,id FROM settings',$db);      
		$myrow = mysql_fetch_array($result);
		$i=1;
		do 
		{
			echo "<p>".$i.". <a href='edit_page.php?id=".$myrow['id']."'>".$myrow['page']."</a></p>";
			$i++;
		}
		while ($myrow = mysql_fetch_array($result));
		echo "</div></div>";
	} 
	else 
	{
		$result = mysql_query('SELECT * FROM settings WHERE id='.$id.'',$db);      
		$myrow = mysql_fetch_array($result);
	
   		if (isset($medit_page)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Вы ввели не всю информацию, <strong>страница не изменена!</strong>';
			$msg_a[4] = 'Страница изменена.';
			
			if ($medit_page == 4) {echo "<div id='msgok'><p>".$msg_a[$medit_page]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$medit_page]."</p></div>";}
		}
		$tmp_title =$myrow['title']; $tmp_title2 =$myrow['title2']; $tmp_meta_d =$myrow['meta_d']; $tmp_meta_k = $myrow['meta_k']; $tmp_text = $myrow['text']; $tmp_page= $myrow['page'];
	?>
		<form action='edit_page_.php' method='post'>
        
        <div class='TVVC'><p>Введите название(заголовок) страницы:</p></div>
		<input class='VVZ' name='title' type='text' value='<?php echo $tmp_title;?>' maxlength='255'>
        
        <div class='TVVC'><p>Введите заголовок на странице:</p></div>
		<input class='VVZ' name='title2' type='text' value='<?php echo $tmp_title2;?>' maxlength='255'>       

    	<div class='TVVC'><p>Введите Meta Description:</p></div>
		<input class='VVZ' name='meta_d' type='text' value='<?php echo $tmp_meta_d;?>' maxlength='255'>

        <div class='TVVC'><p>Введите Meta Keywords:</p></div>
		<input class='VVZ' name='meta_k' type='text' value='<?php echo $tmp_meta_k;?>' maxlength='255'>      
  
        <div class='TVVC'><p>Введите текст страницы:</p></div>
        <textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>      

        <div class='TVVC'><p>Имя файла страницы:</p></div>
		<input class='VVZ' name='page' type='text' value='<?php echo $tmp_page;?>' maxlength='255'>      
           
        <input name='id' type='hidden' value='<?php echo $id;?>'>   
                  
		<div class='TVVC'><p><input name='sub_edit_page' type='submit' value='Сохранить изменения'></div>

        </form>
	<?php }?>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>