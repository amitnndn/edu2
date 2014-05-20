<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 4)	{
?>
<?php
	include_once('../database.php');
	$batchid = $_GET['batch_id'];
	$studentid = $_GET['student_id'];
	$feespaid = 0;
	$sql = mysql_query("select * from payments where batch_id=$batchid and student_id=$studentid;");
	while($info = mysql_fetch_array($sql))	{
		$totalfees = $info['fees_total'];
		$feespaid += $info['fees_paid'];
		$feeremaining = $totalfees - $feespaid;
	}
	echo "<tr><td>Total Fees:</td><td><input name='total_fee' type='text' readOnly='true' value=".$totalfees."></td></tr>";
	echo "<tr><td>Fee Paid: </td><td><input name='feepaid' type='text' readOnly='true' value=".$feespaid."></td></tr>";
	echo "<tr><td>Balance:</td><td><input name='fee_remaining' type='text' value=".$feeremaining." readOnly='true'></td></tr>";
	if($feeremaining == 0)	{
		echo "<tr><td></td><td>Fees Paid!</td></tr>";
	}
	else	{
		echo "<tr><td>Amount Paid:&nbsp</td><td><input type='text' name='fee_paid'></td></tr>";
		echo "<tr><td>Payment Method:&nbsp</td><td><select name='payment_method'><option value='0' selected>---Select a Payment Method---</option>\n";
		echo "<option value='cash'>Cash</option><option value='cheque/dd'>Cheque/DD</option><option value='banktransfer'>Bank Transfer</option>";
		echo "</select></td></tr>";
		echo "<tr><td>Additional Details:&nbsp</td><td><textarea name='additional_details'></textarea></td></tr>";
		echo "<tr><td><input type='submit' value='Update' class='btn btn-primary' id='alertme2'></td></tr>";				
		}		
?>
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