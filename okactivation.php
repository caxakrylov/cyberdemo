<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();
include('blocks/bd.php');
if(isset($_SESSION['activ'])){$activ=$_SESSION['activ']; unset($_SESSION['activ']);}else{header('Location: index.php'); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta name="Language" content="russian"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<title>&raquo; ������� ������, ����� CS 1.6 WCG, ESWC, Extreme Masters, DreamHack, KODE5. CS 1.6 �������� &raquo; ������������� ������</title>
</head>
<body>
<div id='header'><?php include('blocks/header.php');?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td>
<td id='cnt'><div class='cnt_TPOST'><h2 id='form'>������������� ������</h2></div>
<?php
$msg_a[2]='��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
$msg_a[3]='������! �������� ������ ������������� ������!';
$msg_a[4]='��� ����� ������� �����������!</p></div><div class="cnt_txt"><div class="pp"><p class="Pfl">� ��������� 48 ����� ��� ����� ���������� <strong style="color:#009900">������ ��������� � ���������� ��������</strong>.<br/>�� ����� ��������, �� �������� ��� ���� ������ �� ��������� ���� ����.<br/>���������� ��� �� �������! ����� ���� �������� �� ��� ������� � ���������, ������ �� <strong><a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a></strong></p><p>� ���������, ������������� �����.</p></div></div>';
$msg_a[5]='��� ����� ��� ����������� �����!</p></div><div class="cnt_txt"><div class="pp"><p class="Pfl">���� � ��� ���� �����-���� �������, ������ �� <strong><a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a></strong></p><p>� ���������, ������������� �����.</p></div></div>';
$msg_a[7]='��������!!! ��� ����� ����� �������!</p></div><div class="cnt_txt"><div class="pp"><p class="Pfl">��� ����� ����� �������! ���� � ��� ���� �����-���� �������, ������ �� <strong><a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a></strong></p><p>� ���������, ������������� �����.</p></div></div>';
$msg_a[8]='������! �������� ������ ��� ������������� ������!';
$msg_a[9]='���� ������ ���� ������������ �����!</p></div><div class="cnt_txt"><div class="pp"><p class="Pfl">���� � ��� ���� �����-���� �������, ������ �� <strong><a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a></strong></p><p>� ���������, ������������� �����.</p></div></div>';
$msg_a[10]='���� ������ ������� ������������!</p></div><div class="cnt_txt"><div class="pp"><p class="Pfl">� ��������� 48 ����� ��� ����� ���������� <strong style="color:#009900">������ ��������� � ���������� ��������</strong>.<br/>�� ����� ��������, �� �������� ������ �� ��������� ���� ����.<br/>���������� ��� �� �������! ����� ���� �������� �� ��� ������� � ���������, ������ �� <strong><a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a></strong></p><p>� ���������, ������������� �����.</p></div></div>';
if($activ==4 or $activ==5 or $activ==9 or $activ==10){echo "<div id='msgok'><p>".$msg_a[$activ]."";}
else{echo "<div id='msg'><p>".$msg_a[$activ]."</p></div>";}
?>
<div class='cnt_footer'><p><strong><a href='index.php' title='������� �� ������� ��������'>&laquo; �� �������</a></strong></p></div></td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href="http://ak87.ru" title="���� ���������� �������">ak87.ru</a></p></div><?php include('blocks/schet.php');?></body></html>
