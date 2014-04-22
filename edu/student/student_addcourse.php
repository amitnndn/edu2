<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<?php
	include_once("../database.php");
	$courseid = $_GET['id'];
	$studentid = $_GET['studentid'];
	$sql1 = mysql_query("select * from batch_students where course_id = $courseid and student_id = $studentid");
	$sql2 = mysql_query("select showing from batch where course_id=$id");
	while($info2 = mysql_fetch_array($sql2))	{
		$show = $info2['showing'];
	}
	$row = mysql_num_rows($sql1);
	if($row > 0 && $show==1)	{
		$sql = mysql_query("select * from student where id = $studentid;");
		while($info = mysql_fetch_array($sql))	{
			echo $info['first_name']." has already taken up the course!";
		}
	}
	else	{
		$sql = mysql_query("select * from courses where id=$courseid;");
		echo "<tr><td>Fees:</td><td>";
		while($info = mysql_fetch_array($sql))	{
			echo "Rs.<input type='text' readonly='true' name='course_amount' value='".$info['fee']."'></td></tr>";
			echo "<tr><td>Course Name:&nbsp</td><td><input type='text' name='course_name' readonly='true' value='".$info['name']."'></td></tr>";
		}
		$sql1 = mysql_query("select * from batch where course_id=$courseid and showing=1;");
		echo "<tr><td>Batch:</td><td><select name='batch_number'><option value='0'>---Select a Batch---</option>";
		while($info1 = mysql_fetch_array($sql1))	{
			echo "<option value='".$info1['id']."'>".$info1['batch_name']."</option>";
		}
		echo "</select></td></tr>";
		echo "<tr><td>Amount Paid:&nbsp</td><td><input type='text' name='amount_paid'></td></tr>";
		echo "<tr><td>Payment Method:</td><td><select name='payment_method'><option value='0'>---Select a Payment Method---</option>";
		echo "<option value='cash'>Cash</option><option value='cheque/dd'>Cheque/DD</option><option value='Bank Transfer'>Bank Transfer</option>";
		echo "</select></td></tr>";
		echo "<tr><td>Payment Details:&nbsp</td><td><textarea name='additional_details'></textarea></td></tr>";
		echo "<tr><td><button id=\"alertMe2\" class='btn btn-primary' >Submit</button>";
	}
?>
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
