<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();
include('blocks/bd.php');
if(isset($_SESSION['msg_form'])){$msg_form=$_SESSION['msg_form'];unset($_SESSION['msg_form']);}
if(!isset($_SESSION['tovar'])){header('Location: index.php'); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta name="Language" content="russian"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<title>&raquo; ������� ������, ����� CS 1.6 WCG, ESWC, Extreme Masters, DreamHack, KODE5. CS 1.6 �������� &raquo; ���������� ������</title>
</head>
<body>
<div id='header'><?php include('blocks/header.php');?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td>
<td id='cnt'>
<?php
if(isset($msg_form)){
if($msg_form==21){
echo "<div class='cnt_TPOST'><h2 id='form'>���������� ������</h2></div><div id='msgok'><p>������ �� ����� �����������!</p></div><div class='cnt_txt'><div class='pp'><strong style='color:#F40;font-size:12px;'>�</strong>� �������� ���� - <strong style='color:#009900'>".$_SESSION['form']['mail']."</strong> ���� ����������� ������ ��� <strong>������������� ������!</strong><br/>��� ������������� ������ <strong>��������� �� ������</strong> ��������� � ������. <strong style='color:#FF4400'>���� ����� �� ����� �����������, ����� �� ����� ���������!</strong><br/><br/><p>���������, ����������, ��� ��� ��������� �������� ������:<ul><li>&ndash; �������, ���, ��������: <strong>".$_SESSION['form']['fio']."</strong></li><li>&ndash; ������: <strong>".$_SESSION['form']['country']."</strong></li><li>&ndash; ������: <strong>".$_SESSION['form']['region']."</strong></li><li>&ndash; ����� (���������� �����): <strong>".$_SESSION['form']['city']."</strong></li><li>&ndash; �����, ����� ����, ��������: <strong>".$_SESSION['form']['home']."</strong></li><li>&ndash; ������ �����: <strong>".$_SESSION['form']['mindex']."</strong></li></ul></p>
<p>������ ������: <strong style='color:#009900'>���������� �������� (��� ��������� ������ � �������� ���������).</strong></p>
</div></div><div class='cnt_footer'><p><strong><a href='index.php' title='������� �� ������� ��������'>&laquo; �� �������</a></strong></p></div></td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href='http://ak87.ru' title='���� ���������� �������'>ak87.ru</a></p></div></body></html>";
unset($_SESSION['form']);exit();}

if($msg_form==25){
$IDzak=mysql_query("SELECT id FROM zakaz WHERE uniq_id='".$_SESSION['form']['InvId']."'",$db);
if(!$IDzak){$_SESSION['showerr']=2; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
if(mysql_num_rows($IDzak)>0){$IDzak_row=mysql_fetch_array($IDzak);}
else{$_SESSION['showerr']=1; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}

$mrh_login = "ak87";
$mrh_pass1 = "SKinZHHyrZYKvx4DHpCU";
$shpa = $_SESSION['form']['InvId']; //���������������� ��������
$in_curr = "RUR"; //������ ������� ������������ �� ���������
$culture = "ru";
$out_summ = $_SESSION['form']['OutSum'];
$inv_id = $IDzak_row['id'];
$descr = $_SESSION['form']['Desc'];
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shpa=$shpa"); // ������������ �������
	
echo "<div class='cnt_title2'><h2 id='form'>���������� ������</h2></div>
<div class='cnt_txt'><div class='pp'>
<p class='Pfl'>��������� ���� �������� ������ ���� ���������.</p>
<p>�� ������� ������� ������ - <strong style='color:#009900'>������������ ���������� ���������, ���������� ���������.</strong></p>
<br/>
<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>
<input type=hidden name=MrchLogin value='".$mrh_login."'>
<input type=hidden name=OutSum value='".$out_summ."'>
<input type=hidden name=InvId value='".$inv_id."'>
<input type=hidden name=Desc value='".$descr."'>
<input type=hidden name=SignatureValue value='".$crc."'>
<input type=hidden name=IncCurrLabel value='".$in_curr."'>
<input type=hidden name=Culture value='".$culture."'>
<input type=hidden name=Email value='".$_SESSION['form']['mail']."'>
<input type=hidden name=Shpa value='".$shpa."'>
<input class='PButt' type='submit' value='������� � ������ &raquo;'>
</form>
<br/>
</div></div>
<div class='cnt_footer'><p><strong><a href='index.php' title='������� �� ������� ��������'>&laquo; �� �������</a></strong></p></div></td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div></body></html>";
unset($_SESSION['form']);exit();}
}
?>
<div class='cnt_title2'><h2 id='form'>���������� ������</h2></div>
<div class='cnt_txt'><div class='pp'><p class="Pfl">��� ����������� ���������� ������ ���������� ������ ���������: <strong style="color:#009900">�.�.�, �������� �����, ������� ������ ������.</strong><br/>����� ��������� ���������� �� ������ � �������� ������ ��������� <strong><a href='delivery'>�����</a></strong>.<br/>� ������ ������������� ������� � ����������� ������ �������� �� <a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a></p></div></div>
<?php
if(isset($msg_form)){
$msg_a[1]='������, � ���� ��� �������! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
$msg_a[2]='��������� ������ ��� ��������� � ����! ����������, �������� �� ���� �������������� admin@cyberdemo.ru';
$msg_a[3]='�� ���������� ���� "�������, ���, ��������".';
$msg_a[4]='�� ���������� ���� "������".';
$msg_a[97]='�� ���������� ���� "������".';
$msg_a[5]='�� ���������� ���� "����� (���������� �����)".';
$msg_a[6]='�� ���������� ���� "�����, ����� ����, ��������".';
$msg_a[7]='�� ���������� ���� "������ �����".';
$msg_a[8]='�� ���������� ���� "��� E-Mail".';
$msg_a[9]='�������, ���, �������� ����� �������� ������ �� ���� ��������, ����������� ���������, �������� "-" � "."';
$msg_a[10]='������� ������� ������ "�������, ���, ��������".';
$msg_a[11]='���� "������" ����� �������� ������ �� ���� ��������, ����������� ���������, �������� "-" � "."';
$msg_a[12]='������� ������� ������ "������", ������ 50 ��������.';

$msg_a[98]='���� "������" ����� �������� ������ �� ���� ��������, ����������� ���������, �������� "-", "," � "."';
$msg_a[99]='������� ������� ������ "������".';

$msg_a[13]='���� "����� (���������� �����)" ����� �������� ������ �� ���� ��������, ����������� ���������, �������� "-", "," � "."';
$msg_a[14]='������� ������� ������ "����� (���������� �����)".';
$msg_a[15]='���� "�����, ����� ����, ��������" ����� �������� �� ���� ��������, ����������� ���������, ����, ��������: "- . , / : �"';
$msg_a[16]='������� ������� ������ "�����, ����� ����, ��������".';
$msg_a[17]='���� "������ �����" ����� �������� ������ �� �����.';
$msg_a[18]='������ "������ �����", ������ 10 ��������.';
$msg_a[19]='��������� "E-Mail" ����� ������������ ������.';
$msg_a[20]='������� ������� E-Mail. ������� ������ E-Mail.';
$msg_a[22]='������ �������� �����, ��������� �������� �����.';
$msg_a[23]='�� ����� �� ������ ����� � ��������.';
$msg_a[100]='�� ������ ������ ������!';
$tmp_fio=$_SESSION['form']['fio']; $tmp_country=$_SESSION['form']['country']; $tmp_region=$_SESSION['form']['region']; $tmp_city=$_SESSION['form']['city']; $tmp_home=$_SESSION['form']['home']; $tmp_mindex=$_SESSION['form']['mindex']; $tmp_mail=$_SESSION['form']['mail'];
if($_SESSION['form']['sb_oplati']=='nalojka'){$tmp_check_opl_nal='checked="checked"';}
else{$tmp_check_opl_emoney='checked="checked"';}
unset($_SESSION['form']); echo "<div id='msgMT'><p>".$msg_a[$msg_form]."</p></div>";
}else{$tmp_fio=''; $tmp_country='���������� ���������'; $tmp_region=''; $tmp_city=''; $tmp_home=''; $tmp_mindex=''; $tmp_mail=''; $tmp_check_opl_nal='checked="checked"';}
?>
<form action='goform' method='post'>
<div class='TVVC'><p>�������, ���, ��������:</p></div>
<input class='VVZ' name='fio' type='text' value='<?php echo $tmp_fio;?>' maxlength='255'>
<div class='TVVC'><p>������:</p></div>
<input class='VVZ' name='country' type='text' value='<?php echo $tmp_country;?>' maxlength="50">
<div class='TVVC'><p>������:</p></div>
<input class='VVZ' name='region' type='text' value='<?php echo $tmp_region;?>' maxlength='255'>
<div class='TVVC'><p>����� (���������� �����):</p></div>
<input class='VVZ' name='city' type='text' value='<?php echo $tmp_city;?>' maxlength='255'>
<div class='TVVC'><p>�����, ����� ����, ��������:</p></div>
<input class='VVZ' name='home' type='text' value='<?php echo $tmp_home;?>' maxlength='255'>
<div class='TVVC'><p>������ �����:</p></div>
<input class='VVZ' style='width:100px;' name='mindex' type='text' value='<?php echo $tmp_mindex;?>' maxlength='10'>
<div class='TVVC'><p>��� E-Mail:</p></div>
<input class='VVZ' name='mail' type='text' value='<?php echo $tmp_mail;?>' maxlength='100'>
<div class='TVVC'><p>--------------------------------------------------------------------------------------------</p></div>
<div class='TVVC'><p>�������� ������ ������:</p></div>
<div class='TVVC'><p><input name='sb_oplati' type='radio' <?php echo $tmp_check_opl_nal;?> value='nalojka'>���������� �������� (��� ��������� ������ � �������� ���������).</p></div>
<div class='TVVC'><p><input name='sb_oplati' type='radio' <?php echo $tmp_check_opl_emoney;?> value='e-money'>������������ ���������� ���������, ���������� ���������.</p></div>
<div class='TVVC'><p>--------------------------------------------------------------------------------------------</p></div>
<div class='TVVC'><p>������ �������� ���� ������:</p></div><div class='TVVCr'><div class='CartB'><div class='td1'><strong>��������</strong></div><div class='td2'><strong>�����������</strong></div><div class='td3'><strong>���������</strong></div></div></div>
<?php 
$result=mysql_query('SELECT id,title,money,cat,page FROM data',$db);
if(!$result){$_SESSION['showerr']=2; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
if(mysql_num_rows($result)>0){
$myrow=mysql_fetch_array($result); $sum=0; $i=1;
do{
	foreach($_SESSION['tovar'] as $key=>$val){
	if($key==$myrow['id'] and $val>=1){
	$respage=mysql_query("SELECT page FROM categories WHERE id='".$myrow['cat']."'",$db);
	$pagecat=mysql_fetch_array($respage);
	echo "<div class='TVVCr'><div class='CartB'><div class='td1'>".$i.". <a href='".$pagecat['page']."/".$myrow['page']."' title='�������� �������� ����� ".$myrow['title']."'>".$myrow['title']."</a></div><div class='td2'>".$val."</div><div class='td3'>".$myrow['money']." ���.</div></div></div>"; 
	$i++; $sum+=$val*$myrow['money']; break;
	}}
}while($myrow=mysql_fetch_array($result));
echo "<div class='TVVCr'><div class='CartB'><div class='td2'><strong style='color:#009900'>����� �����:</strong></div><div class='td3'><strong style='color:#009900'>".$sum." ���.</strong></div></div></div>";
}else{$_SESSION['showerr']=1; echo "<html><head> <meta http-equiv='Refresh' content='0; URL=showerr'> </head></html>"; exit();}
?>
<div class='TVVC'><div id='CaBlock'><img id='imageid' src="blocks/ca/?<?php echo session_name()?>=<?php echo session_id()?>"><a href='#' onclick="document.getElementById('imageid').src='blocks/ca/?rnd='+Math.random();return false" title='������� ����� �������� ��������'>��������</a>
<div id='txt'>������� ����� � ��������:</div>
<input class='VVC' name='ca' type='text' maxlength='15'>
<input class='Butt' name='sub_form' type='submit' value='�������� �����'>
</div></div></form></td></tr> </table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div><?php include('blocks/schet.php');?></body></html>
