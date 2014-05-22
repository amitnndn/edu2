<?php
	$db_name = $_POST['db_name'];
	mysql_connect('localhost','root','');
	mysql_select_db($db_name);
	mysql_query("insert into roles values(1,'Super Admin')");
	mysql_query("insert into roles values(2,'HoO')");
	mysql_query("insert into roles values(3,'Reception')");
	mysql_query("insert into roles values(4,'Finance')");
	echo "Success";
?>