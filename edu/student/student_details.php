<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 4 || $role == 3)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php 
	include_once('../head.php');
	include_once('../database.php');
	$sql = mysql_query("select * from student where id = ".$_GET['id'].";");
	while($info = mysql_fetch_array($sql))	{
		$name = $info['first_name'];
	}
?>
<title>
<?php echo $name."'s Details";?>
</title>
</head>
<body>
<?php include_once("../header.php");?>
<h2 style="text-align: center"><?php echo $name;?>'s Reports</h2><hr>
<div id="container" style="margin-left: 125px; background-color: #fcfcfc; margin-right:500px;">
<?php 
	include_once("../database.php");
	$id = $_GET['id'];
	$sql = mysql_query("select * from batch_students where student_id = $id;");
	echo "<ul class='nav nav-tabs' style='margin-right: 25px; margin-left: 125px;' data-tabs='tab'><li><a style='color:black'>Batches:</a></li>";
	while($info = mysql_fetch_array($sql))	{
		$sql1 = mysql_query("select * from batch where id=".$info['batch_id'].";");
		while($info1 = mysql_fetch_array($sql1))	{
			echo "<li><a href='#tab".$info1['id']."' data-toggle='tab'>".$info1['batch_name']."</a></li>\n";	
		}
	}
	echo "</ul>";
?>
<div id="my-tab-content" class="tab-content">
<?php 
	$sql1 = mysql_query("select batch.batch_name as batch_name, batch.id as batch_id , batch.course_id as course_id from batch,batch_students where batch.id = batch_students.batch_id and batch_students.student_id = $id;");
	//echo "select batch.batch_name as batch_name, batch.id as batch_id , batch.course_id as course_id from batch,batch_students where batch.id = batch_students.batch_id and batch_students.student_id = $id;";
	while($info1 = mysql_fetch_array($sql1))	{
?>
<div class="tab-pane" id="tab<?php echo $info1['batch_id'];?>" style="margin-left: 125px; padding-bottom: 25px; margin-right: 25px;">
<p><h4>Payment Reports towards batch <?php echo $info1['batch_name'];?></h4></p>
<table class="table table-striped" style="margin-right: 25px">
<?php 
	$courseid = $info1['course_id'];
	$sql3 = mysql_query("select * from payments where batch_id=".$info1['batch_id']." and student_id=$id;");
	$totalfees = 0;
	$fee_recieved = 0;
	$fee_remainings = 0;
	$payment_method = " ";
	$totalfee = 0;
	$total_fee_recieved = 0;
	$total_fee_remaining = 0;
	$i = 0;
	$j=0;
	$mystr = "Payment not made";
	$n = mysql_num_rows($sql3);
	while($info3 = mysql_fetch_array($sql3))	{
		$totalfees 	= $info3['fees_total'];
		$fee_recieved += $info3['fees_paid'];
		$fee_remainings = $info3['fees_remaining'];
		if($i == 0)	{
			$payment_method = $info3['payment_method']." | ";
			$additionalinfo = $info3['additional_details']." | ";
			$mystr = date("F j, Y",strtotime( $info3['date']))." : Rs. ".$info3['fees_paid']."<br>";
		}
		else if($i == ($n - 1))	{
			$payment_method .= $info3['payment_method'];
			$additionalinfo .= $info3['additional_details'];
			$mystr .= date("F j, Y",strtotime( $info3['date']))." : Rs. ".$info3['fees_paid'];	
		}
		else	{
			$payment_method .= $info3['payment_method']." | ";
			$additionalinfo .= $info3['additional_details']." | ";
			$mystr .= date("F j, Y",strtotime( $info3['date']))." : Rs. ".$info3['fees_paid']."<br>";
		}
		
		$i++;
	}
	$totalfee +=$totalfees;
	$total_fee_recieved += $fee_recieved;
	$total_fee_remaining += $fee_remainings;
	echo "<tr><td>Total Fees: </td><td>Rs. $totalfees</td></tr><tr><td>Fees Paid: </td><td>Rs. <a href=\"#\" id=\"example".$info1['batch_id']."\" rel=\"popover\" data-content=\"$mystr\" data-original-title=\"Payment Details\">$fee_recieved</a></td></tr>";
?>
<script type="text/javascript">
$(function ()
		{ $("#example<?php echo $info1['batch_id'];?>").popover();
});
</script>
<?php 
	if($fee_remainings > 0)	{
		echo "<tr><td>Balance: </td><td>Rs. $fee_remainings &nbsp<a href='student_updatepayment_bybatch.php?id=$id&batchid=".$info1['batch_id']."'>Update Payment</a></td></tr>";
		
	}
	echo "<tr><td>Payment Method:&nbsp</td><td>$payment_method</td></tr><tr><td>Additional Details:&nbsp</td><td>$additionalinfo</td></tr>";
?>
</table>
</div>
<?php }?>
</div>
</div>
<?php 
include_once("../footer.php");
?>
<script type="text/javascript">
$(function ()
		{ $("#example").popover();
});
</script>
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