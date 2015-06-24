<?php
function s_param($p)
{$p = stripslashes($p); $p = htmlspecialchars($p); $p = mysql_real_escape_string($p);
return $p;}
?>
