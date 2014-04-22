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
<?php include_once("../head.php");?>
<title>
Update Status
</title>
</head>
<body>
<?php
	include_once("../header.php");
?>
<div style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px;">
<?php 
	include_once("../database.php");
	$name = $_POST['course_name'];
	$fee = $_POST['course_fee'];
	$id = $_GET['id'];
	$sql = mysql_query("update courses set name='$name',fee=$fee where id=$id;");
	if($sql)	{
		echo "<div class = 'alert alert-success'>Update Successful</div>";
	}
	else	{
		echo "<div class='alert alert-error'>MySQL ERROR: ".mysql_error()."</div>";
	}
?>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=course_list.php");
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