<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if(isset($_GET['page']) and $_GET['page']!=''){
$page=$_GET['page']; $page=s_param($page);
if(!preg_match('/^[a-z0-9_-]+$/',$page)){header('Location: index.php'); exit();}
if(strlen($page)>40){header('Location: index.php'); exit();}
}else{header('Location: index.php'); exit();}
$result=mysql_query("SELECT * FROM categories WHERE page='".$page."'",$db);
if(!$result){$_SESSION['showerr']=2; header('Location: showerr'); exit();}
if(mysql_num_rows($result)>0){$myrow=mysql_fetch_array($result);}
else{$_SESSION['showerr']=1; header('Location: showerr'); exit();}
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
<title>&raquo; Скачать мувики, демки CS 1.6 WCG, ESWC, Extreme Masters, DreamHack, KODE5. CS 1.6 Обучение <?php echo $myrow['title'];?></title>
</head>
<body>
<div id='header'><?php include('blocks/header.php');?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td>
<td id='cnt'>
<div class='cnt_title2'><h2 style='background-image:url(<?php echo "../img/".$myrow['page']."-c.gif";?>)'><?php echo $myrow['title'];?></h2></div>
<div class='cnt_txt'><div class='pp'><?php echo $myrow['text'];?></div></div>
<?php
$resDATA=mysql_query("SELECT id,title,description,money,rating,page FROM data WHERE cat='".$myrow['id']."'",$db);
if(!$resDATA){$_SESSION['showerr']=2; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
if (mysql_num_rows($resDATA)>0){
	$rowDATA=mysql_fetch_array($resDATA);
	do{
	$id=$rowDATA['id'];
	$rescomm=mysql_query("SELECT COUNT(*) FROM comments WHERE post='".$id."'",$db);
	$sumcomm=mysql_fetch_array($rescomm);
	if(isset($_SESSION['tovar'])){
	foreach($_SESSION['tovar'] as $key=>$val){
	if($key==$id and $val>=1){$trash="<a href='../cart' title='Диск ".$rowDATA['title']." у Вас в корзине'>В корзине</a>"; break;}
	else{$trash="<a href='../".$rowDATA['page']."-add".$id."' title='Добавить в корзину диск ".$rowDATA['title']."'>Добавить в корзину</a>";}
	}}else{$trash="<a href='../".$rowDATA['page']."-add".$id."' title='Добавить в корзину диск ".$rowDATA['title']."'>Добавить в корзину</a>";}
	echo "<div class='cnt_title'><h3><a href='".$rowDATA['page']."' title='Подробнее о диске ".$rowDATA['title']."'>".$rowDATA['title']."</a></h3></div><div class='cnt_txt'><div class='pp'>".$rowDATA['description']."</div></div><div class='cnt_footer'><p class='m'>Стоимость: <strong>".$rowDATA['money']." руб.</strong></p></div><div class='cnt_footer'><p style='background-image:url(../img/rating/".$rowDATA['rating'].".gif);'><strong><a href='".$rowDATA['page']."'>&raquo; Подробнее</a></strong> | ".$trash." | <a href='".$rowDATA['page']."#links'>Скачать</a> | <a href='".$rowDATA['page']."#comments'>Отзывы (".$sumcomm[0].")</a></p></div>";
	}while($rowDATA=mysql_fetch_array($resDATA));
}else{$_SESSION['showerr']=1; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
?></td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href="http://ak87.ru" title="Блог Александра Крылова">ak87.ru</a></p></div><?php include('blocks/schet.php');?></body></html>
