<div id='nav_title'><p>Заказы</p></div> 
<?php /*количество заказов*/
	$newzak = mysql_query("SELECT COUNT(*) FROM zakaz WHERE adm='0' AND status='1'",$db);
	$oldzak = mysql_query("SELECT COUNT(*) FROM zakaz WHERE adm='1' AND status='1'",$db);
	$black = mysql_query("SELECT COUNT(*) FROM zakaz WHERE adm='2' AND status='1'",$db);
	$notstat = mysql_query("SELECT COUNT(*) FROM zakaz WHERE status='0'",$db);
	$emoney = mysql_query("SELECT COUNT(*) FROM zakaz WHERE spb_opl='e-money' AND status='1' AND adm='3'",$db); //переместить отсюда нельзя
	
	$snzak = mysql_fetch_array($newzak);
	$sozak = mysql_fetch_array($oldzak);
	$snot = mysql_fetch_array($notstat);
	$sblack = mysql_fetch_array($black);
	$semoney = mysql_fetch_array($emoney);
?>
<div id='nav_link'><a href='zak_new.php'>Новые (<?php echo $snzak[0];?>)</a></div>
<div id='nav_link'><a href='zak_notstat.php'>Неподтвержденные (<?php echo $snot[0];?>)</a></div>
<div id='nav_link'><a href='zak_old.php'>Выполненые (<?php echo $sozak[0];?>)</a></div>
<div id='nav_link'><a href='zak_emoney.php'>Оплаченные E-Money (<?php echo $semoney[0];?>)</a></div>
<div id='nav_link'><a href='zak_black.php'>Черный список (<?php echo $sblack[0];?>)</a></div>

<div id='nav_title'><p>Товары</p></div>
<div id='nav_link'><a href='new_post.php'>Добавить</a></div>
<div id='nav_link'><a href='edit_post.php'>Редактировать</a></div>
<div id='nav_link'><a href='del_post.php'>Удалить</a></div>

<div id='nav_title'><p>Категории</p></div>
<div id='nav_link'><a href='new_cat.php'>Добавить</a></div>
<div id='nav_link'><a href='edit_cat.php'>Редактировать</a></div>
<div id='nav_link'><a href='del_cat.php'>Удалить</a></div>

<div id='nav_title'><p>Страницы</p></div>
<div id='nav_link'><a href='edit_page.php'>Редактировать</a></div>

<div id='nav_title'><p>Комментарии</p></div>
<?php /*количество комментариев*/
	$newcomm = mysql_query("SELECT COUNT(*) FROM comments WHERE adm='0'",$db);
	$oldcomm = mysql_query("SELECT COUNT(*) FROM comments WHERE adm='1'",$db);
	$sum = mysql_fetch_array($newcomm);
	$sum1 = mysql_fetch_array($oldcomm);
?>
<div id='nav_link'><a href='comm_new.php'>Новые (<?php echo $sum[0];?>)</a></div>
<div id='nav_link'><a href='comm_old.php'>Просмотренные (<?php echo $sum1[0];?>)</a></div>

<div id='nav_title'><p>Админ</p></div>
<div id='nav_link'><a href='edit_admin.php'>Редактировать</a></div>
