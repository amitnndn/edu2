<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
</head>
<body>
<?php include_once('../header.php');?>
<div style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px;">
<?php
	$id = $_GET['id'];
	include_once('../database.php');
	$feepaid = 0;
	$feepaid1 = $_POST['fee_paid']; 
	$batchid = $_POST['batch_id'];
	$date = $_POST['date'];
	$additional = $_POST['additional_details'];
	$paymentmethod = $_POST['payment_method'];
	$sql2 = mysql_query("select course_id from batch where id = $batchid;");
	while($info2 = mysql_fetch_array($sql2))	{
		$courseid = $info2['course_id'];
	}
	$paymentmethod = $_POST['payment_method'];
	$additionaldetails = $_POST['additional_details'];
	$sql = mysql_query("select * from payments where batch_id = $batchid and student_id = $id;");
	if($sql)	{
		while($info = mysql_fetch_array($sql))	{
			$totalfee = $info['fees_total'];
			$feepaid += $info['fees_paid'];
			$feeremaining = $totalfee - $feepaid;
		}
		if($feeremaining == 0)	{	
			echo "Student has paid complete fees!";
			break;
		}
		else	{
			$feeremaining = $totalfee - ($feepaid + $feepaid1);
			$sql1 = mysql_query("insert into payments values (default,$batchid,$id,$courseid,$totalfee,$feepaid1,$feeremaining,'$date','$paymentmethod','$additional');");
			if($sql1)	{		
				echo "Payment Updated! Redirecting you in 2 seconds";
				header("refresh:2;url=student_list.php");	
			}
			else	{
				echo mysql_error();	
			}
		}
	}
?>
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