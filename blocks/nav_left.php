<?php
$rescat=mysql_query('SELECT * FROM categories',$db);
if(!$rescat){echo '��������� ������ ��� ��������� � ����!<br/>����������, �������� �� ���� �������������� admin@cyberdemo.ru<br/><strong>��� ������:</strong>'; exit(mysql_error());}
if(mysql_num_rows($rescat)>0)
{
	echo "<div id='nav_titleA'><a href='".$_SESSION['sitelink']."' style='background-image:url(".$_SESSION['sitelink']."img/home.gif);' title='������� �� ������� ��������'>�������</a></div>";
	$resrow= mysql_fetch_array($rescat);
	do{
		if($resrow['page']=='skachat-myviki-demki-cs-1-6-obychenie') {echo "<div id='nav_title'><p style='background-image:url(".$_SESSION['sitelink']."img/".$resrow['page'].".gif);'>".$resrow['title']."</p></div>"; continue;}
		
		echo "<div id='nav_link'><a href='".$_SESSION['sitelink'].$resrow['page']."/' style='background-image:url(".$_SESSION['sitelink']."img/".$resrow['page'].".gif);' title='������ ".$resrow['title']."'>".$resrow['title']."</a></div>";}
	while($resrow=mysql_fetch_array($rescat));
}else{echo '������, � ���� ��� �������!<br/>����������, �������� �� ���� �������������� admin@cyberdemo.ru'; exit();}
?>