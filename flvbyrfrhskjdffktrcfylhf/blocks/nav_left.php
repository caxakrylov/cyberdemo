<div id='nav_title'><p>������</p></div> 
<?php /*���������� �������*/
	$newzak = mysql_query("SELECT COUNT(*) FROM zakaz WHERE adm='0' AND status='1'",$db);
	$oldzak = mysql_query("SELECT COUNT(*) FROM zakaz WHERE adm='1' AND status='1'",$db);
	$black = mysql_query("SELECT COUNT(*) FROM zakaz WHERE adm='2' AND status='1'",$db);
	$notstat = mysql_query("SELECT COUNT(*) FROM zakaz WHERE status='0'",$db);
	$emoney = mysql_query("SELECT COUNT(*) FROM zakaz WHERE spb_opl='e-money' AND status='1' AND adm='3'",$db); //����������� ������ ������
	
	$snzak = mysql_fetch_array($newzak);
	$sozak = mysql_fetch_array($oldzak);
	$snot = mysql_fetch_array($notstat);
	$sblack = mysql_fetch_array($black);
	$semoney = mysql_fetch_array($emoney);
?>
<div id='nav_link'><a href='zak_new.php'>����� (<?php echo $snzak[0];?>)</a></div>
<div id='nav_link'><a href='zak_notstat.php'>���������������� (<?php echo $snot[0];?>)</a></div>
<div id='nav_link'><a href='zak_old.php'>���������� (<?php echo $sozak[0];?>)</a></div>
<div id='nav_link'><a href='zak_emoney.php'>���������� E-Money (<?php echo $semoney[0];?>)</a></div>
<div id='nav_link'><a href='zak_black.php'>������ ������ (<?php echo $sblack[0];?>)</a></div>

<div id='nav_title'><p>������</p></div>
<div id='nav_link'><a href='new_post.php'>��������</a></div>
<div id='nav_link'><a href='edit_post.php'>�������������</a></div>
<div id='nav_link'><a href='del_post.php'>�������</a></div>

<div id='nav_title'><p>���������</p></div>
<div id='nav_link'><a href='new_cat.php'>��������</a></div>
<div id='nav_link'><a href='edit_cat.php'>�������������</a></div>
<div id='nav_link'><a href='del_cat.php'>�������</a></div>

<div id='nav_title'><p>��������</p></div>
<div id='nav_link'><a href='edit_page.php'>�������������</a></div>

<div id='nav_title'><p>�����������</p></div>
<?php /*���������� ������������*/
	$newcomm = mysql_query("SELECT COUNT(*) FROM comments WHERE adm='0'",$db);
	$oldcomm = mysql_query("SELECT COUNT(*) FROM comments WHERE adm='1'",$db);
	$sum = mysql_fetch_array($newcomm);
	$sum1 = mysql_fetch_array($oldcomm);
?>
<div id='nav_link'><a href='comm_new.php'>����� (<?php echo $sum[0];?>)</a></div>
<div id='nav_link'><a href='comm_old.php'>������������� (<?php echo $sum1[0];?>)</a></div>

<div id='nav_title'><p>�����</p></div>
<div id='nav_link'><a href='edit_admin.php'>�������������</a></div>
