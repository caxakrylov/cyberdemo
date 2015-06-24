<?php
function s_param($p){$p=stripslashes($p); $p=htmlspecialchars($p); $p=mysql_real_escape_string($p); return $p;}
function getip(){
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {$ip=$_SERVER['HTTP_CLIENT_IP'];}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}
else {$ip=$_SERVER['REMOTE_ADDR'];}
return $ip;
}
?>