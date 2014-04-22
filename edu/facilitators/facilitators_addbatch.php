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
<title>
Status
</title>
</head>
<body>
<?php include_once('../header.php');?>

<?php 
	include_once('../database.php');
	$id = explode(",",$_POST['batch_id']);
	$facid = $_GET['id'];
	$n = sizeof($id);
	for($i = 0; $i<$n ; $i++)	{
		$sql = mysql_query("update batch set facilitator_id = $facid where id=$id[$i];");
		if(!$sql)	{
			echo mysql_error();
		}
	}
	if($sql)	{
		echo "Successful";
		header("refresh:3;url=facilitators_list.php");
	}
?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=facilitators_list.php");
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