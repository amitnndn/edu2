<?php
	include_once('database.php');
	$batchid = $_POST['batch_id'];
	$studentid = $_REQUEST['student_id'];
	$courseid = $_REQUEST['course_id'];
	$coursefee = $_POST['course_fee'];
	$feepaid = $_POST['amount_paid'];
	$data = array();
	$feeremaining = $coursefee - $feepaid;
	$sql3 = mysql_query("select * from student where id=$studentid;");
	while($info = mysql_fetch_array($sql3))	{
		$studentname = $info['first_name']." ".$info['last_name'];
	}
	$sql2 = mysql_query("select * from batch_students where batch_id=$batchid and course_id = $courseid and student_id = $studentid;");
	$rows = mysql_num_rows($sql2);
	if($rows>=1)	{
		$data = array(
			"name"=>$info['first_name'],
			"message"=>"Failure"
		);
	}
	else	{
		$sql2 = mysql_query("insert into course_taken values(default,$courseid,$studentid);");
		$sql1 = mysql_query("insert into batch_students values(default,$batchid,$courseid,$studentid);");
		$sql = mysql_query("insert into payments values(default,$batchid,$studentid,$coursefee,$feepaid,$feeremaining);");
		$data = array(
			"name"=>$info['first_name'],
			"message"=>"Success"
		);
	}
	echo json_encode($data);
	
?>