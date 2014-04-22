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
<title>
Details Updated!
</title>
</head>
<body>
<?php include_once('../header.php')?>
<div id="container" style="margin-left: 125px; background-color: #fcfcfc;">
<?php 
	include_once('../database.php');
	$id = $_GET['id'];
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$sql = mysql_query("update student set first_name='$firstname',last_name='$lastname',phone='$phone',email='$email',address='$address' where id = $id;");
	if($sql)	{
		echo $firstname."'s details have been updated<br>";
		echo "Add $firstname to a <a href='student_addtobatch?id=$id'>Batch</a> or <a href='student_addtocourse?id=$id'>Course</a>";
	}
	else
		echo mysql_error();
?>
</div>
<?php include_once("../footer.php");?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redireting in 3 seconds.";
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