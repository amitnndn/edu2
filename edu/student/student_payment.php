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
<?php include_once('../head.php');?>
</head>
<body>
<?php 
	include_once('../header.php');
	include_once('../database.php');
	$id = $_GET['id'];
	$cid = $_GET['cid'];
	$mop = $_POST['payment_method'];
	$sql = mysql_query("update course_taken set mode_of_payment='$mop' where course_id=$cid and student_id=$id;" );
	if($sql)	{
		$sql1 = mysql_query("select * from student where id=$id;");
		while($info = mysql_fetch_array($sql1))	{
			$i = $info['total_fee'];
			$j = $info['fee_paid'];
			$k = $_POST['course_amount'];
			$l = $i + $k;
			$m = $_POST['amount_paid'];
			$n = $j + $m;
			$o = $l - $n;
			$sql2 = mysql_query("update student set total_fee=$l, fee_paid=$n, fee_remaining=$o where id=$id;");
			if($sql2)	{
				echo "Updated!";
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