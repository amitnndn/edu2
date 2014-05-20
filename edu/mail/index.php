<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/edu/mail/PHPMailer-master/class.phpmailer.php';
$mail = new PHPMailer();
?>
<!DOCTYPE html>
<html>
<head>
<?php 
include_once("../head.php");
?>
<title>
Mail Status
</title>
</head>
<?php 
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'amit.nndn45';                      // SMTP username
$mail->Password = 'mynameisamit';                     // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->From = 'amit.nndn45@gmail.com';
$mail->FromName = 'EDU Admin';
$id = $_GET['id'];
include_once("../database.php");
$sql = mysql_query("select * from batch_students where batch_id = $id;");
$i = 0;
while($info = mysql_fetch_array($sql))	{
	$studentid = $info['student_id'];
	$sql1 = mysql_query("select * from student where id = $studentid;");
	while($info1 = mysql_fetch_array($sql1))	{
		$emailid[$i] = $info1['email'];
		$name[$i] = $info1['first_name']." ".$info1['last_name'];
		$i++;
	}	
	$sql2 = mysql_query("select * from batch where id = $id and showing = 1;");	
	while($info2 = mysql_fetch_array($sql2))	{
		 $batchname = $info2['batch_name'];
		 $startdate = $info2['start_date'];
		 $enddate = $info2['end_date'];
		 $starttime = $info2['start_time'];
		 $endtime = $info2['end_time'];
		 if($starttime > 12)	{
		 	$starttime = 12 - $starttime." PM";
		 }
		 else	{
		 	$starttime = $starttime." AM";
		 }
		 if($endtime > 12)	{
		 	$endtime = 12 - $endtime." PM";
		 }
		 else	{
		 	$endtime = $endtime." AM";
		 }
		 $timings = $starttime." - ".$endtime;
	}
}
$n = $i - 1;
for($i = 0; $i <= sizeof($emailid); $i++)	{
	$mail->WordWrap = 50;                                // Set word wrap to 50 characters
	//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->IsHTML(true);                                  // Set email format to HTML
	$mail->AddAddress($emailid[$i],$name[$i]);
	$mail->Subject = 'Batch Reminder';
	$mail->Body    = "<h3>Reminder about your course with EDU</h3><hr><b>Batch Name:</b> ".$batchname."<br><b>Start Date:</b> ".$startdate."<br><b>End Date: </b>".$enddate."<br><b>Timings: </b>".$timings."<br>
						<br><small>If you have any clarifications please contact: +91 xxxxx xxxxx<hr>(c) <a href='http://www.welttechnologies.com'>Welt Technologies Pvt. Ltd.</a></small>";
	$mail->AltBody = "Your batch starts on Date:";
	
	$errornumber[$i] = 1;
	
	if(!$mail->Send()) {
	   $errorinfo[$i] = $mail->ErrorInfo;
	   $errornumber[$i] = 0;
	}
}
for($i = 0; $i <= sizeof($emailid); $i++)	{
	if($errornumber[$i] == 0)	{
		echo "<div class='alert alert-error'>Email Not sent to ".$name[$i]." Error: ".$errorinfo[$i]."</div>";
	}
	else	{
		echo "<div class='alert alert-success'>Email Sent to ".$name[$i];
	}
}
?>