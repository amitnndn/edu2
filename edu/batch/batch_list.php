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
</head>
<body>
<?php 
	include_once('../header.php');
?>
<h2 style="text-align: center">UPCOMING BATCHES *</h2><hr style="margin-right: 100px; margin-left: 100px">
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
	<th style="text-align: center;">Action</th>
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
			$sql4 = mysql_query("select * from batch where id=".$info['id'].";");
			while($info4 = mysql_fetch_array($sql4))	{
				$show = $info4['showing'];
			}
			if($show==0)	{
				
			}
			else	{
				$sql1 = mysql_query("select * from facilitators where id=".$info['facilitator_id'].";");
				while($info1 = mysql_fetch_array($sql1))	{
					$facname = $info1['first_name']." ".$info1['last_name'];
				}
				$j = $info['end_time'];
		
				$o = date(  "F j, Y", strtotime( $info['end_date'] ) );
				$k = $i.":00";
				$l = $j.":00";	
				$m = $k." - ".$l;
				echo "<tr><td style='text-align: center;'><a href=\"#myModal".$info['id']."\" role=\"button\" data-toggle=\"modal\">".$info['batch_name']."</a></td><td style='text-align: center;'>".$info['name']."</td><td style='text-align:center;'>Rs. ".$info['course_fee']."</td><td style='text-align: center;'>$facname</td><td style='text-align: center;'>".$n."</td><td style='text-align: center;'>".$o."</td><td style='text-align: center;'>$m</td><td style='text-align: center;'><a href='batch_edit.php?id=".$info['id']."'>Edit</a> | <a href='batch_addstudent.php?id=".$info['id']."'>Add Student</a> | <a href='../mail/index.php?id=".$info['id']."'>Remind</a></td></tr>";
			}
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
			$sql2 = mysql_query("select * from student;");
			while($info2 = mysql_fetch_array($sql2))	{
				$sql3 = mysql_query("select * from batch_students where batch_id=".$info1['id']." and student_id = ".$info2['id'].";");
				while($info3 = mysql_fetch_array($sql3))	{
					$sql4 = mysql_query("select * from student where id = ".$info3['student_id'].";");
					while($info4 = mysql_fetch_array($sql4))	{	
						$x++;
					}
				}
			}
			echo "<h4>Students in batch: <small style='color: black'>$x</small></h4>";
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
			echo "<br><br><a href='batch_addstudent.php?id=".$info1['id']."'>Add Students to this batch</a>";
		?>
		</div>
		<div class="modal-footer">
		<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
		</div>
		</div>
		
<?php }?>	
<div style="margin-left:100px;">
<small>
*Not showing the batches that are over.&nbsp
<a href='batch_listall.php'>Click here</a> to View all Batches.</small>
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