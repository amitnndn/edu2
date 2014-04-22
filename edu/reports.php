<!DOCTYPE html>
<html>
<head>
<?php include_once("head.php");?>
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/jquerydatatables.js"></script>
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/dt_bootstrap.js"></script>
<link href="http://localhost/htdocs/fd1/css/dt_bootstrap.css" rel="stylesheet">
<title>
Details
</title>
</head>
<?php 
include_once("header.php");
?>
<div class="row-fluid">
<div class="span12">
<div id="container" style="margin-left: 100px; margin-right: 100px;">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
	<th style="text-align: center;">First Name</th>
	<th style="text-align: center;">Last Name</th>
	<th style="text-align: center;">Total Fees Paid</th>
	<th style="text-align: center;">Fee Remaining</th>
	<th style="text-align: center;">Action</th>

</thead>
<tbody> 
<?php 
	$i = 0;
	include_once("database.php");
	$sql = mysql_query("select * from student;");
	while($info = mysql_fetch_array($sql))	{
		$sql1 = mysql_query("select * from course_taken where student_id=".$info['id'].";");
		echo "<tr><td style='text-align: center;'>".$info['first_name']."</td><td style='text-align: center;'>".$info['last_name']."</td><td style='text-align: center;'>Rs. ".$info['total_fee']."</td><td style='text-align: center;'>Rs. ".$info['fee_remaining']."</td><td style='text-align: center;'><a href='update_student.php?id=".$info['id']."'>View</a></td></tr>";
	}
?>
</tbody>
</table>
</div>
</div>
</div>
</html>