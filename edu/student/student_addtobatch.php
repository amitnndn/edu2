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
<?php include_once("../head.php");?>
<title>
Add Student to Batch
</title>
<script type="text/javascript">
function validate ()	{
	if(document.getElementById('payment_false').checked)	{
		document.getElementById('paymen_false').hidden = false;
		document.getElementById('select_pay').display = 'inline';
		
	}
	if(document.getElementById('payment_true').checked)	{
		document.getElementById('paymen_false').hidden = true;
		document.getElementById('select_pay').display = 'none';
	}
}
</script>
</head>
<body>
<?php 
	include_once('../header.php');
	include_once('../database.php');
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<form action="student_addbatch.php?id=<?php echo $_GET['id'];?>" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<legend>
Add 
<?php 
	$id = $_GET['id'];
	$sql = mysql_query("select * from student where id=$id;");
	while($info = mysql_fetch_array($sql))	{
		echo " ".$info['first_name']." ";
	}
?>
to a Batch
</legend>
<table>
<tr><td>Batch Name:</td><td><select name="batch_id">
<?php 
	$sql1 = mysql_query("select * from batch");
	echo "<option value='0'>---Select a Batch---</option>";
	if($sql)	{
		while($info = mysql_fetch_array($sql1))	{
			echo "<option value=".$info['id'].">".$info['batch_name']."</option>";
		}
	}
	else	{
		echo mysql_error();
	}
?>
</select></td></tr>
<tr><td>Payment Method:&nbsp</td><td><select name="payment_method">
<option value='0'>--Select a Payment Method--</option>
<option value='1'>Cash</option>
<option value='2'>Cheque/DD</option>
<option value='3'>Bank Transfer</option>
</select></td></tr>
<tr><td>Payment Details:&nbsp</td><td><textarea type="text"></textarea>
<tr><td><button type='submit' class='btn'>Submit</button>
</table>
</fieldset>
</form>
</div>
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