<?php
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if($_SERVER['HTTP_REFERER']==''){header('Location: index.php'); exit();}
if(isset($_POST['sub_form']) and $_POST['sub_form']=='Оформить заказ'){
	$_SESSION['form']['fio']=$_POST['fio'];
	$_SESSION['form']['country']=$_POST['country'];
	$_SESSION['form']['region']=$_POST['region'];
	$_SESSION['form']['city']=$_POST['city'];
	$_SESSION['form']['home']=$_POST['home'];
	$_SESSION['form']['mindex']=$_POST['mindex'];
	$_SESSION['form']['mail']=$_POST['mail'];
	$_SESSION['form']['sb_oplati']=$_POST['sb_oplati'];
	if(isset($_POST['fio'])){$fio=trim($_POST['fio']); if($fio==''){$_SESSION['msg_form']=3; header('Location: forma'); exit();}}
	if(isset($_POST['country'])){$country=trim($_POST['country']); if($country==''){$_SESSION['msg_form']=4; header('Location: forma'); exit();}}
	if(isset($_POST['region'])){$region=trim($_POST['region']); if($region==''){$_SESSION['msg_form']=97; header('Location: forma'); exit();}}	
	if(isset($_POST['city'])){$city=trim($_POST['city']); if($city==''){$_SESSION['msg_form']=5; header('Location: forma'); exit();}}				
	if(isset($_POST['home'])){$home=trim($_POST['home']); if($home==''){$_SESSION['msg_form']=6; header('Location: forma'); exit();}}			
	if(isset($_POST['mindex'])){$mindex=trim($_POST['mindex']); if($mindex=='') {$_SESSION['msg_form']=7; header('Location: forma'); exit();}}
	if(isset($_POST['mail'])){$mail=trim($_POST['mail']); if($mail==''){$_SESSION['msg_form']=8; header('Location: forma'); exit();}}
	if(!isset($_POST['sb_oplati']) || $_POST['sb_oplati']!='nalojka')
	{if($_POST['sb_oplati']!='e-money'){$_SESSION['msg_form']=100; header('Location: forma'); exit();}}

$fio=s_param($fio);
if(!preg_match('/^[a-zA-Zа-яА-ЯёЁ\.\-\ ]*$/',$fio)){$_SESSION['msg_form']=9; header('Location: forma'); exit();}
if(strlen($fio)>255){$_SESSION['msg_form']=10; header('Location: forma'); exit();}
$country=s_param($country);
if(!preg_match('/^[a-zA-Zа-яА-ЯёЁ\.\-\ ]*$/',$country)){$_SESSION['msg_form']=11; header('Location: forma'); exit();}
if(strlen($country)>50){$_SESSION['msg_form']=12; header('Location: forma'); exit();}
$region=s_param($region);
if(!preg_match('/^[a-zA-Zа-яА-ЯёЁ\.\,\-\ ]*$/',$region)){$_SESSION['msg_form']=98; header('Location: forma'); exit();}
if(strlen($region)>255){$_SESSION['msg_form']=99; header('Location: forma'); exit();}
$city=s_param($city);
if(!preg_match('/^[a-zA-Zа-яА-ЯёЁ\.\,\-\ ]*$/',$city)){$_SESSION['msg_form']=13; header('Location: forma'); exit();}
if(strlen($city)>255){$_SESSION['msg_form']=14; header('Location: forma'); exit();}
$home=s_param($home);
if(!preg_match('/^[a-zA-Z0-9а-яА-ЯёЁ\.\-\/\,\:\№\ ]*$/',$home)){$_SESSION['msg_form']=15; header('Location: forma'); exit();}
if(strlen($home)>255){$_SESSION['msg_form']=16; header('Location: forma'); exit();}
$mindex=s_param($mindex);
if(!preg_match('/^[0-9]*$/',$mindex)){$_SESSION['msg_form']=17; header('Location: forma'); exit();}
if(strlen($mindex)>10){$_SESSION['msg_form']=18; header('Location: forma'); exit();}
$mail=s_param($mail);
if(!preg_match('/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/',$mail)){$_SESSION['msg_form']=19; header('Location: forma'); exit();}
if(strlen($mail)>100){$_SESSION['msg_form']=20; header('Location: forma'); exit();}
if(isset($_POST['ca'])){$ca=trim($_POST['ca']); if($ca==''){$_SESSION['msg_form']=23; header('Location: forma'); exit();}}
$ca=s_param($ca);
if(!preg_match('/^[a-z0-9]*$/',$ca)){$_SESSION['msg_form']=23; header('Location: forma'); exit();}
if(strlen($ca)>6){$_SESSION['msg_form']=23; header('Location: forma'); exit();}
if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring']==$ca){
	
	$uniq_id=md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].mktime());
	$result=mysql_query('SELECT id,title,money,cat,page FROM data',$db);
	if(!$result){$_SESSION['msg_form']=2; header('Location: forma'); exit();}
	if(mysql_num_rows($result)>0){
	$myrow=mysql_fetch_array($result); $i=1;
	do{
		foreach($_SESSION['tovar'] as $key=>$val){
		if($key==$myrow['id'] and $val>=1){
		$mailtov .= ''.$i.'. Диск <strong>"'.$myrow['title'].'"</strong> - '.$val.' шт.<br/>';
		$interOpis .= 'Диск "'.$myrow['title'].'" - '.$val.' шт. ';
		$i++; $id_tovar=$id_tovar.$key.' '; $kol_tovar=$kol_tovar.$val.' '; $sum+=$val*$myrow['money']; break;
		}}
	}while($myrow=mysql_fetch_array($result));
	}
	$date=date('Y-m-d');
	$ip=getip();
	$adm = 0;
	if($_POST['sb_oplati']=='e-money') {$adm = 3;}
	$result=mysql_query("INSERT INTO zakaz (fio,country,region,city,home,mindex,mail,date,id_tovar,kol_tovar,uniq_id,ip,spb_opl,adm) VALUES('".$fio."','".$country."','".$region."','".$city."','".$home."','".$mindex."','".$mail."','".$date."','".$id_tovar."','".$kol_tovar."','".$uniq_id."','".$ip."','".$_POST['sb_oplati']."','".$adm."')",$db);
	if(!$result){$_SESSION['msg_form']=2; header('Location: forma'); exit();}
	//ROBOX
	if($_POST['sb_oplati']=='e-money')
	{$_SESSION['form']['OutSum']=$sum; $_SESSION['form']['InvId']=$uniq_id; $_SESSION['form']['Desc']=$interOpis; 
	unset($_POST['fio']); unset($_POST['country']); unset($_POST['region']); unset($_POST['city']); unset($_POST['home']); unset($_POST['mindex']); unset($_POST['mail']); unset($_POST['ca']); unset($_SESSION['captcha_keystring']); unset($_POST['sb_oplati']);
	$_SESSION['msg_form']=25; header('Location: forma'); exit();}
	
	$headers='MIME-Version: 1.0'."\r\n";
	$headers.='Content-Type: text/html; charset=windows-1251'."\r\n";
	$headers.='From: admin@cyberdemo.ru'."\r\n";
	$subject='Подтверждение заказа на сайте cyberdemo.ru';
	$message='На нашем сайте '.$data.' был сделан следующий заказ:<br/>';
	$message.=$mailtov;
	$message.='<br/>ФИО: <strong>'.$fio.'</strong><br/>';
	$message.='Адрес: <strong>'.$country.', '.$region.', '.$city.', '.$home.'</strong><br/>Индекс почты: <strong>'.$mindex.'</strong><br/><br/>';
	$message.='Для подтверждения заказа ПРОЙДИТЕ по следующей ссылке:<br/><a href="http://cyberdemo.ru/activation='.$uniq_id.'" target="_blank">http://cyberdemo.ru/activation='.$uniq_id.'</a> <br/>';
	$message.='или скопируйте ссылку в адресную строку браузера и нажмите Enter.<br/><br/>После подтверждения заказа в ближайшие 48 часов Вам будет отправлена ценная бандероль с наложенным платежом.<br/>По факту отправки, Вы получите еще одно письмо на этот же ящик.<br/>==============================================================================<br/>С уважением, администрация сайта <a href="http://www.cyberdemo.ru/" target="_blank">www.cyberdemo.ru</a><br/>E-mail: <a href="mailto:admin@cyberdemo.ru">admin@cyberdemo.ru</a><br/>==============================================================================';
	if(mail($mail,$subject,$message,$headers)==TRUE){
	unset($_POST['fio']); unset($_POST['country']); unset($_POST['region']); unset($_POST['city']); unset($_POST['home']); unset($_POST['mindex']); unset($_POST['mail']); unset($_POST['ca']); unset($_SESSION['captcha_keystring']); unset($_POST['sb_oplati']); $_SESSION['msg_form']=21; header('Location: forma'); exit();
	}else{$_SESSION['msg_form']=22; header('Location: forma'); exit();}//письмо
	}else{$_SESSION['msg_form']=23; header('Location: forma'); exit();}//капча
} else{header('Location: index.php'); exit();}//кнопка
?>