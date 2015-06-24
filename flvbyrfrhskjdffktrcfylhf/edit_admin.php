<?php
require_once ('lock.php');
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
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
<title>Cyberdemo.ru &mdash; ����������������� &mdash; ��������� ������� ������</title>
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
	<div class='cnt_title2'><h1 id='main'>��������� ������� ������</h1></div>
	<div class='cnt_txt'><div class='pp'><p>������� ���������.</p></div></div>
	<?php 
   		if (isset($medit_admin)) {
			$msg_a[2] = '��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
			$msg_a[3] = '�� ����� �� ��� ����������, <strong>������ �� ��������!</strong>';
			$msg_a[4] = '������ �������������� ��������.';
			$msg_a[5] = '�������� ������ ������';
			$msg_a[6] = '����������� �������';
			$msg_a[7] = '������ �� �������';
			
			if ($medit_admin == 4) {echo "<div id='msgok'><p>".$msg_a[$medit_admin]."</p></div>";}
			else {echo "<div id='msg'><p>".$msg_a[$medit_admin]."</p></div>";}
		}
	?>
		<form action='edit_admin_.php' method='post'>
        
        <div class='TVVC'><p>������� ������ ������:</p></div>
		<input class='VVZ' name='oldpass' type='text' maxlength='255'>
 
        <div class='TVVC'><p>������� ����� �����:</p></div>
		<input class='VVZ' name='newlogin' type='text' maxlength='50'>       

        <div class='TVVC'><p>������� ����� ������:</p></div>
		<input class='VVZ' name='newpass' type='text' maxlength='50'>  
          
        <div class='TVVC'><p>��������� ����� ������:</p></div>
		<input class='VVZ' name='newpass2' type='text' maxlength='50'>  
                            
		<div class='TVVC'><p><input name='sub_edit_admin' type='submit' value='��������'></div>
        
		 </form>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>