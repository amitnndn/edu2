<?php 
	include_once('../database.php');
	$username = $_GET['username'];
	$password = md5($_GET['password']);
	$sql = mysql_query("select * from users where username = '$username' and password = '$password';");
	echo "select * from users where username = '$username' and password = '$password';";
	if($sql)	{
		while($info = mysql_fetch_array($sql))	{
			session_start();
			$_SESSION['username'] = $info['name'];
			$_SESSION['role'] = $info['roleid'];
			echo "<div class='alert alert-success'>Login Successful. You will be redirected in 3 seconds.</div>";
			header("refresh:3;url=../student/student_list.php");
		}
	}
	else	{
		echo "<div class='alert alert-error'>Login Unsuccessful</div>";
	}

?>