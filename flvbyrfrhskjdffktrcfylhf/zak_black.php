<?php
require_once ('lock.php');
session_start();
/*подключаем базу*/
include ('blocks/bd.php');
/*проверяем переданные параметры*/
if (isset($_SESSION['mzak_black'])) {
$mzak_black = $_SESSION['mzak_black'];
unset($_SESSION['mzak_black']);
}
if (isset($_GET['id'])) {$id = $_GET['id'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<title>Cyberdemo.ru &mdash; Администрирование &mdash; Черный список</title>
</head>
<body>
<!--HEADER-->
<div id='header'>
</div>
<table id='main_tbl'>
  <tr>
  	<!--ЛЕВАЯ НАВИГАЦИЯ-->
    <td id='left'>
    	<div id='nav'><?php include ('blocks/nav_left.php');?></div>
    </td>
    <!--КОНТЕНТ-->
    <td id='cnt'>
	<?php
	if (!isset($id))
	{
		echo "	<div class='cnt_title2'><h1 id='main'>Черный список заказов</h1></div>
				<div class='cnt_txt'><div class='pp'><p><strong>Важно!</strong> Обязательно удалять все заказы где используются запрещенные символы или SQL запросы!</p>";
		$result = mysql_query ("SELECT id,fio FROM zakaz WHERE adm='2'",$db);
		$myrow = mysql_fetch_array($result);
		$i=1;
		do
		{
			echo "<p>".$i.". <a href='zak_black.php?id=".$myrow['id']."'>".$myrow['fio']."</a></p>";
			$i++;
		}
		while ($myrow = mysql_fetch_array($result));
		echo "</div></div>";
	}
	else
	{
		$result = mysql_query("SELECT * FROM zakaz WHERE id='".$id."'",$db);
		$myrow = mysql_fetch_array($result);
		echo "<div class='cnt_title2'><h1 id='main'>".$myrow['fio']."</h1></div>
		<div class='cnt_txt'><div class='pp'><p><strong>Важно!</strong> Обязательно удалять все заказы где используются запрещенные символы или SQL запросы!</p></div></div>";
   		if (isset($mzak_black)) {
			$msg_a[2] = 'Произошла ошибка при обращении к базе!';
			$msg_a[3] = 'Не верный id';
			$msg_a[4] = 'Заказ помечен как выполненый.';
			$msg_a[5] = 'Заказ удален!';

			if ($mzak_black == 4 || $mzak_black ==5) {
				echo "<div id='msgok'><p>".$msg_a[$mzak_black]."</p></div>
			    </td></tr></table><div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div></body></html>"; exit();
				}
			else {echo "<div id='msg'><p>".$msg_a[$mzak_black]."</p></div>";}

		}
		$spb_opl = 'Наложенным платежом';
		if ($myrow['spb_opl']=='e-money'){$spb_opl = 'E-Money';}
		?>
 		<div class='cnt_txt'><div class='pp'>
        <p><strong>ФИО: </strong><br /><?php echo $myrow['fio'];?></p>
        <p><strong>Страна: </strong><br /><?php echo $myrow['country'];?></p>
        <p><strong>Регион: </strong><br /><?php echo $myrow['region'];?></p>
        <p><strong>Город: </strong><br /><?php echo $myrow['city'];?></p>
        <p><strong>Улица, номер дома, квартира: </strong><br /><?php echo $myrow['home'];?></p>
        <p><strong>Индекс почты: </strong><br /><?php echo $myrow['mindex'];?></p>
        <p><strong>E-Mail: </strong><br /><?php echo $myrow['mail'];?></p>
        <p><strong>Дата заказа: </strong><br /><?php echo $myrow['date'];?></p>
        <p><strong>Товары: </strong></p>
	    <?php
			$id_tovar = explode(" ", trim($myrow['id_tovar']));
			$kol_tovar = explode(" ", trim($myrow['kol_tovar']));
			$money = 0;
			foreach($id_tovar as $key=>$val){
					$result2 = mysql_query("SELECT title,money,page,cat FROM data WHERE id='".$val."'",$db);
					if (mysql_num_rows($result2) == 0)
						{
							echo "<p>Товар с id=".$val." не найден в базе!</p>"; continue;
						}
					$myrow2 = mysql_fetch_array($result2);
					$resCat = mysql_query("SELECT page FROM categories WHERE id='".$myrow2['cat']."'",$db);
					$rowCat = mysql_fetch_array($resCat);
					echo "<p><a href='../".$rowCat['page']."/".$myrow2['page']."'>".$myrow2['title']."</a> - ".$kol_tovar[$key]." шт.</p>";
					$money += $kol_tovar[$key] * $myrow2['money'];
			}
		?>
        <p><strong>на сумму: </strong><?php echo $money; ?> руб.</p>
        <p><strong>IP Покупателя: </strong><br /><?php echo $myrow['ip'];?></p>
        <p style="color:#FF0000;"><strong>Способ оплаты: </strong><?php echo $spb_opl; ?></p>
        <br/>
        <textarea class='VVC' rows='8'>%custName% <?php echo "<".$myrow['fio'].">";?>&#009
%custCountry% <?php echo "<".$myrow['country'].">";?>&#009
%custPostalCode% <?php echo "<".$myrow['mindex'].">";?>&#009
%custCity% <?php echo "<".$myrow['city'].">";?>&#009
%custRegion% <?php echo "<".$myrow['region'].">";?>&#009
%custAddress% <?php echo "<".$myrow['home'].">";?>&#009
%custEmail% <?php echo "<".$myrow['mail'].">";?>&#009
Способ оплаты: <?php echo $spb_opl; ?></textarea>
        <br/>
        </div></div>

        <div class='cnt_footer'><a href = 'zak_black_go_old_.php?id=<?php echo $id;?>'>Отметить как выполненое</a> | <a href = 'zak_black_del_.php?id=<?php echo $id;?>'>Удалить!</a></div>

<?php }?>
    </td>
  </tr>
</table>
<!--FOOTER-->
<div id='footer'><p>Copyright &copy; 2010 cyberDemo.ru</p></div>
</body>
</html>