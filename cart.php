<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();
include('blocks/bd.php');
if(isset($_SESSION['msg_cart'])){
$msg_cart=$_SESSION['msg_cart'];
unset($_SESSION['msg_cart']);}
if($_SERVER['HTTP_REFERER']==''){header('Location: index.php'); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta name="Language" content="russian"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<title>&raquo; ������� ������, ����� CS 1.6 WCG, ESWC, Extreme Masters, DreamHack, KODE5. CS 1.6 �������� &raquo; ��� �������</title>
</head>
<body>
<div id='header'><?php include('blocks/header.php');?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td>
<td id='cnt'>
<?php
if(!stristr($_SERVER['HTTP_REFERER'],'/cart')){$_SESSION['ref']=$_SERVER['HTTP_REFERER'];}
if(isset($_SESSION['tovar'])){
$result=mysql_query('SELECT id,title,money,page,cat FROM data',$db);
if(!$result){$_SESSION['showerr']=2; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
if(mysql_num_rows($result)>0){
$myrow=mysql_fetch_array($result);
echo "<div class='cnt_title2'><h2 id='cart'>��� �������</h2></div>
<div class='cnt_txt'><div class='pp'><strong style='color:#F40;font-size:12px;'>�</strong>����� �������� ���� ������:</div></div>";
if(isset($msg_cart)){
$msg_a[2]='��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
$msg_a[4]='�� ���������� ������ ���������.';
echo "<div id='msgMT'><p>".$msg_a[$msg_cart]."</p></div>";}
echo "<form action='cartref' method='post'><div class='TVVCr'><div class='CartB'><div class='td1'><strong>��������</strong></div><div class='td2'><strong>�����������</strong></div><div class='td3'><strong>���������</strong></div></div></div>";
$sum=0;
$i=1;
do{
foreach($_SESSION['tovar'] as $key=>$val){
if($key==$myrow['id'] and $val>=1){
$respage=mysql_query("SELECT page FROM categories WHERE id='".$myrow['cat']."'",$db);
$pagecat=mysql_fetch_array($respage);
echo "<div class='TVVCr'><div class='CartB'><div class='td1'>".$i.". <a href='".$pagecat['page']."/".$myrow['page']."' title='�������� �������� ����� ".$myrow['title']."'>".$myrow['title']."</a></div><input class='VVC' name='".$key."' type='text' maxlength='2' value='".$val."' title='����������� ������ ".$myrow['title']."'><div class='td3'>".$myrow['money']." ���.</div><div class='td4'><a href='".$myrow['page']."-del".$key."' title='������� ���� ".$myrow['title']." �� �������'>�������</a></div></div></div>"; 
$i++; $sum+=$val*$myrow['money']; break;
}}}while($myrow = mysql_fetch_array($result));
echo "<div class='TVVCr'><div class='CartB'><div class='td2'><strong style='color:#009900'>����� �����:</strong></div><div class='td3'><strong style='color:#009900'>".$sum." ���.</strong></div><input class='Butt' name='sub_ref' type='submit' value='�����������' title='����������� ����� ����� � �������� ����������� ������'></div></div></form><div class='cnt_footer'><p><a href='".$_SESSION['ref']."' title='��������� �� ���������� ��������'>&laquo; ��������� �����</a> | <strong><a href='forma' title='������� �� �������� ���������� ������'>�������� ����� &raquo;</a></strong></p></div>";
}else{$_SESSION['showerr']=1; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
}else{echo "<div class='cnt_TPOST'><h2 id='cart'>��� �������</h2></div><div id='msg'><p>���� ������� �����!</p></div><div class='cnt_footer'><p><strong><a href='".$_SESSION['ref']."' title='��������� �� ���������� ��������'>&laquo; ��������� �����</a></strong></p></div>";}
?></td></tr> </table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href="http://ak87.ru" title="���� ���������� �������">ak87.ru</a></p></div><?php include('blocks/schet.php');?></body></html>
