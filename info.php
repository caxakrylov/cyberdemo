<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
session_start();
include('blocks/bd.php');
@include('blocks/functions.php');
if(isset($_GET['page']) and $_GET['page']!=''){
$page=$_GET['page']; $page=s_param($page);
if($page!='delivery' and $page!='packing'){header('Location: index.php'); exit();}
}else{header('Location: index.php'); exit();} 
$resInf=mysql_query("SELECT title,title2,meta_d,meta_k,text FROM settings WHERE page='".$page."'",$db);
if(!$resInf){$_SESSION['showerr']=2; header('Location: showerr'); exit();}
if(mysql_num_rows($resInf)>0){$rowInf=mysql_fetch_array($resInf);}
else{$_SESSION['showerr']=1; header('Location: showerr'); exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<meta name="Description" content="<?php echo $rowInf['meta_d'];?>"/>
<meta name="Keywords" content="<?php echo $rowInf['meta_k'];?>"/>
<meta name="Language" content="russian"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<title><?php echo $rowInf['title'];?></title>
</head>
<body><div id='header'><?php include('blocks/header.php');?></div>
<table id='main_tbl'><tr><td id='left'><div id='nav'><?php include('blocks/nav_left.php');?></div></td>
<td id='cnt'>
<div class='cnt_title2'><h2 id='<?php echo $page?>'><?php echo $rowInf['title2'];?></h2></div>
<div class='cnt_txt'><div class='pp'><?php echo $rowInf['text'];?></div></div>
<div class='cnt_footer'><p><strong><a href='<?php echo $_SERVER['HTTP_REFERER'];?>' title='Вернуться на предыдущую страницу'>&laquo; Вернуться назад</a></strong></p></div>
</td></tr> </table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru by <a href="http://ak87.ru" title="Блог Александра Крылова">ak87.ru</a></p></div><?php include('blocks/schet.php');?></body></html>
