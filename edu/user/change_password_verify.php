<?php 
	include_once('../database.php');
	$oldpass = $_POST['old_password'];
	$newpass1 = $_POST['new_password1'];
	$newpass2 = $_POST['new_password2'];
	$id = $_GET['id'];
	if($newpass1 == $newpass2)	{
		$sql = mysql_query("select * from users where id=$id;");
		while($info = mysql_fetch_array($sql))	{
			$oldpass = md5($oldpass);
			$oldpass1 = $info['password'];	
			if($oldpass == $oldpass1)	{
				$newpass = md5($newpass1);
				$sql1 = mysql_query("update users set password='$newpass' where id = $id;");
				if($sql1)	{
					echo "Password change successful. You will be redirected in 2 seconds.";
					header("refresh:2;url=../index.php");
				}
				else	{
					echo mysql_error();
				}
			}
			else	{
				echo "Old password not correct. You will be redirected in 2 seconds.";
				header("refresh:2;url=change_password.php?id=$id");
			}
		}
	}
	else	{
		echo "Passwords do not match";
		header("refresh:2;url=change_password.php?id=$id");
	}
?>