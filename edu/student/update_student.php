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
<title>Update</title>
</head>
<body>
<?php include_once("../header.php");?>
<div style="margin-right: 900px; background-color: #fcfcfc; margin-left: 125px; margin-top: 0px;">
<div style="margin-top: 35px; padding-top: 25px; padding-left: 25px; padding-bottom: 25px;">
<?php
	$id = $_GET['id'];
	include_once("../database.php");
	$sql = mysql_query("select * from student where id=$id;");
	while($info = mysql_fetch_array($sql))	{
		echo "<table><tr><td><strong>First Name: </strong></td><td>".$info['first_name']."</td></tr><tr><td><strong>Last Name: </strong></td><td>".$info['last_name']."</td></tr>";
	}
	echo "<tr><td><strong>Courses Opted: </strong>&nbsp</td>";
	$sql1 = mysql_query("select * from course_taken where student_id=$id");
	if(mysql_num_rows($sql1)>=1)	{ 
		while($info1 = mysql_fetch_array($sql1))	{
			$sql2 = mysql_query("select * from courses where id=".$info1['course_id'].";"); 
			while($info2 = mysql_fetch_array($sql2))	{
				echo "<td> ".$info2['name']."</td>";
			}
		} 
	}
	$sql = mysql_query("select * from student where id=$id;");
	while($info = mysql_fetch_array($sql))	{
	echo "<tr><td><strong>Fee Paid: </strong></td><td>Rs. ".$info['fee_paid']."</td></tr>";
	if($info['fee_remaining'] > 0)	{
				echo "<tr><td><strong>Fee Remaining: </strong></td><td style='background-color: red; border-radius: 5px;'>Rs. ".$info['fee_remaining']."</td></tr>";
		}
	}
	echo "<tr><td><a href='update_student_content.php?id=$id'>Edit/Update</a></td></tr><tr><td><form action='delete_student?id=$id'><button class='btn btn-danger' value='delete_student?id=$id'>Delete</button></tr></table>";
?>

</div>
</div>
</body>
</html>
<?php 
			}
			else	{
				echo "Access deied. Redirecting in 3 seconds.";
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