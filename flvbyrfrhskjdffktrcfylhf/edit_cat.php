<?php
require_once ('lock.php');
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if (isset($_SESSION['medit_cat'])) {
$medit_cat = $_SESSION['medit_cat'];
unset($_SESSION['medit_cat']);
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
<title>Cyberdemo.ru &mdash; ����������������� &mdash; �������������� ���������</title>
</head>
<body>
<!--HEADER-->
<div id='header'>
</div>
<table id='main_tbl'>
  <tr>
  	<!--����� ���������-->
    <td id='left'>
    	<div id='nav'><?php include ('blocks/nav_left.php');?></div>
    </td>
    <!--�������-->
    <td id='cnt'>
	<div class='cnt_title2'><h1 id='main'>�������������� ���������</h1></div>
    <div class='cnt_txt'><div class='pp'><p>������� ���������.</p></div></div>
	<?php 
	if (!isset($id))
	{
		echo "<div class='cnt_txt'><div class='pp'>";
		$result = mysql_query('SELECT title,id FROM categories',$db);      
		$myrow = mysql_fetch_array($result);
		$i=1;
		do 
		{
			echo "<p>".$i.". <a href='edit_cat.php?id=".$myrow['id']."'>".$myrow['title']."</a></p>";
			$i++;
		}
		while ($myrow = mysql_fetch_array($result));
		echo "</div></div>";
	} 
	else 
	{
		$result = mysql_query('SELECT * FROM categories WHERE id='.$id.'',$db);      
		$myrow = mysql_fetch_array($result);
	
   		if (isset($medit_cat)) {
			$msg_a[2] = '��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
			$msg_a[3] = '�� ����� �� ��� ����������, <strong>��������� �� ��������!</strong>';
			$msg_a[4] = '��������� ��������.';
			
			if ($medit_cat == 4) {echo "<div id='msgok'><p>".$msg_a[$medit_cat]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$medit_cat]."</p></div>";}
		}
		$tmp_title =$myrow['title']; $tmp_meta_d =$myrow['meta_d']; $tmp_meta_k = $myrow['meta_k']; $tmp_text = $myrow['text']; $page = $myrow['page'];
	?>
		<form action='edit_cat_.php' method='post'>
       	
        <div class='TVVC'><p>������� ��������(���������) ���������:</p></div>
		<input class='VVZ' name='title' type='text' value='<?php echo $tmp_title;?>' maxlength='255'>

    	<div class='TVVC'><p>������� Meta Description:</p></div>
		<input class='VVZ' name='meta_d' type='text' value='<?php echo $tmp_meta_d;?>' maxlength='255'>

        <div class='TVVC'><p>������� Meta Keywords:</p></div>
		<input class='VVZ' name='meta_k' type='text' value='<?php echo $tmp_meta_k;?>' maxlength='255'>      
  
        <div class='TVVC'><p>������� ������ ����� �������� ���������:</p></div>
        <textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>      

        <div class='TVVC'><p>������� �������� �������� (��� ��������):</p></div>
		<input class='VVZ' name='page' type='text' value='<?php echo $page;?>' maxlength='40'>      
           
        <input name='id' type='hidden' value='<?php echo $id;?>'>   
                  
		<div class='TVVC'><p><input name='sub_edit_cat' type='submit' value='��������� ���������'></div>

	   </form>		
	<?php }?>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>