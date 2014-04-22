<?php
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in']==1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Create Batch Confirm
</title>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px;">
<?php 
	include_once("../database.php");
	$batchname = $_POST['batch_name'];
	$courseid = $_GET['id'];
	$facilitatorid = $_POST['facilitator_id'];
	$startdate = $_POST['start_date'];
	$enddate = $_POST['end_date'];
	$starttime = $_POST['start_time'];
	$endtime = $_POST['end_time'];
	$sql = mysql_query("insert into batch values(default,'$batchname',$courseid,$facilitatorid,'$startdate','$enddate',$starttime,$endtime,1);");
	if($sql)	{
		echo "Batch was successfully created! Redirecting in 2 seconds.";
		header("refresh:3;url=course_list.php");	
	}
	else	{
		echo mysql_error();	
	}
?>
</div>
<?php include_once("../footer.php");?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 2 seconds.";
				header("refresh:2;url=course_list.php");	
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