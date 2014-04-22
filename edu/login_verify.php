<?php 
	session_start();
	include_once('database.php');
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$sql = mysql_query("select * from users where username = '$username' and password = '$password';");
	$n = mysql_num_rows($sql);
	if($n == 1)	{
		if($sql)	{
			while($info = mysql_fetch_array($sql))	{
	
				$_SESSION['logged_in'] = 1;
				$_SESSION['username'] = $info['name'];
				$_SESSION['role'] = $info['roleid'];
				echo "<div class='alert alert-success'>Login Successful. You will be redirected in 3 seconds.</div>";
				header("Location:home.php");
			}
		}
	}
	else	{
		echo "Invalid Login";
		$_SESSION['is_logged_in'] = 0;
		header("refresh:1;url=index.php");
	}

?>