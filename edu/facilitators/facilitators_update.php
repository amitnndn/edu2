<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Update Status
</title>
</head>
<body>
<?php include_once('../header.php')?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 500px;">
<?php 
	include_once('../database.php');
	$id = $_GET['id'];
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$sql = mysql_query("update facilitators set first_name='$firstname', last_name='$lastname', phone='$contact', email='$email', address='$address' where id=$id;");
	if($sql)	{
		echo ucfirst($firstname)." details have been successfully updated.<br>You will be redirected to the list in 3 seconds.";
		header("refresh:3;url=facilitators_list.php");
	}
	else	{
		echo mysql_error();
	}
?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=facilitators_list.php");
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