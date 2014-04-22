<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
?>
<?php
	include_once("database.php");
	$id = $_GET['id'];
	$sql = mysql_query("delete from courses where id=".$id.";");
	if($sql)	{
		echo "Delete Successful";
	}
	else
		echo "Delete Unsuccessful";
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