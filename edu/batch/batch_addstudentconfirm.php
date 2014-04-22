<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
				
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
</head>
<body>
<?php include_once('../header.php');?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 500px;">
<?php 
	include_once('../database.php');
	$id = explode(",",$_POST['student_id']);
	$batchid = $_GET['id'];
	$n = sizeof($id);
	for($i=0;$i<$n;$i++)	{
		$sql = mysql_query("select * from batch_students where batch_id=$batchid and student_id=$id[$i];");
		$j = mysql_num_rows($sql);	
		if($j == 1)	{
			$sql1 = mysql_query("select * from student where id=$id[$i];");
			while($info1 = mysql_fetch_array($sql1))	{
				$sql2 = mysql_query("select * from batch where id=$batchid;");	
				while($info2 = mysql_fetch_array($sql2))	{
					echo $info1['first_name']." is already in the ".$info2['batch_name']." batch.<br>"; 
				}
			}
		}
		else	{
			$sql1 = mysql_query("select * from batch where id=$batchid;");
			while($info1 = mysql_fetch_array($sql1))	{
				$courseid = $info1['course_id'];
				$sql2 = mysql_query("select * from courses where id=$courseid");
				while($info2 = mysql_fetch_array($sql2))	{
					$coursefee = $info2['fee'];
				}
			}
			$date = Date("Y-m-d");
			$sql2 = mysql_query("insert into batch_students values(default, $batchid, $courseid,$id[$i]);");
			$sql3 = mysql_query("insert into course_taken values(default, $courseid, $id[$i]);");
			$sql4 = mysql_query("insert into payments values(default,$batchid,$id[$i],$courseid,$coursefee,0,$coursefee,'$date','','');");
			if(!$sql2 || !$sql3)	{
				echo mysql_error();
			}
			else	{
				$sql3 = mysql_query("select * from student where id=$id[$i];");
				while($info3 = mysql_fetch_array($sql3))	{
					echo $info3['first_name']." was successfully added to the batch<br>";	
				}
			}
		}
	}
	echo "<a href='batch_list.php'>Click here to go back</a>";
?>
</body>
</html>
<?php 
				}
			else	{
				echo "Access Denied.";
				header("refresh:3;url=batch_list.php");	
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