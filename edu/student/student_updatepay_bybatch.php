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
<?php include_once("../head.php");?>
<title>
Payment Status
</title>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<?php 
	include_once("../database.php");
	$batchid = $_GET['batchid'];
	$studentid = $_GET['id'];
	$feepaid = $_POST['fee_paid'];
	$feepaid1 = 0;
	$paymentmethod = $_POST['payment_method'];
	$additionaldetails = $_POST['additional_details'];
	$date = $_POST['date'];
	$sql = mysql_query("select * from payments where batch_id = $batchid and student_id = $studentid;");
	while($info = mysql_fetch_array($sql))	{
		$totalfee = $info['fees_total'];
		$feepaid1 += $info['fees_paid'];
		$courseid = $info['course_id'];
	}
	$feeremaining = $totalfee - $feepaid1;
	$feeremaining1 = $feeremaining;
	if($feeremaining == 0)	{
		echo "Student has paid the fees!";
	}
	else	{
		$feeremaining = $totalfee -($feepaid1 + $feepaid);
		$sql1 = mysql_query("insert into payments values(default,$batchid,$studentid,$courseid,$totalfee,$feepaid,$feeremaining,'$date','$paymentmethod','$additionaldetails');");
		if($sql1)	{
			echo "<div class='alert alert-success'>Payment Updated!</div>";
			$sql2 = mysql_query("select * from student where id = $studentid;");
			while($info2 = mysql_fetch_array($sql2))	{
				$studentname = $info2['first_name']." ".$info['last_name'];
			}
?>
<table>
<tr><td>Student Name: </td><td><?php echo $studentname;?></td></tr>
<tr><td>Amount Paid: </td><td><?php echo $feepaid;?></td></tr>
<tr><td>Amount Remaining:&nbsp</td><td><?php echo ($feeremaining1 - $feepaid);?></td></tr>
</table>
<?php 			
		}
		else	{
			echo mysql_error();	
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