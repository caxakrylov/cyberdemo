<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if(isset($_GET['page']) and $_GET['page']!=''){
$page=$_GET['page']; $page=s_param($page);
if(!preg_match('/^[a-z0-9_-]+$/',$page)){header('Location: index.php');exit();}
if(strlen($page)>40){header('Location: index.php'); exit();}
}else{header('Location: index.php'); exit();}
if(isset($_SESSION['v_post'])){$v_post=$_SESSION['v_post']; unset($_SESSION['v_post']);}
$result=mysql_query("SELECT * FROM data WHERE page='".$page."'",$db);
if(!$result){$_SESSION['showerr']=2; header('Location: showerr'); exit();}
if(mysql_num_rows($result)>0){
$myrow=mysql_fetch_array($result);
$new_view=$myrow['view']+1;
$id=$myrow['id'];
$update=mysql_query("UPDATE data SET view='".$new_view."' WHERE id='".$id."'",$db);
$resCAT=mysql_query("SELECT title,page FROM categories WHERE id='".$myrow['cat']."'",$db);
$rowCAT=mysql_fetch_array($resCAT);
}else{$_SESSION['showerr']=1; header('Location: showerr'); exit();}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta name="Description" content="<?php echo $myrow['meta_d'];?>"/>
<meta name="Keywords" content="<?php echo $myrow['meta_k'];?>"/>
<meta name="Language" content="russian"/>
<link href="../style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="../img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"/>
<title>&raquo; ������� ������, ����� CS 1.6 WCG, ESWC, Extreme Masters, DreamHack, KODE5. CS 1.6 �������� <?php echo $rowCAT['title'].' &raquo; '.$myrow['title']; ?></title>
</head>
<body>
<div id='header'><?php include ('blocks/header.php'); ?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td><td id='cnt'>
<?php
if(isset($_SESSION['tovar'])){
foreach($_SESSION['tovar'] as $key=>$val){
if($key==$id and $val>=1){$trash="<a href='../cart' title='���� ".$myrow['title']." � ��� � �������'>&raquo; � �������</a>"; break;}
else{$trash="<a href='../".$page."-add".$id."' title='�������� � ������� ���� ".$myrow['title']."'>&raquo; �������� � �������</a>";}
}}else{$trash="<a href='../".$page."-add".$id."' title='�������� � ������� ���� ".$myrow['title']."'>&raquo; �������� � �������</a>";}
echo "<div id='cnt_TiPOST'><h2 style='background-image:url(../img/".$rowCAT['page']."-c.gif)'>".$rowCAT['title']." &raquo; <strong style='text-decoration:underline;'>".$myrow['title']."</strong></h2></div><div class='cnt_txt'><div class='pp'>".$myrow['text']."</div></div><div class='cnt_footer'><p class='m'>���������: <strong>".$myrow['money']." ���.</strong></p></div><div class='cnt_footer'><p style='background-image:url(../img/rating/".$myrow['rating'].".gif);'><strong>".$trash."</strong></p></div>";
$rCOMM=mysql_query("SELECT * FROM comments WHERE post='".$id."' ORDER BY id DESC",$db);
if(mysql_num_rows($rCOMM)>0){
echo "<div class='cnt_btitle'><a name='comments'><p id='Tcomm'>������:</p></a></div>";
$myCOMM=mysql_fetch_array($rCOMM);
do{echo "<div class='comm'><div class='Tp'>�����: <strong>".$myCOMM['author']."</strong> (".$myCOMM['date']." �.)</div></div><pre class='comm_text'><p>".$myCOMM['text']."</p></pre>";}
while($myCOMM = mysql_fetch_array($rCOMM));}
echo "<div id='TaddC'><p>�������� ��� �����:</p></div>";
if(isset($v_post)){
$msg_a[2]='��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
$msg_a[3]='������� ����� ������.';
$msg_a[4]='������� ������� ����� ������, ������ 500 ��������.';
$msg_a[5]='����� ����� �������� ������ �� ���� ��������, ����������� ���������, ������ ����������, ��������: "_ : � ()"';
$msg_a[6]='������� �����.';
$msg_a[7]='����� ����� �������� ������ �� ���� ��������, ����������� ���������, ���� � ������� �������������.';
$msg_a[8]='����� ������ ���� �� ������ 4-� �������� � �� ����� 50.';
$msg_a[9]='�� ����� �� ������ ����� � ��������.';
echo "<div id='msg'><p>".$msg_a[$v_post]."</p></div>";
$tmp_login=$_SESSION['comm']['login']; $tmp_text=$_SESSION['comm']['text']; unset($_SESSION['comm']);
}else{$tmp_login=''; $tmp_text='';}?>
<form action='comment' method='post'>
<div class='TVVC'><p>�����:</p></div>
<input class='VVC' name='login' type='text' value='<?php echo $tmp_login;?>' maxlength='50'>
<div class='TVVC'><p>����� ������:</p></div>
<textarea class='VVC' name='text' rows='8'><?php echo $tmp_text;?></textarea>
<input name='id' type='hidden' value='<?php echo $id;?>'>
<input name='page' type='hidden' value='<?php echo $page;?>'>
<div class='TVVC'><div id='CaBlock'>
<img id='imageid' src="../blocks/ca/?<?php echo session_name()?>=<?php echo session_id()?>">
<a href='#' onclick="document.getElementById('imageid').src='../blocks/ca/?rnd='+Math.random();return false" title='������� ����� �������� ��������'>��������</a>
<div id='txt'>������� ����� � ��������:</div>
<input class='VVC' name='ca' type='text' maxlength='15'>
<input class='Butt' name='sub_com' type='submit' value='�������� �����'>
</div></div></form></td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href="http://ak87.ru" title="���� ���������� �������">ak87.ru</a></p></div><?php include('blocks/schet.php');?></body></html>
