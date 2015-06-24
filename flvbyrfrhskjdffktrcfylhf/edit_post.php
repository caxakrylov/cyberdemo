<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['medit_post'])) {
$medit_post = $_SESSION['medit_post'];
unset($_SESSION['medit_post']);
}
if (isset($_GET['id'])) {$id = $_GET['id'];}
if (isset($_GET['sort']) && $_GET['sort']==1){$sortRes = mysql_query('ALTER TABLE data ORDER BY sort',$db);
	if (!$sortRes) {$_SESSION['showerr'] = 2; echo "<html><head> <meta http-equiv='Refresh' content='0; URL=showerr.php'> </head></html>"; exit();}}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Редактирование товара</title>
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
	<div class='cnt_title2'><h1 id='main'>Редактирование товара</h1></div>
    <div class='cnt_txt'><div class='pp'><p>Внесите изменения.</p></div></div>
	<?php 
	if (!isset($id))
	{
		echo "<div class='cnt_txt'><div class='pp'>";
		$result = mysql_query('SELECT title,id FROM data',$db);      
		$myrow = mysql_fetch_array($result);
		$i=1;
		do 
		{
			echo "<p>".$i.". <a href='edit_post.php?id=".$myrow['id']."'>".$myrow['title']."</a></p>";
			$i++;
		}
		while ($myrow = mysql_fetch_array($result));
		echo "<br/><p><a href='edit_post.php?sort=1'>СОРТИРОВАТЬ</a></p>";
		echo "</div></div>";
	} 
	else 
	{
		$result = mysql_query('SELECT * FROM data WHERE id='.$id.'',$db);      
		$myrow = mysql_fetch_array($result);
	
   		if (isset($medit_post)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Вы ввели не всю информацию, <strong>товар не изменен!</strong>';
			$msg_a[4] = 'Товар изменен.';
			
			if ($medit_post == 4) {echo "<div id='msgok'><p>".$msg_a[$medit_post]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$medit_post]."</p></div>";}
		}
		$tmp_title = $myrow['title']; $tmp_meta_d = $myrow['meta_d']; $tmp_meta_k = $myrow['meta_k']; $tmp_descr= $myrow['description']; $tmp_text =$myrow['text']; $tmp_money = $myrow['money']; $tmp_page = $myrow['page']; $tmp_rating = $myrow['rating']; $tmp_main_last = $myrow['main_last']; $tmp_sort = $myrow['sort'];
		?>
		<form action='edit_post_.php' method='post'>
        <div class='TVVC'><p>Введите название(заголовок) товара:</p></div>
		<input class='VVZ' name='title' type='text' value='<?php echo $tmp_title;?>' maxlength='255'>

    	<div class='TVVC'><p>Введите Meta Description:</p></div>
		<input class='VVZ' name='meta_d' type='text' value='<?php echo $tmp_meta_d;?>' maxlength='255'>

        <div class='TVVC'><p>Введите Meta Keywords:</p></div>
		<input class='VVZ' name='meta_k' type='text' value='<?php echo $tmp_meta_k;?>' maxlength='255'>      
  
        <div class='TVVC'><p>Введите краткое описание товара с тэгами абзацев:</p></div>
        <textarea class='VVC' name='descr' rows='8'><?php echo $tmp_descr;?></textarea>        

        <div class='TVVC'><p>Введите полный текст описания товара:</p></div>
        <textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>      
         
        <div class='TVVC'><p>Введите цену товара:</p></div>
		<input class='VVZ' name='money' type='text' value='<?php echo $tmp_money;?>' maxlength='7'>     
  
        <div class='TVVC'><p>Введите название страницы (без пробелов):</p></div>
		<input class='VVZ' name='page' type='text' value='<?php echo $tmp_page;?>' maxlength='40'> 
  
        <div class='TVVC'><p>Введите рейтинг (значение от 0 до 5):</p></div>
		<input class='VVZ' name='rating' type='text' value='<?php echo $tmp_rating;?>' maxlength='1'>       

        <div class='TVVC'><p>Поместить на главной (последние обновления), 1 - да, 0 - нет:</p></div>
		<input class='VVZ' name='main_last' type='text' value='<?php echo $tmp_main_last;?>' maxlength='1'>                     

		<div class='TVVC'><p>Номер для сортировки на странице:</p></div>
		<input class='VVZ' name='sort' type='text' value='<?php echo $tmp_sort;?>' maxlength='5'>   

		<div class='TVVC'><p>Выберете категорию товара:</p></div>
        <div class='TVVC'><p><select name='cat'>
            <?php 
            $result2 = mysql_query('SELECT title,id FROM categories',$db);
			if (!$result2) {$_SESSION['showerr'] = 2; echo "<html><head> <meta http-equiv='Refresh' content='0; URL=showerr.php'> </head></html>"; exit();}
            
            if (mysql_num_rows($result2) > 0)
            {
            	$myrow2 = mysql_fetch_array($result2); 
				
				do
				{
					if ($myrow['cat'] == $myrow2['id'])
					{
						echo "<option value = '".$myrow2['id']."' selected>".$myrow2['title']."</option>";
					} 
					else
					{
						echo "<option value='".$myrow2['id']."'>".$myrow2['title']."</option>";
					}
				}
				while ($myrow2 = mysql_fetch_array($result2));
	        } else {$_SESSION['showerr'] = 1; echo "<html><head> <meta http-equiv='Refresh' content='0; URL=showerr.php'> </head></html>"; exit();}
            ?>
        </select></p></div>
        <input name='id' type='hidden' value='<?php echo $id;?>'>
        <div class='TVVC'><p><input name='sub_edit_post' type='submit' value='Сохранить изменения'></div>
		 </form>
 		<?php }?>
        
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>