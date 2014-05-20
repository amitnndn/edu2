
<?php
	$db_name = $_SESSION['db_name'];
	//session_start();
	mysql_connect("localhost","root","");
	mysql_select_db($db_name);
?>