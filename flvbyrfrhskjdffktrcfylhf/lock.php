<?php
include('blocks/bd.php');
if (!isset($_SERVER['PHP_AUTH_USER']))

{
        Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        Header ("HTTP/1.0 401 Unauthorized");
        exit();
}

else {
        if (!get_magic_quotes_gpc()) {
				
				$_SERVER['PHP_AUTH_USER'] = mysql_escape_string($_SERVER['PHP_AUTH_USER']);
                $_SERVER['PHP_AUTH_PW'] = mysql_escape_string($_SERVER['PHP_AUTH_PW']);
				
				if (!preg_match('/^[a-zA-Z0-9_]+$/', $_SERVER['PHP_AUTH_USER'])){
				   Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
				   Header ("HTTP/1.0 401 Unauthorized");
				   exit();
				}
				
				if(strlen($_SERVER['PHP_AUTH_USER']) < 4 or strlen($_SERVER['PHP_AUTH_USER']) > 50){
				   Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
				   Header ("HTTP/1.0 401 Unauthorized");
				   exit();
				}
				   
				if (!preg_match('/^[a-zA-Z0-9_]+$/', $_SERVER['PHP_AUTH_PW'])){
				   Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
				   Header ("HTTP/1.0 401 Unauthorized");
				   exit();
				}
				
				if(strlen($_SERVER['PHP_AUTH_PW']) < 4 or strlen($_SERVER['PHP_AUTH_PW']) > 50){
				   Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
				   Header ("HTTP/1.0 401 Unauthorized");
				   exit();   
				}
        }

		
		$q_log = @mysql_query("SELECT * FROM userlist WHERE id='1'",$db);	
		if (!$q_log)
        {
        	Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        	Header ("HTTP/1.0 401 Unauthorized");
        	exit();
        }
		
		if (mysql_num_rows($q_log) == 0)
        {
           Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }
		
		$q_row = @mysql_fetch_array($q_log);
		
		$_SERVER['PHP_AUTH_USER'] = md5(md5($_SERVER['PHP_AUTH_USER'].$q_row['salt']).$q_row['salt']);
		$_SERVER['PHP_AUTH_PW'] = md5(md5($_SERVER['PHP_AUTH_PW'].$q_row['salt']).$q_row['salt']);
		
		if ($_SERVER['PHP_AUTH_USER'] != $q_row['user'] or $_SERVER['PHP_AUTH_PW'] != $q_row['pass'])
        {
           Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }

}
?>