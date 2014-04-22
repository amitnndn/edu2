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
Batch Status
</title>
</head>
<body>
<?php include_once("../header.php");?>
<div id="container" style="margin-left: 125px; background-color: #fcfcfc;">
<?php 
	include_once("../database.php");
	$batchid = $_POST['batch_id'];
	$sql1 = mysql_query("select * from batch where id=$batchid;");
	while($info = mysql_fetch_array($sql1))	{
		$courseid = $info['course_id'];
		$id = $_GET['id'];
		$sql = mysql_query("insert into batch_students values(default,$batchid,$courseid,$id);");
		if($sql)	{
			echo "<a href='batch_addstudents.php?id=$batchid'>Add some more students to this batch</a>";
		}
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