<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
?>
<?php 
	include_once("database.php");
	$id = $_GET['age'];
	$result = mysql_query("select * from course_taken where student_id = $id;");
	//echo "select * from course_taken where student_id = $id;";exit;
	echo "<select>";
	while($info = mysql_fetch_array($result))	{
		$sql = mysql_query("select * from courses where id=".$info['course_id'].";");
		while($info1 = mysql_fetch_array($sql))	{
			echo "<option>".$info1['name']."</option>";
		}
	}
	echo "</select>";
?>
<?php 
				
		}
		else 	{
			header('Location:../index.php');
		}
	}
	else	{
		header('Location:../index.php');
	}
?>