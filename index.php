<?php
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	session_start();
	include('blocks/bd.php');
	$result=mysql_query("SELECT title,title2,meta_d,meta_k,text FROM settings WHERE page='index'",$db);
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
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<title><?php echo $myrow['title'];?></title>
</head>
<body>
<div id='header'><?php include('blocks/header.php');?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td>
<td id='cnt'>
<div class='cnt_title2'><h2 id='main'><?php echo $myrow['title2'];?></h2></div>
<div class='cnt_txt'><div class='pp'><?php echo $myrow['text'];?></div></div>
<?php
$reslast=mysql_query("SELECT id,title,description,rating,page,cat FROM data WHERE main_last='1'",$db);
if(!$reslast){$_SESSION['showerr']=2; echo "<html><head><meta http-equiv='Refresh' content='0; URL=showerr'></head></html>"; exit();}
if(mysql_num_rows($reslast)>0){
	echo "<div class='cnt_btitle'><p>Последние обновления</p></div>";
	$lastrow=mysql_fetch_array($reslast);
	do{
	$id=$lastrow['id'];
	$rescomm=mysql_query("SELECT COUNT(*) FROM comments WHERE post='".$id."'",$db);
	$sumcomm=mysql_fetch_array($rescomm);
	$descr=str_replace('"../','"',$lastrow['description']);
	$rescat=mysql_query("SELECT page FROM categories WHERE id='".$lastrow['cat']."'",$db);
	$rowcat=mysql_fetch_array($rescat);
	$dpath=$rowcat['page'].'/'.$lastrow['page'];
	if(isset($_SESSION['tovar'])){
	foreach($_SESSION['tovar'] as $key=>$val){
		if($key==$id and $val>=1){$trash="<a href='cart' title='Диск ".$lastrow['title']." у Вас в корзине'>В корзине</a>"; break;}else{$trash="<a href='".$lastrow['page']."-add".$id."' title='Добавить в корзину диск ".$lastrow['title']."'>Добавить в корзину</a>";}
	}}else{$trash="<a href='".$lastrow['page']."-add".$id."' title='Добавить в корзину диск ".$lastrow['title']."'>Добавить в корзину</a>";}
	echo "<div class='cnt_title'><h3><a href='".$dpath."' title='Подробнее о диске ".$lastrow['title']."'>".$lastrow['title']."</a></h3></div><div class='cnt_txt'><div class='pp'>".$descr."</div></div><div class='cnt_footer'><p style='background-image:url(img/rating/".$lastrow['rating'].".gif);'><strong><a href='".$dpath."'>&raquo; Подробнее</a></strong> | ".$trash." | <a href='".$dpath."#links'>Скачать</a> | <a href='".$dpath."#comments'>Отзывы (".$sumcomm[0].")</a></p></div>";
	}while($lastrow=mysql_fetch_array($reslast));
}?></td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href="http://ak87.ru" title="Блог Александра Крылова">ak87.ru</a></p></div><?php include('blocks/schet.php');?></body></html>
