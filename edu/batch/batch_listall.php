<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3 || $role == 4 )	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Batch List
</title>
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/jquerydatatables.js"></script>
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/dt_bootstrap.js"></script>
<link href="http://localhost/htdocs/fd1/css/dt_bootstrap.css" rel="stylesheet">
</head>
<body>
<?php 
	include_once('../header.php');
?>
<h2 style="text-align: center">BATCH LIST <small>(complete)</small></h2><hr style="margin-right: 100px; margin-left: 100px">
<div class="row-fluid">
<div class="span12">
<div id="container" style="margin-left: 100px; margin-right: 100px;">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
	<th style="text-align: center;">Batch Name</th>
	<th style="text-align: center;">Course</th>
	<th style="text-align: center;">Fees</th>
	<th style="text-align: center;">Facilitator</th>
	<th style="text-align: center;">Start Date</th>
	<th style="text-align: center;">End Date</th>
	<th style="text-align: center;">Timings</th>
</thead>
<tbody> 
<?php 
	$i = 0;
	include_once("../database.php");
	$sql = mysql_query("select batch.facilitator_id as facilitator_id,courses.fee as course_fee, batch.id as id, batch.batch_name as batch_name, courses.name as name, batch.start_date as start_date, batch.end_date as end_date, batch.start_time as start_time, batch.end_time as end_time from batch,courses where batch.course_id = courses.id;");
	if($sql)	{
		while($info = mysql_fetch_array($sql))	{
			$i = $info['start_time'];
			$n = date(  "F j, Y", strtotime($info['start_date']) );
			$sql1 = mysql_query("select * from facilitators where id=".$info['facilitator_id'].";");
			while($info1 = mysql_fetch_array($sql1))	{
				$facname = $info1['first_name']." ".$info1['last_name'];
			}
			$j = $info['end_time'];
			$o = date(  "F j, Y", strtotime($info['end_date']) );
			$k = $i.":00";
			$l = $j.":00";	
			$m = $k." - ".$l;
			echo "<tr><td style='text-align: center;'><a href=\"#myModal".$info['id']."\" role=\"button\" data-toggle=\"modal\">".$info['batch_name']."</a></td><td style='text-align: center;'>".$info['name']."</td><td style='text-align:center;'>Rs. ".$info['course_fee']."</td><td style='text-align: center;'>$facname</td><td style='text-align: center;'>".$n."</td><td style='text-align: center;'>".$o."</td><td style='text-align: center;'>$m</td></tr>";
		}
	}
	else	{
		echo mysql_error();
	}
?>
</tbody>
</table>
</div>
</div>
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
			$sql2 = mysql_query("select * from student;");
			while($info2 = mysql_fetch_array($sql2))	{
				$sql3 = mysql_query("select * from batch_students where batch_id=".$info1['id']." and student_id = ".$info2['id'].";");
				while($info3 = mysql_fetch_array($sql3))	{
					$sql4 = mysql_query("select * from student where id = ".$info3['student_id'].";");
					while($info4 = mysql_fetch_array($sql4))	{	
						echo $info4['first_name']." ".$info4['last_name']."<br>";	
					}
				}
			}
			echo "<br><br><a href='#'>Add Students to this batch</a>";
		?>
		</div>
		<div class="modal-footer">
		<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
		</div>
		</div>
		
<?php }?>	
</div>
<?php include_once('../footer.php');?>
</body>
</html>
<?php 
				}
			else	{
				echo "Access Denied. You will be redirected in 3 seconds.";
				header("refresh:3;url:../student/studentlist.php");	
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