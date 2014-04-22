<?php 
session_start();
if(isset($_SESSION['logged_in']))	{
	if($_SESSION['logged_in'] == 1 && $_SESSION['role'] == 1)	{
		header("Location:admin_page.php");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Admin Panel
</title>
<style rel="stylesheet">
#form_container	{
	margin: 200px 500px 700px 500px;
	padding: 25px;
	background-color: #fcfcfc;
}
</style>
</head>
<body>
<div id='form_container'>
<form action="admin_login.php" method="POST" style="margin-right:725px;">
<fieldset>
<legend>
Admin Login
</legend>
<table>
<tr><td>Username:&nbsp</td><td><input type='text' name='username'></td></tr>
<tr><td>Password:&nbsp</td><td><input type='password' name='password'></td></tr>
<tr><td><input type='submit' class='btn btn-primary' value='Submit'></td></tr>
</table>
</fieldset>
</form>
</div>
</body>
</html>
