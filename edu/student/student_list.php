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
Details
</title>
<style rel="stylesheet">
.modal-body	{
	max-width: 1000px;
}
</style>
</head>
<?php 
include_once("../header.php");
?>
<h2 style="text-align: center">STUDENTS LIST</h2><hr style="margin-right: 100px; margin-left: 100px">
<div class="row-fluid">
<div class="span12">
<div id="container" style="margin-left: 100px; margin-right: 100px;">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
	<th style="text-align: center;"> Name</th>
	<th style="text-align: center;">Phone</th>
	<th style="text-align: center;">Email</th>
	<th style="text-align: center;">Action</th>
</thead>
<tbody> 
<?php 
	$i = 0;
	include_once("../database.php");
	$sql = mysql_query("select * from student;");
	while($info = mysql_fetch_array($sql))	{
		$sql1 = mysql_query("select * from course_taken where student_id=".$info['id'].";");
		echo "<tr><td style='text-align: center;'><a href=\"#myModal".$info['id']."\" role=\"button\" data-toggle=\"modal\">".$info['first_name']." ".$info['last_name']."</td><td style='text-align: center;'>".$info['phone']."</td><td style='text-align: center;'>".$info['email']."</td><td style='text-align: center;'><a href='student_edit.php?id=".$info['id']."'>Edit</a> | Add to: <a href='student_addtocourse.php?id=".$info['id']."'>Course</a></td></tr>";
	}
?>
</tbody>
</table>
</div>
</div>
</div>
<?php 
	$sql1 = mysql_query("select * from student;");
	while($info1 = mysql_fetch_array($sql1))	{
		
?>
		<div id="myModal<?php echo $info1['id'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel"><?php echo trim($info1['first_name'])."'s Reports"?></h3>
		</div>
		<div class="modal-body">
			<table>
		<?php 
			$sql3 = mysql_query("select * from payments where student_id = ".$info1['id'].";");
			$num = mysql_num_rows($sql3);
			$i = 0;
			echo "<tr><td>Courses Taken:&nbsp </td><td>";
			if($num == 0)	{
				echo "Student has not taken any course";	
			}
			else	{
				while($info3 = mysql_fetch_array($sql3))	{		
					$sql4 = mysql_query("select * from courses,course_taken where course_taken.course_id = ".$info3['course_id']." and course_taken.student_id = ".$info1['id']."  and courses.id = course_taken.course_id;");
					while($info4 = mysql_fetch_array($sql4))	{
						if($i == 0)	{
							$coursename1 = $info4['name'];
							$coursename = $coursename1;
						}
						if($coursename1 == $info4['name'])	{
							break;
						}
						else	{				
							if($i == ($num-1))	{
								$coursename .= $info4['name'];
							}
							else	{
								$coursename .= $info4['name']." | ";
							}
							$i++;
						}
					}	
				}
				echo $coursename;
			}
			echo "</td></tr>";
			$sql5 = mysql_query("select * from courses;");
			$totalfees = 0;
			$feepaid = 0;
			$feeremaining = 0;
			while($info5 = mysql_fetch_array($sql5))	{
				$sql6 = mysql_query("select * from payments where student_id = ".$info1['id']." and course_id = ".$info5['id'].";");
				while($info6 = mysql_fetch_array($sql6))	{
					//$totalfees = $info6['fees_total'];
					$feepaid += $info6['fees_paid'];
					$feeremaining += $info6['fees_remaining'];
				}
				$sql7 = mysql_query("select * from course_taken where course_taken.course_id = ".$info5['id']." and course_taken.student_id = ".$info1['id'].";");
				while($info7 = mysql_fetch_array($sql7))	{		
					$sql8 = mysql_query("select * from courses where id = ".$info7['course_id'].";");			
					while($info8 = mysql_fetch_array($sql8))	{
						$totalfees += $info8['fee'];	
					}
				}
			}
			//echo "<tr><td>Fees Paid:</td><td>Rs. $feepaid</td></tr>";
			if($feeremaining > 0)	{
				//echo "<tr><td>Fees Remaining:&nbsp</td><td>Rs. $feeremaining</td>";
				echo "<tr><td></td><td><a href='student_updatepayment.php?id=".$info1['id']."'>Update Payment</a>";
			}
			echo "<tr><td>Total Fees:</td><td>Rs. $totalfees</td>";
			echo "<td><a href='student_details.php?id=".$info1['id']."'>Details</a></td></tr>";
		?>
		</table>
		</div>
		<div class="modal-footer">
		<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
		</div>
		</div>
		
<?php }?>	
<?php include_once('../footer.php');?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied.";	
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