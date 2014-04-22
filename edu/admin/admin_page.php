<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			if($_SESSION['role'] == 1)	{
?>

<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Admin Panel
</title>
<style rel="stylesheet">
#user_form	{
	padding: 25px;
	margin: 25px;
}
form	{
	margin-right: 725px;
}
</style>
</head>
<body>
<div id="user_form">
<?php include_once('header.php')?>
Welcome to the <strong>Admin Panel</strong> <?php echo $_SESSION['username'];?>. Please select an option above.
</div>
<?php include_once('../footer.php');?>
</body>
</html>
<?php 		}
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