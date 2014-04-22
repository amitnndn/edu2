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
</head>
<body>
<?php include_once('../header.php');?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<?php
	include_once('../database.php');
	$id = $_GET['id'];
	$s = mysql_query("select first_name as name from student where id=$id");
	while($info = mysql_fetch_array($s))	{
		$name = $info['name'];
	}
	$sql = mysql_query("delete from student where id=$id;");
	$sql2 = mysql_query("delete from batch_student where student_id=$id");
	$sql3 = mysql_query("delete from course_taken where student_id=$id");
	if($sql && $sql1 && $sql2 && $sql3)	{
		echo $name." has been deleted from the database. Please wait until you are redirected.";
		header("refresh:3 url=student_list.php");
	}
?>
</div>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=student_list.php");	
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