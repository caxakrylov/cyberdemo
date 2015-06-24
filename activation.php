<?php
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if(isset($_GET['activ']) and $_GET['activ']!=''){
$activ=$_GET['activ']; $activ=s_param($activ);
if(!preg_match('/^[0-9a-z]+$/',$activ)){header('Location: index.php'); exit();}
if(strlen($activ)!=32){header('Location: index.php'); exit();}}
//активация через robox
//success url
if(isset($_POST['InvId']) && isset($_POST['OutSum']) && isset($_POST['SignatureValue']) && isset($_POST['Shpa']) && $activ=='emoneyactivationlinksuccessurl10')
{
	$InvId=trim($_POST['InvId']); if($InvId==''){header('Location: index.php'); exit();}
	$InvId=s_param($InvId);
	if(!preg_match('/^[0-9]*$/',$InvId)){header('Location: index.php'); exit();}
	if(strlen($InvId)>10){header('Location: index.php'); exit();}
	
	$OutSum=$_POST['OutSum']; 
	$SignatureValue=$_POST['SignatureValue'];

	$result3 = mysql_query("SELECT id,id_tovar,kol_tovar,uniq_id,status FROM zakaz WHERE id='".$InvId."'",$db);    
	if(!$result3){$_SESSION['activ']=2; header('Location: accept');exit();}
	if(mysql_num_rows($result3)>0){
		$myrow3 = mysql_fetch_array($result3);
		//подсчет суммы
		$id_tovar = explode(" ", trim($myrow3['id_tovar'])); 
		$kol_tovar = explode(" ", trim($myrow3['kol_tovar'])); 
		foreach($id_tovar as $key=>$val){
			$result4 = mysql_query("SELECT money FROM data WHERE id='".$val."'",$db); 
			if (mysql_num_rows($result4) == 0) {continue;}
			$myrow4 = mysql_fetch_array($result4);
			$money += $kol_tovar[$key] * $myrow4['money'];
		}
		//Проверка полученной суммы оплаты
		$money = $money.'.00';
		if($OutSum != $money){$_SESSION['activ']=8; header('Location: accept'); exit();}
		//проверка контрольной суммы
		$SignatureValue = strtoupper($SignatureValue);
		
		$mrh_pass1 = "SKinZHHyrZYKvx4DHpCU";
		$shpa = $_POST['Shpa']; 
		$out_summ = $money;
		$inv_id = $InvId;
		$crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shpa=$shpa")); // формирование подписи
		if($crc == $SignatureValue) //ВСЕ ВЕРНО ОПЛАТА ПОДТВЕРЖДЕНА!!!
		{
			$ActivON=mysql_query("UPDATE zakaz SET status=1 WHERE id='".$InvId."'");
			if($ActivON){$_SESSION['activ']=10; header('Location: accept'); exit();}
		}else{$_SESSION['activ']=8; header('Location: accept'); exit();}
	}else{$_SESSION['activ']=8; header('Location: accept'); exit();}

//Fail URL:
}elseif(isset($_POST['InvId']) && isset($_POST['OutSum']) && isset($_POST['SignatureValue']) && isset($_POST['Shpa']) && $activ=='emoneyactivationlinkfailurl10101'){
	$_SESSION['activ']=7; header('Location: accept'); exit();
	
//Result URL:
}elseif(isset($_POST['InvId']) && isset($_POST['OutSum']) && isset($_POST['SignatureValue']) && isset($_POST['Shpa']) && $activ=='emoneyactivationlinkresulturl100'){
	$InvId=trim($_POST['InvId']); if($InvId==''){exit();}
	$InvId=s_param($InvId);
	if(!preg_match('/^[0-9]*$/',$InvId)){exit();}
	if(strlen($InvId)>10){exit();}
	
	$OutSum=$_POST['OutSum']; 
	$SignatureValue=$_POST['SignatureValue'];

	$result3 = mysql_query("SELECT id,id_tovar,kol_tovar,uniq_id,status FROM zakaz WHERE id='".$InvId."'",$db);    
	if(!$result3){exit();}
	if(mysql_num_rows($result3)>0){
		$myrow3 = mysql_fetch_array($result3);
		//подсчет суммы
		$id_tovar = explode(" ", trim($myrow3['id_tovar'])); 
		$kol_tovar = explode(" ", trim($myrow3['kol_tovar'])); 
		foreach($id_tovar as $key=>$val){
			$result4 = mysql_query("SELECT money FROM data WHERE id='".$val."'",$db); 
			if (mysql_num_rows($result4) == 0) {continue;}
			$myrow4 = mysql_fetch_array($result4);
			$money += $kol_tovar[$key] * $myrow4['money'];
		}
		//Проверка полученной суммы оплаты
		$money = $money.'.00';
		if($OutSum != $money){exit();}
		//проверка контрольной суммы
		$SignatureValue = strtoupper($SignatureValue);
		
		$mrh_pass2 = "nf8st7Wr4trRSwLmjwZ7";
		$shpa = $_POST['Shpa']; 
		$out_summ = $OutSum;
		$inv_id = $InvId;
		$crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shpa=$shpa")); // формирование подписи
		if($crc == $SignatureValue) //ВСЕ ВЕРНО ОПЛАТА ПОДТВЕРЖДЕНА!!!
		{
			if($myrow3['status']==0){
				$ActivON=mysql_query("UPDATE zakaz SET status=1 WHERE id='".$InvId."' AND status=0");
				if($ActivON){echo "OK$inv_id\n"; exit();}
			}else{exit();}
		}else{exit();}
	}else{exit();}

//активация по e-mail
}else{	
	$result1=mysql_query("SELECT uniq_id,status FROM zakaz WHERE uniq_id='".$activ."'",$db);
	if(!$result1){$_SESSION['activ']=2; header('Location: accept');exit();}
	if(mysql_num_rows($result1)>0){
		$myrow1=mysql_fetch_array($result1);
		if($myrow1['status']==0){
			$result2=mysql_query("UPDATE zakaz SET status=1 WHERE uniq_id='".$activ."' AND status=0");
			if($result2){$_SESSION['activ']=4; header('Location: accept'); exit();}
		}else{$_SESSION['activ']=5; header('Location: accept'); exit();}
	}else{$_SESSION['activ']=3; header('Location: accept'); exit();}
}
?>