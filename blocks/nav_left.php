<?php
$rescat=mysql_query('SELECT * FROM categories',$db);
if(!$rescat){echo 'Произошла ошибка при обращении к базе!<br/>Пожалуйста, напишите об этом администратору admin@cyberdemo.ru<br/><strong>Код ошибки:</strong>'; exit(mysql_error());}
if(mysql_num_rows($rescat)>0)
{
	echo "<div id='nav_titleA'><a href='".$_SESSION['sitelink']."' style='background-image:url(".$_SESSION['sitelink']."img/home.gif);' title='Переход на главную страницу'>Главная</a></div>";
	$resrow= mysql_fetch_array($rescat);
	do{
		if($resrow['page']=='skachat-myviki-demki-cs-1-6-obychenie') {echo "<div id='nav_title'><p style='background-image:url(".$_SESSION['sitelink']."img/".$resrow['page'].".gif);'>".$resrow['title']."</p></div>"; continue;}
		
		echo "<div id='nav_link'><a href='".$_SESSION['sitelink'].$resrow['page']."/' style='background-image:url(".$_SESSION['sitelink']."img/".$resrow['page'].".gif);' title='Раздел ".$resrow['title']."'>".$resrow['title']."</a></div>";}
	while($resrow=mysql_fetch_array($rescat));
}else{echo 'Ошибка, в базе нет записей!<br/>Пожалуйста, напишите об этом администратору admin@cyberdemo.ru'; exit();}
?>