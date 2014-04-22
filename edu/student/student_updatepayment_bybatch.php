<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Update Payment
</title>
<script type="text/javascript">
function validate()	{
	x = parseInt(document.foo.total_fee.value);
	y = parseInt(document.foo.feepaid.value);
	z = parseInt(document.foo.fee_remaining.value);
	a = parseInt(document.foo.fee_paid.value);
	b = parseInt(document.foo.payment_method.value);
	c = document.foo.date.value;
	if(a > z)	{
		alert("Amount Paid Cannot be Greater than Balance");
		return false;
	}if(b == 0)	{
		alert("Please select a payment method");
		return false;
	}if(c == null || c == "")	{
		alert("Please select a Payment Date");
		return false;
	}
}
</script>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<form name="foo" action="student_updatepay_bybatch.php?id=<?php echo $_GET['id'];?>&batchid=<?php echo $_GET['batchid'];?>" method="post" style="margin-left: 25px; margin-right: 25px;" onsubmit="return validate();">
<fieldset>
<?php include_once("../database.php");
	$studentid = $_GET['id'];
	$sql4 = mysql_query("select * from student where id = $studentid;");
	while($info4 = mysql_fetch_array($sql4))	{
		$name = $info4['first_name'];
	}
		?>	
<legend>
Update Payment of <?php echo $name;?>
</legend>
<table>
<?php
	include_once('../database.php');
	$batchid = $_GET['batchid'];
	$studentid = $_GET['id'];
	$totalfee = 0;
	$feepaid = 0;
	$feeremaining = 0;
	$sql1 = mysql_query("select * from batch where id = $batchid;");
	while($info1 = mysql_fetch_array($sql1))	{
		$batchname = $info1['batch_name'];	
	}
	$sql = mysql_query("select * from payments where batch_id=$batchid and student_id=$studentid;");
	while($info = mysql_fetch_array($sql))	{
		$totalfee = $info['fees_total'];
		$feepaid += $info['fees_paid'];
		$feeremaining = $info['fees_remaining'];
	}

	echo "<tr><td>Total Fees:</td><td><input name='total_fee' type='text' readOnly='true' value='$totalfee'></td></tr>";
	echo "<tr><td>Fee Paid: </td><td><input name='feepaid' type='text' readOnly='true' value='$feepaid'></td></tr>";
	echo "<tr><td>Balance:</td><td><input name='fee_remaining' type='text' value='$feeremaining' readOnly='true'></td></tr>";
	echo "<tr><td>Batch: </td><td><input type='text' value='$batchname' readOnly='true'></td></tr>";
	if($feeremaining == 0)	{
		echo "<tr><td></td><td>Fees Paid!</td></tr>";
	}
	else	{
		echo "<tr><td>Amount Paid:&nbsp</td><td><input type='text' name='fee_paid'></td></tr>";
?>
	<tr><td>Payment Date:</td><td><input type="text" id="dp1" name="date">
<script type="text/javascript">
	$('#dp1').datepicker({format: 'yyyy-mm-dd'});
</script></td></tr>
<?php 
		echo "<tr><td>Payment Method:&nbsp</td><td><select name='payment_method'><option value='0' selected>---Select a Payment Method---</option>\n";
		echo "<option value='cash'>Cash</option><option value='cheque/dd'>Cheque/DD</option><option value='banktransfer'>Bank Transfer</option>";
		echo "</select></td></tr>";
		echo "<tr><td>Additional Details:&nbsp</td><td><textarea name='additional_details'></textarea></td></tr>";
		echo "<tr><td><input type='submit' value='Update' class='btn btn-primary'></td></tr>";				
	}		
?>
</table>
</fieldset>
</form>
</div>
<?php include_once("../footer.php");?>
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