<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<?php
	$courseid = $_REQUEST['course_id'];
	$studentid = $_REQUEST['student_id'];
	$batchid = $_POST['batch_id'];
	$sql = mysql_query("insert into course_taken values(default,$courseid,$studentid");
	$sql2 = mysql_query("insert into batch_students values(default,$batchid,$courseid,$studentid);");
	$sql3 = mysql_query("select * from courses where id=$courseid;");
	while($info3 = mysql_fetch_array($sql3))	{
		$fee = $info3['fee'];
	}	
	$sql3 = mysql_query("insert into payments values(default,$batchid,$studentid,$courseid,$fee,0,$fee);");
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