<?php
require_once ('lock.php');
session_start();
/*���������� ����*/
include ('blocks/bd.php');
/*��������� ���������� ���������*/
if (isset($_SESSION['showerr'])) {
$showerr = $_SESSION['showerr'];
unset($_SESSION['showerr']);
} else {header('Location: index.php'); exit();}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; ����������������� &mdash; ������</title>
</head>
<body>
<!--HEADER-->
<div id='header'>
	<?php include ('blocks/header.php'); ?>
</div>
<table id='main_tbl'>
  <tr>
  	<!--����� ���������-->
    <td id='left'>
    	<div id='nav'><?php include ('blocks/nav_left.php');?></div>
    </td>
    <!--�������-->
    <td id='cnt'>
    	<div class='cnt_TPOST'><h1 id='err'>������!</h1></div>
		<?php
            //�����
            $msg_a[1] = '������, � ���� ��� �������! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
            $msg_a[2] = '��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
            echo "<div id='msg'><p>".$msg_a[$showerr]."</p></div>";
		?>
		<div class='cnt_footer'><p><strong><a href='index.php' title='������� �� ������� ��������'>&laquo; �� �������</a></strong></p></div>
    </td>
  </tr> 
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>



