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
<?php  include_once('../head.php');?>
</head>
<body>
<?php include_once("../header.php")?>
<div style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px;">
<?php
	include_once("../database.php");
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$sql = mysql_query("insert into student values(default,'$firstname','$lastname','$phone','$email','$address');");
	if($sql)	{
		/*$sql1 = mysql_query("select * from students");
		$info = mysql_fetch_array($sql1);*/
		$sql2 = mysql_query("select * from student;");	
		while($info1 = mysql_fetch_array($sql2))	{
			//$thisid = $info1['Auto-increment'] - 1;
		}
		echo "<div class = 'alert alert-success'>Student Added</div>";
?>
<table>
<tr><td>Name:&nbsp</td><td><?php echo $firstname." ".$lastname;?></td></tr>
<tr><td>Phone:&nbsp</td><td><?php echo $phone;?></td></tr>
<tr><td>Email:</td><td><?php echo $email;?></td></tr>
</table>
<?php  
	}
	else	{
		echo "<div class='alert alert-error'>MySQL Error".mysql_error()."</div>";
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