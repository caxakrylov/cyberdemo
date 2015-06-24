<h1><a href='<?php echo $_SESSION['sitelink'];?>' title='Переход на главную страницу www.cyberdemo.ru'>&raquo; Скачать мувики, демки CS 1.6 WCG, ESWC, Extreme Masters. CS 1.6 обучение</a></h1>
<div id='reg'>
<?php
$ct=0;
if(isset($_SESSION['tovar'])){?>
<div id='formaI'><a href='<?php echo $_SESSION['sitelink'];?>forma' title='Тут Вы можете оформить заказ'>Оформить заказ</a></div>
<?php
foreach($_SESSION['tovar'] as $key=>$val){
if($val>=1){$ct++;}
}}?>
<div id='cartI'><a href='<?php echo $_SESSION['sitelink'];?>cart' title='Ваша корзина'>Корзина (<?php echo $ct;?> наим.)</a></div>
<div id='deliveryI'><a href='<?php echo $_SESSION['sitelink'];?>delivery' title='Сведения о доставке и оплате'>Доставка и оплата</a></div>
<div id='packI'><a href='<?php echo $_SESSION['sitelink'];?>packing' title='Сведения об упаковке и качестве товара'>Упаковка и качество</a></div>
</div>