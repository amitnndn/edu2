<?php
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in']==1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Reports by Date
</title>
<link href="http://localhost/htdocs/fd1/css/jquery-dtpicker.css" rel="stylesheet">
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/jquery-dtpicker.js"></script>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 300px">
<form name="foo" action="date_report_submit.php" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<legend>
Select a Range
</legend>
<table>
<tr><td>Start Date:&nbsp</td><td><input type='text' id='dp1' name='start_date'></td><td>&nbspEnd date:&nbsp</td><td><input type='text' id='dp2' name='end_date'></td></tr>
<tr><td></td><td><input type='submit' value='Submit' class='btn btn-primary'></td></tr>
<script type="text/javascript">
	$('#dp2').datepicker({format: 'yyyy-mm-dd'});
	$('#dp1').datepicker({format: 'yyyy-mm-dd'});
</script>
</table>
</fieldset>
</form>
</div>
<?php 
	include_once("../database.php");
?>

<?php include_once("../footer.php");?>
</body>
</html>
<?php	 }
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=../index.php");
			}
		}
		else	{
			header("refresh:3;url=../index.php");
		}
	}
	else	{
		header("refresh:3;url=../index.php");
	}
?>