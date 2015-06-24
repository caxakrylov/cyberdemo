<?php
require_once ('lock.php');
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if (isset($_SESSION['mnew_post'])) {
$mnew_post = $_SESSION['mnew_post'];
unset($_SESSION['mnew_post']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; ����������������� &mdash; ���������� ������ ������</title>
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
	<div class='cnt_title2'><h1 id='main'>���������� ������ ������</h1></div>
	<div class='cnt_txt'><div class='pp'><p>���������� ��������� ����.</p></div></div>
	<?php 
		if (isset($mnew_post)) {
			$msg_a[2] = '��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
			$msg_a[3] = '�� ����� �� ��� ����������, <strong>����� �� ��������!</strong>';
			$msg_a[4] = '����� ��������.';
		
			if ($mnew_post == 4) {echo "<div id='msgok'><p>".$msg_a[$mnew_post]."</p></div>"; }
			else {echo "<div id='msg'><p>".$msg_a[$mnew_post]."</p></div>";}
		}
		$tmp_title =''; $tmp_meta_d =''; $tmp_meta_k = ''; $tmp_descr= ''; $tmp_text = ''; $tmp_money = ''; $page = '';
	?>
        <form action='new_post_.php' method='post'>
        
    	<div class='TVVC'><p>������� ��������(���������) ������:</p></div>
		<input class='VVZ' name='title' type='text' value='<?php echo $tmp_title;?>' maxlength='255'>

    	<div class='TVVC'><p>������� Meta Description:</p></div>
		<input class='VVZ' name='meta_d' type='text' value='<?php echo $tmp_meta_d;?>' maxlength='255'>

        <div class='TVVC'><p>������� Meta Keywords:</p></div>
		<input class='VVZ' name='meta_k' type='text' value='<?php echo $tmp_meta_k;?>' maxlength='255'>      
  
        <div class='TVVC'><p>������� ������� �������� ������ � ������ �������:</p></div>
        <textarea class='VVC' name='descr' rows='8'><?php echo $tmp_descr;?></textarea>        

        <div class='TVVC'><p>������� ������ ����� �������� ������:</p></div>
        <textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>      
         
        <div class='TVVC'><p>������� ���� ������:</p></div>
		<input class='VVZ' name='money' type='text' value='<?php echo $tmp_money;?>' maxlength='7'>     
  
        <div class='TVVC'><p>������� �������� �������� (��� ��������):</p></div>
		<input class='VVZ' name='page' type='text' value='<?php echo $page;?>' maxlength='40'>           

		<div class='TVVC'><p>�������� ��������� ������:</p></div>
		<div class='TVVC'><p><select name='cat'>
            <?php 
            
            $result = mysql_query('SELECT title,id FROM categories',$db);
			if (!$result) {$_SESSION['showerr'] = 2; echo "<html><head> <meta http-equiv='Refresh' content='0; URL=showerr.php'> </head></html>"; exit();}
            
            if (mysql_num_rows($result) > 0)
            {
            	$myrow = mysql_fetch_array($result); 
				do
           		{
					echo "<option value='".$myrow['id']."'>".$myrow['title']."</option>";
           		}
           		while ($myrow = mysql_fetch_array($result));
            
            } else {$_SESSION['showerr'] = 1; echo "<html><head> <meta http-equiv='Refresh' content='0; URL=showerr.php'> </head></html>"; exit();}
            ?>
        </select></p></div>
         
		<div class='TVVC'><p><input name='sub_new_post' type='submit' value='�������� �����'></div>
        </form>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>

