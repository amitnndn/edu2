<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			if($_SESSION['role'] == 1)	{
				include_once("../database.php");
				$name = $_POST['name'];
				$id = $_REQUEST['user_id'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$username = $_POST['username'];
				$role = $_POST['role'];
				$sql = mysql_query("update users set name = '$name', email='$email', phone = '$phone', username='$username' where id = $id;");
				if($sql)	{
					echo "Update successful. You will be redirected in 2 seconds.";
					header("refresh:2;url=index.php");
				}
				else	{
					echo mysql_error();
				}
			}
			else	{
				header("location:../index.php");
			}
		}
		else	{
			header("location:../index.php");
		}
	}
	else	{
		header("location:../index.php");
	}
			
?>