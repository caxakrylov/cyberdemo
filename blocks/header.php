<h1><a href='<?php echo $_SESSION['sitelink'];?>' title='������� �� ������� �������� www.cyberdemo.ru'>&raquo; ������� ������, ����� CS 1.6 WCG, ESWC, Extreme Masters. CS 1.6 ��������</a></h1>
<div id='reg'>
<?php
$ct=0;
if(isset($_SESSION['tovar'])){?>
<div id='formaI'><a href='<?php echo $_SESSION['sitelink'];?>forma' title='��� �� ������ �������� �����'>�������� �����</a></div>
<?php
foreach($_SESSION['tovar'] as $key=>$val){
if($val>=1){$ct++;}
}}?>
<div id='cartI'><a href='<?php echo $_SESSION['sitelink'];?>cart' title='���� �������'>������� (<?php echo $ct;?> ����.)</a></div>
<div id='deliveryI'><a href='<?php echo $_SESSION['sitelink'];?>delivery' title='�������� � �������� � ������'>�������� � ������</a></div>
<div id='packI'><a href='<?php echo $_SESSION['sitelink'];?>packing' title='�������� �� �������� � �������� ������'>�������� � ��������</a></div>
</div>