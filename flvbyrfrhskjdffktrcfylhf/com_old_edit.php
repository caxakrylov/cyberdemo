<?php //НОРМАЛЬНО ' header <p> showerr != s_param
require_once ("lock.php");
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if ($_SERVER['HTTP_REFERER'] == '') {header('Location: index.php'); exit();}
if (isset($_SESSION['mcomm_old_edit'])) {
$mcomm_old_edit = $_SESSION['mcomm_old_edit'];
unset($_SESSION['mcomm_old_edit']);
}

if (isset($_GET['id']) && trim($_GET['id']) != '' && isset($_GET['post']) && trim($_GET['post']) != '') 
{$id = $_GET['id']; $post = $_GET['post'];}
else {$_SESSION['mcomm_old'] = 3; header('Location: comm_old.php?post='.$_GET['post'].''); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Редактирование комментария</title>
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
	<div class='cnt_title2'><h1 id='main'>Редактирование комментария</h1></div>
    <div class='cnt_txt'><div class='pp'><p>Внесите изменения.</p></div></div>
	<?php 
		$result = mysql_query('SELECT * FROM comments WHERE id='.$id.'',$db);      
		$myrow = mysql_fetch_array($result);
	
   		if (isset($mcomm_old_edit)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе! Пожалуйста, напишите об этом администратору admin@cyberdemo.ru';
			$msg_a[3] = 'Вы ввели не всю информацию, <strong>комментарий не изменен!</strong>';
			$msg_a[4] = 'Комментарий изменен.';
			
			if ($mcomm_old_edit == 4) {echo "<div id='msgok'><p>".$msg_a[$mcomm_old_edit]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$mcomm_old_edit]."</p></div>";}
		}
		$author =$myrow['author']; $tmp_text =$myrow['text'];
		?>
		<form action='com_old_edit_.php' method='post'>
        
        <div class='TVVC'><p>Автор комментария:</p></div>
		<input class='VVZ' name='author' type='text' value='<?php echo $author;?>' maxlength='255'>

        <div class='TVVC'><p>Текст комментария:</p></div>
        <textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>      
       	
        <input name='id' type='hidden' value='<?php echo $id;?>'>
        <input name='post' type='hidden' value='<?php echo $post;?>'>        
                        
		<div class='TVVC'><p><input name='sub_comm_old_edit' type='submit' value='Изменить'></div>
        </form>
        
        <div class='cnt_footer'><p><strong><a href='comm_old.php?post=<?php echo $post;?>' title='Вернуться на предыдущую страницу'>&laquo; Вернуться назад</a></strong></p></div>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>