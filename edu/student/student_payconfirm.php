<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Add to Batch
</title>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 400px;">
<?php 
	$studentid = $_REQUEST['student_id'];
	$courseid = $_POST['course_id'];
	$batchid = $_POST['batch_number'];
	$totalfee = $_POST['course_amount'];
	$amountpaid = $_POST['amount_paid'];
	$amountremaining = $totalfee - $amountpaid;
	$paymentmethod = $_POST['payment_method'];
	$additional = $_POST['additional_details'];
	$date = $_POST['date'];
	include_once("../database.php");	
	$sql2 = mysql_query("select * from batch_students where batch_id=$batchid and course_id = $courseid and student_id = $studentid;");
	$row = mysql_num_rows($sql2);
	if($row>=1)	{
		echo "Student already exists in the batch";
	}
	else	{
		$sql = mysql_query("insert into payments values(default,$batchid,$studentid,$courseid,$totalfee,$amountpaid,$amountremaining,'$date','$paymentmethod','$additional');");
		$sql2 = mysql_query("insert into course_taken values(default,$courseid,$studentid);");
		$sql3 = mysql_query("insert into batch_students values(default,$batchid,$courseid,$studentid);");
		if($sql && $sql2 && $sql3)	{
			echo "Student has been successfully added to the batch";
			header("refresh:3;url=student_list.php");
		}
		else	{
			echo mysql_error();
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