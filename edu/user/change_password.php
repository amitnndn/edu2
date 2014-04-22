<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Change Password
</title>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 525px;">
<form name='batch_form' action="change_password_verify.php?id=<?php echo $_GET['id'];?>" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<legend>
Change Password
</legend>
<table>
<tr><td>Old Password:&nbsp</td><td><input type="password" name="old_password"></td></tr>
<tr><td>New Password:</td><td><input type="password" name="new_password1"></td></tr>
<tr><td>Re-enter Password:&nbsp</td><td><input type="password" name="new_password2"></td></tr>
<tr><td></td><td><input type="submit" value="Change" class="btn btn-primary"></td></tr>
</table>
</fieldset>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
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