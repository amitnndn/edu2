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
Delete Batch
</title>
</head>
<body>
<?php include_once('../header.php');?>

<?php 
	include_once('../database.php');
	$batchid = $_GET['id'];
	$sql = mysql_query("delete from batch where id=$id;");
	$sql1 = mysql_query("delete from batch_taken where batch_id=$id;");
	if(!$sql1 || !$sql)	{	
		echo mysql_error();
	}
	else	{
		echo "Batch has been deleted, you will be redirected in 3 second(s).";
		header("refresh:3;url=batch_list.php");
	}
?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied.";
				header("refresh:3;url=batch_list.php");	
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