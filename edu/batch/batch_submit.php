<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Batch Created! 
</title>
</head>
<body>
<?php include_once('../header.php');?>
<div id="container" style="margin-left: 125px; background-color: #fcfcfc; margin-right: relative;">
<?php 
	include_once('../database.php');
	$batchname = $_POST['batch_name'];
	$courseid = $_POST['course'];
	$startdate = $_POST['start_date'];
	$enddate = $_POST['end_date'];
	$starttime = $_POST['start_time'];
	$endtime = $_POST['end_time'];
	$facid = $_POST['facilitator_id'];
	$sql = mysql_query("insert into batch values(default,'$batchname',$courseid,$facid,'$startdate','$enddate',$starttime,$endtime,1);");
	if($sql)	{
		echo "<a href='/edu/student/student_batch.php'>Add Students to this batch</a>";
	}
	else 	{
		echo "ERROR: ".mysql_error();
	}
	
?>
</div>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied.";
				header("refresh:3;url=../student/student_list.php");	
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