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
<title>
Course Delete
</title>
</head>
<body>
<?php include_once('../head.php');?>

<?php 
	include_once('../database.php');
	$sql = mysql_query("delete from courses where id=$id;");
	if($sql)	{
		$sql1 = mysql_query("delete from batch where course_id=$id;");
		if($sql1)	{
			$sql2 = mysql_query("delete from course_taken where course_id=$id;");
			$sql3 = mysql_query("delete from batch_students where course_id=$id;");
			if($sql2 && $sql3)	{
				$sql4 = mysql_query("delete from payments where course_id=$id;");			
			}
		}
	}
?>

</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=course_list.php");	
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