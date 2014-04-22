<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			if($_SESSION['role'] == 1)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
User Add Confirm
</title>
</head>
<body>
<?php 
	include_once('../database.php');
	$username = $_POST['username'];
	$name = $_POST['name'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$role = $_POST['role'];
	$sql = mysql_query("select * form users where username = $username;");
	$n = mysql_num_rows($sql);
	if($n >= 1)	{
		echo "Username already exists, please choose another username.";
	}
	else	{
		$sql1 = mysql_query("insert into users values(default,'$name','$email','$phone','$username','$password',$role);");
		if($sql1)	{
			echo "User was successfully inserted!";	
		}
		else	{
			echo mysql_error();	
		}
	}
	
?>
</body>
</html>
<?php 		}
			else	{
				echo "Access Denied.";
				header("refresh:3;url=batch_list.php");	
			}
				
		}
		else 	{
			header('Location:../index.php');
		}
	}
	else	{
		header('Location:../index.php');
	}
?>