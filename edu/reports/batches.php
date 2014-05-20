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
</head>
<title>
Batch Report
</title>
<body>
<?php include_once("../header.php");?>
<h2 style="text-align: center;">BATCH REPORTS&nbsp<br></h2>
<hr>
<h3 style="margin-left: 160px"><small>Select a Batch </small></h3>
<div class="tabbable tabs-left" style="margin-left: 125px; background-color: #fcfcfc; margin-right:125px;">
<?php 
	include_once("../database.php");
	$sql = mysql_query("select * from batch;");
	echo "<ul class='nav nav-tabs' style='margin-right: 25px; margin-left: 25px; padding: 0 0 0 25px;' data-tabs='tab'>";
	while($info = mysql_fetch_array($sql))	{
		echo "<li><a href='#tab".$info['id']."' data-toggle='tab'>".$info['batch_name']."</a></li>\n";
	}
	echo "</ul>";
?>
<div id="my-tab-content" class="tab-content">
<?php 
	$sql1 = mysql_query("select * from batch;");
	while($info1 = mysql_fetch_array($sql1))	{
?>
<div class="tab-pane" id="tab<?php echo $info1['id'];?>" style="margin-left: 25px; padding-bottom: 25px; margin-right: 25px;">
<p><h2>Report of batch <?php echo $info1['batch_name'];?></h2></p>
<table class="table table-striped" style="margin-right: 25px">
<?php 
	$courseid = $info1['course_id'];
	$sql2 = mysql_query("select * from student,batch_students where batch_students.student_id = student.id and batch_students.batch_id=".$info1['id'].";");
	$n = 0;
	$row = mysql_num_rows($sql2);	
	if($row==0)	{
		echo "Students have not been added to this batch";
	}
	else	{
		
			while ($info2 = mysql_fetch_array($sql2))	{
				$n++;
			}
		$sql4 = mysql_query("select * from courses where id=$courseid;");
		while($info4 = mysql_fetch_array($sql4))	{
			$coursefee = $info4['fee'];
			$coursename = $info4['name'];
		}
		echo "<tr><td>Course Name: </td><td> $coursename";
		echo "<tr><td> Fee per Student: </td><td>Rs. $coursefee</td></tr>";
		echo "<tr><td>Number of students:&nbsp</td><td>$n <a href ='#myModal".$info1['id']."' role=\"button\" data-toggle=\"modal\" style='padding-left: 5em;'>Show Students</a></td></tr>";
		$sql3 = mysql_query("select * from payments where batch_id=".$info1['id'].";");
		$totalfees = 0;
		$fee_recieved = 0;
		$fee_remainings = 0;
		$totalfee = 0;
		$total_fee_recieved = 0;
		$total_fee_remaining = 0;
		while($info3 = mysql_fetch_array($sql3))	{
			$totalfees 	= $n*$info3['fees_total'];
			$fee_recieved += $info3['fees_paid'];
			$fee_remainings = $totalfees - $fee_recieved;
		}
		$totalfee +=$totalfees;
		$total_fee_recieved += $fee_recieved;
		$total_fee_remaining += $fee_remainings;
		echo "<tr><td>Total Fees: </td><td>Rs. $totalfees</td></tr><tr><td>Fees Collected: </td><td>Rs. $fee_recieved</td></tr><tr><td>Fee to be Collected: </td><td>Rs. $fee_remainings</td></tr>";
	}
?>
</table>
</div>
<?php }?>
</div>
<?php 
//echo "<div style='margin-left: 125px'>Total Fees: Rs. $totalfee<br>Total Fee Recieved: Rs. $total_fee_recieved<br>Total Fee Remaining: Rs. $total_fee_remaining</div>";
?>
</div>
<?php 
	$sql1 = mysql_query("select * from batch;");
	while($info1 = mysql_fetch_array($sql1))	{
		
?>
		<div id="myModal<?php echo $info1['id'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel"><?php echo $info1['batch_name']."'s Reports"?></h3>
		</div>
		<div class="modal-body">
		<?php 
			echo "<h4>Students in batch:</h4>";
			$x = 0;
			$sql2 = mysql_query("select * from student;");
			while($info2 = mysql_fetch_array($sql2))	{
				$sql3 = mysql_query("select * from batch_students where batch_id=".$info1['id']." and student_id = ".$info2['id'].";");
				while($info3 = mysql_fetch_array($sql3))	{
					$sql4 = mysql_query("select * from student where id = ".$info3['student_id'].";");
					while($info4 = mysql_fetch_array($sql4))	{	
						echo $info4['first_name']." ".$info4['last_name']."<br>";	
						$x++;
					}
				}
			}
			echo "<h4>Number of Students:&nbsp<small style='color: black'>$x</small></h4>";
			echo "<br><br><a href='batch_addstudent.php?id=".$info1['id']."'>Add Students to this batch</a>";
		?>
		</div>
		<div class="modal-footer">
		<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
		</div>
		</div>
		
<?php }?>	

<?php 
include_once("../footer.php");
?>

</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=../student/student_list.php");
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