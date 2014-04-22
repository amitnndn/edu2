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
<div id="container" style="margin-left: 25px auto; margin-right: 100px;">
<?php 
	include_once("../database.php");
	$name = $_POST['course_name'];
	$fee = $_POST['course_fee'];
	$name = ucfirst($name);
	$sql = mysql_query("insert into courses values(default,'$name',$fee);");
	if(!$sql)	{
		echo mysql_error();
	}
	else	{
		echo "<a href=' '>Add Students to this Course</a><br><a href=' '>Create Batches for this Course</a>";
	}
?>
</div>
</body>
</html>
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