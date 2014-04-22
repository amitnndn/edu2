<?php 
	
		include_once('../database.php');
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$sql = mysql_query("select * from users where username = '$username' and password = '$password' and roleid = 1;");
		$n = mysql_num_rows($sql);
		session_start();
		if($n==1)	{
			header('Location:admin_page.php');
		}
?>